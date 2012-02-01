<?php
/**
 * Homepage template
 *
 * Template Name: Homepage
 */
get_header(); ?>
<?php 
while (have_posts()) {
    get_posts();
    the_post();
    partial('preview', 'homepage');
}
?>
<?php get_footer();