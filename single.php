<?php
/**
 * Single post template
 */
while (have_posts()) {
    get_posts();
    the_post();
    echo $this->partial('content', get_post_type());
}