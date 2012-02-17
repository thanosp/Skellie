<?php 
// an example of grid_960 with html5
echo $this->partial('header'); ?>
<body <?php body_class('layout-'.$this->layout); ?>>
    <header class="container_16 clearfix" role="banner">
        <div class="grid_3"><h1 class="ir siteTitle"><a href="/"><?php
            bloginfo('name');
            ?></a></h1>
        </div>
       
        <div class="grid_9">
            <?php echo $this->partial('menu', 'utility'); ?>
        </div>
       
        <div class="grid_4">
            <?php echo $this->partial('search-form', null, array('id' => 'headerSearchForm')); ?>
        </div>
       
        <div class="grid_16">
            <?php echo $this->partial('menu', 'main'); ?>
        </div>
    </header>
   
    <div id="wrapper" class="container_16 clearfix" role="main">
        <div class="grid_3"><aside role="complementary"><?php echo $this->partial('sidebar', 'left'); ?></aside></div>
        <div class="grid_9"><?php
            echo $this->partial('menu', 'breadcrumbs');
            echo $this->content();
        ?></div>
        <div class="grid_4"><aside role="complementary"><?php echo $this->partial('sidebar', 'right'); ?></aside></div>
    </div>
   
    <?php echo $this->partial('footer'); ?>

</body>
</html> 