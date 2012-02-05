<?php
/**
 * Homepage template
 *
 * Template Name: Homepage
 * @layout with-sidebar
 */
while (have_posts()) {
    get_posts();
    the_post();
    $this->partial('preview', 'homepage');
}
