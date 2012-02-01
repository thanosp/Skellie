<?php
require_once 'inc/WPView.php';
require_once 'inc/WPLayout.php';

function scripts() {
   wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
   wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js');
}    
add_action('wp_enqueue_scripts', 'scripts');

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
        $template = __DIR__ . "/partials/{$slug}.php";
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
 * @param string $template
 * @return null
 */
function takeOverLayout($template)
{
    $layout = templateToLayout($template);
    layout($layout, function() use ($template) {
        include $template;
    });
    return null;
}
add_filter('template_include', 'takeOverLayout', 10000);

/**
 * Figures out what layout to use for the given template
 * Hackie hacky hack hack
 * @param string $template
 * @return string
 */
function templateToLayout($template)
{
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
 * Limits an excerpt to the given number of characters
 * @param integer $limit in words
 * @return string
 */
function getTheLimitedExcerpt($limit = 30, $allowUnfilteredManualExcerpt = false)
{
    global $post;
    //first select the excerpt
    $manualExcerpt = $post->post_excerpt;
    if (strlen($manualExcerpt) > 0) {
        if ($allowUnfilteredManualExcerpt) {
            return $manualExcerpt;
        }
        $excerpt = $manualExcerpt;
    } else {
        $excerpt = get_the_excerpt();
    }
    
    $words = explode(' ', $excerpt);
    
    //then limit the excerpt
    if ($limit > 1 && count($words) > $limit) {
        $excerpt = implode(' ', array_slice($words, 0, $limit - 1)) . '...';
    }
    return $excerpt;
}
