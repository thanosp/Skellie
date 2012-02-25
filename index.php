<?php
/**
 * Homepage template
 *
 * Template Name: Homepage
 * @layout default
 * @layout[header] default
 * @layout[footer] default
 */
while (have_posts()) {
    get_posts();
    the_post();
    echo $this->partial('preview', 'homepage');
}
