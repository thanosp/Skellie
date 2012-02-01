<?php
/**
 * Single post template
 */
while (have_posts()) {
    get_posts();
    the_post();
    partial('content', get_post_type());
}