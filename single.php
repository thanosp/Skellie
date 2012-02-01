<?php
/**
 * Single post template
 */
get_header(); ?>
<?php 
while (have_posts()) {
    get_posts();
    the_post();
    partial('content', get_post_type());
}
?>
<?php get_footer();