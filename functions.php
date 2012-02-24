<?php
require_once 'library/Skellie/Frame.php';

use Skellie\Frame;

/**
 * Takes over the rendering process and uses layouts instead
 * @param string $templateFile
 * @return null
 */
add_filter('template_include', function ($templateFile) {
    $frame = new Frame($templateFile);
    
    // cherry picking forces templates to choose a layout or wordpress will go on
    // $frame->enableCherryPicking(true);
    $output = $frame->render();
    
    // if the frame render returned null go on with regular wordpress
    if (null === $output) {
        return $templateFile;
    }

    echo $output;
    // required in order to prevent wordpress from rendering
    return null;
}, 10000);

/**
 * Everything below this can be removed. Clean functions.php ftw
 */

/**
 * Loads stylesheets and javascript files required
 */
add_action('wp_enqueue_scripts', function () {
    // wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css');
    // wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js');
    // wp_enqueue_style('theme_specific_style', get_template_directory_uri() . '/css/style.css');
});

/**
 * Setups theme specific stuff like thumbnail support and menus
 */
add_action('after_setup_theme', function () {
    // Need navigation?
    // register_nav_menus(array('primary' => 'Main Menu', 'utilities' => 'Utility Menu'));
   
    // Need default sidebars?
    // register_sidebar(array('name' => 'Default Left', 'id' => 'default-sidebar-left'));
    // register_sidebar(array('name' => 'Default Right', 'id' => 'default-sidebar-right'));
   
    // Need post thumbnails?
    // add_theme_support('post-thumbnails');
    // add_image_size('preview', 111, 72, true); // thumbnails for featured-style article blocks (cropped)
});
