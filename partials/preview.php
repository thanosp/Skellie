<article class="partial-<?php echo $this->slug; ?> type-<?php echo $this->type; ?>">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php echo getTheLimitedExcerpt(); ?>
</article>