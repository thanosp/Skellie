<article class="partial-<?php echo $this->slug; ?> type-<?php echo $this->type; ?>">
    <?php the_title(); ?>
    <?php the_content(); ?>
    <?php edit_post_link( __( 'Edit')); ?>
</article>