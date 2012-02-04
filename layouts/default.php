<?php $this->partial('base', 'header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
<?php $this->content(); ?>
</body>
<?php $this->partial('base', 'footer');