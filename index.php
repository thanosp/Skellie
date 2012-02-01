<?php
/**
 * Homepage template
 *
 * Template Name: Homepage
 * @layout blue
 */
while (have_posts()) {
    get_posts();
    the_post();
    partial('preview', 'homepage');
}
