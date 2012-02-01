<?php
/**
 * The template for displaying page content.
 */
get_header(); ?>
    <?php while ( have_posts() ) {
        the_post();
        partial( 'content', 'page' );
    } ?>
<?php get_footer(); ?>