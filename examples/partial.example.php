<?php
// imagine this located in partials/list/archive.php

/**
 * Renders a section with the given title for the given collection
 * @param string collection
 * @param string title
 */ ?>
<section>
    <article>
        <header>
            <h1><?php echo $this->title; ?></h1>
        </header>
        <?php
            while (have_posts()) {
                the_post();
                // call upon the preview partial to show a part of the article
                $this->partial('preview', $this->collection);
            }
        ?>
    </article>
    <?php $this->partial('paginate', $this->collection); ?>
</section> 