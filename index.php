<?php
/**
 * Homepage template
 *
 * Template Name: Homepage
 * @layout default
 */
while (have_posts()) {
    get_posts();
    the_post();
    $this->partial('preview', 'homepage');
}
