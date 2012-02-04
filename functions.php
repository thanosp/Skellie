<?php
require_once 'inc/WPView.php';
require_once 'inc/WPLayout.php';
require_once 'inc/WPTemplate.php';

/**
 * Loads stylesheets and javascript files required
 */
function stylesAndScripts()
{
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js');
    wp_enqueue_style('theme_specific_style', get_template_directory_uri() . '/css/style.css');
}    
add_action('wp_enqueue_scripts', 'stylesAndScripts');

/**
 * Renders a layout pushing the content closure to it
 * @param string $layout
 * @param Closure $content
 * @param array $arguments
 */
function layout($layout, Closure $content, $arguments = array())
{
    $templateName = __DIR__ . "/layouts/{$layout}.php";
    if (file_exists($templateName)) {
        $template = $templateName;
    } else {
        $template = __DIR__ . "/layouts/default.php";
    }
   
    //let the view know what kind of partial it renders
    if (! isset($arguments['layout'])) {
        $arguments['layout'] = $layout;
    }
   
    $view = new WPLayout($template, $content, $arguments);
    $view->render();
}

/**
 * Will render a partial using WPView
 * @param string $slug
 * @param string $name specialization of the slug. ignored if not found
 * @param array $arguments optional arguments for the view
 */
function partial($slug, $name = null, $arguments = array())
{
    $templateName = __DIR__ . "/partials/{$slug}/{$name}.php";
    if ($name !== null && file_exists($templateName)) {
        $template = $templateName;
    } else {
        $template = __DIR__ . "/partials/{$slug}/_default.php";
    }
   
    //let the view know what kind of partial it renders
    if (! isset($arguments['slug'])) {
        $arguments['slug'] = $slug;
    }
    if (! isset($arguments['type'])) {
        $arguments['type'] = $name;
    }
   
    $view = new WPView($template, $arguments);
    $view->render();
}

/**
 * Takes over the rendering process and uses layouts instead
 * @param string $templateFile
 * @return null
 */
function bootstrapLayout($templateFile)
{
    $layout = getTemplateLayout($templateFile);
    layout($layout, function () use ($templateFile) {
        $arguments = array('layout' => $layout);
        $template = new WPTemplate($templateFile, $arguments);
        $template->render();
    });
    //required in order to prevent wordpress from rendering
    return null;
}
add_filter('template_include', 'bootstrapLayout', 10000);

/**
 * Figures out what layout to use for the given template
 * Hack, hack, bacon and hack
 * @param string $template
 * @return string
 */
function getTemplateLayout($template)
{
    // looks for an annotation that denotes the layout to use
    preg_match('/\@layout ([a-z]+)/', file_get_contents($template), $matches);
    if (isset($matches[1]) && strlen($matches[1]) > 1) {
        $layout = $matches[1];
    } else {
        $info = new SplFileInfo($template);
        $layout = $info->getBasename('.php');
    }
    return $layout;
}


/**
 * Setups theme specific stuff like thumbnail support and menus
 */
function setupTheme()
{
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(array('primary' => 'Main Menu', 'utilities' => 'Utility Menu'));
   
    register_sidebar(array('name' => 'Default Left', 'id' => 'default-sidebar-left'));
    register_sidebar(array('name' => 'Default Right', 'id' => 'default-sidebar-right'));
   
    //thumbnail sizes
    add_theme_support('post-thumbnails');
    add_image_size('preview', 111, 72, true); // thumbnails for featured-style article blocks (cropped)
    add_image_size('slider', 278, 164, true); // thumbnails for foto blocks (cropped)


}
add_action('after_setup_theme', 'setupTheme');
