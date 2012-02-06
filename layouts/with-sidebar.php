<?php $this->partial('header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
<?php $this->content(); ?><?php $this->partial('sidebar', 'right'); ?>
<?php $this->partial('footer'); ?>
</body>
</html>