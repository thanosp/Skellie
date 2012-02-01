<?php
/**
 * The template for displaying page content.
 * @layout blue
 */
while (have_posts()) {
    the_post();
    partial('content', 'page');
}
