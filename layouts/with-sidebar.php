<?php echo $this->partial('header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
<?php echo $this->content(); ?><?php echo $this->partial('sidebar', 'right'); ?>
<?php echo $this->partial('footer'); ?>
</body>
</html>