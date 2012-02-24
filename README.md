Skellie
=======
Skellie is the easiest way of coding a wordpress theme without sacrificing simplicity 
for cleanliness or breaking the way wordpress works.

Features
--------
* Partials like Zend Framework with the flexibility of get_template_part (without its drawbacks).
* Views, layouts and templates: All objects and configurable.
* Can be enabled per template or by default for all templates.
* Clean structure.
* Compatible with plugins.

Installation
------------
### New theme
Just fork/clone the repository into your themes folder and enable the theme.

### Existing theme
- Copy the directories: layouts, library and partials into your theme's main dir.
- Put the code from functions.php into your theme's functions.php file.
- If you want to refactor your templates one by one pass true to requireCherryPicking() 
so that only templates with explicitely-set layouts will run through Skellie.

Partials
--------
Partials can be used instead of get_template_part and also give the ability
to pass variables to the partials. The partial can access the variables you pass it using $this.

From within a template, layout or another partial (even itself):

    $params = array('divClass' => 'grid_9');
    echo $this->partial('preview', 'whatever', $params);
    
If partials/preview/whatever.php is found it will be called,
otherwise the default is partials/preview.php if it exists or partials/preview/default.php
The reason for this is that if you don't have many partials of a certain type you shouldn't
have to create a directory for it.

Within the partial you can do:

    <div class="<?php echo $this->divClass; ?>">
        Hola mundo
    </div>

### Layouts
Any template can now pick a layout.
A layout is a wrapper around templates in order to avoid duplicate wrapping code.
Layouts will render the template in a placeholder within them.
The default layout is located in layouts/default.php (duh)
You can override or specify a new layout from within the template with a comment like this:

    /**
    * Template name: Template of doom
    * @layout singleColumn
    */
In this example layouts/singleColumn.php will be rendered instead (if it is found).

A layout is like a regular wordpress template but contains a placeholder where the content
from the template is actually rendered into. Rendering that content occurs with:

    <?php echo $this->content(); ?>


--------
        .-.
       (e.e)
        (m)
      .-="=-.  W
     // =T= \\,/
    () ==|== ()
     \  =V=
      M(oVo)
       // \\
      //   \\
     ()     ()
      \\    ||
       \'   '|
     =="     "==