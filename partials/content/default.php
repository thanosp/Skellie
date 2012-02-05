<article class="partial-<?php echo $this->slug; ?> type-<?php echo $this->type; ?>">
    <?php the_title(); ?>
    <?php the_content(); ?>
    <?php edit_post_link( __( 'Edit')); ?>
</article>
<?php 
if (!$this->stopIt) {
	echo 'Can I call myself?';
	$this->partial('content', null, array('stopIt' => true));
} else {
	echo 'Yes I can!';
}