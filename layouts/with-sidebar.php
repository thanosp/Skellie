<?php $this->partial('header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
<?php $this->content(); ?><?php $this->partial('sidebar', 'right'); ?>
</body>
<?php $this->partial('footer');