<?php
require_once 'inc/WPApplication.php';
require_once 'inc/WPView.php';
require_once 'inc/WPLayout.php';
require_once 'inc/WPTemplate.php';

/**
 * Loads stylesheets and javascript files required
 */
function stylesAndScripts()
{
    // wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
    // wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js');
    // wp_enqueue_style('theme_specific_style', get_template_directory_uri() . '/css/style.css');
}
add_action('wp_enqueue_scripts', 'stylesAndScripts');


/**
 * Takes over the rendering process and uses layouts instead
 * @param string $templateFile
 * @return null
 */
function bootstrap($templateFile)
{
    $application = new WPApplication($templateFile);
    $application->run();
    
    //required in order to prevent wordpress from rendering
    return null;
}
add_filter('template_include', 'bootstrap', 10000);

/**
 * Setups theme specific stuff like thumbnail support and menus
 */
function setupTheme()
{
    // This theme uses wp_nav_menu() in one location.
    // register_nav_menus(array('primary' => 'Main Menu', 'utilities' => 'Utility Menu'));
   
    // register_sidebar(array('name' => 'Default Left', 'id' => 'default-sidebar-left'));
    // register_sidebar(array('name' => 'Default Right', 'id' => 'default-sidebar-right'));
   
    //thumbnail sizes
    // add_theme_support('post-thumbnails');
    // add_image_size('preview', 111, 72, true); // thumbnails for featured-style article blocks (cropped)
    // add_image_size('slider', 278, 164, true); // thumbnails for foto blocks (cropped)


}
add_action('after_setup_theme', 'setupTheme');
