<?php 
// an example of grid_960 with html5
$this->partial('header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
    <header class="container_16 clearfix" role="banner">
        <div class="grid_3"><h1 class="ir siteTitle"><a href="/"><?php
            bloginfo('name');
            ?></a></h1>
        </div>
       
        <div class="grid_9">
            <?php $this->partial('menu', 'utility'); ?>
        </div>
       
        <div class="grid_4">
            <?php $this->partial('search-form', null, array('id' => 'headerSearchForm')); ?>
        </div>
       
        <div class="grid_16">
            <?php $this->partial('menu', 'main'); ?>
        </div>
    </header>
   
    <div id="wrapper" class="container_16 clearfix" role="main">
        <div class="grid_3"><aside role="complementary"><?php $this->partial('sidebar', 'left'); ?></aside></div>
        <div class="grid_9"><?php
            $this->partial('menu', 'breadcrumbs');
            $this->content();
        ?></div>
        <div class="grid_4"><aside role="complementary"><?php $this->partial('sidebar', 'right'); ?></aside></div>
    </div>
   
    <?php $this->partial('footer'); ?>

</body>
</html> 