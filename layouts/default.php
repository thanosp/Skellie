<?php echo $this->partial('header', $this->header); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
<?php echo $this->content(); ?>
<?php echo $this->partial('footer', $this->footer); ?>
</body>
</html>