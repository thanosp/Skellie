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
     Here
     Lies
     A
     Wordpress
     Theme

Features
--------
* Regular wordpress template files can now have layouts
* Layouts and templates can render views(partials) and pass variables to them
* Layouts, templates and views are objects and can now be more self conscious (all objects).
* Layouts and views have default fallbacks like get_template_part of wordpress.

### Layouts
One regular wordpress template will now have a layout attached to it by default.
A layout is basically a wrapper around templates in order to avoid duplicate wrapping code.
Layouts will render the template in a placeholder within them.
The default layout is layouts/default.php (duh)
You can override or specify a new layout from within the template with a comment like this:

    /**
    * Template name: my_template
    * @layout 2columns
    */
In this example layouts/2columns.php will be rendered instead.

A layout is like a regular wordpress template but contains a placeholder where the content
from the template is actually rendered into. Rendering that content occurs with:

    <?php $this->content(); ?>


### Partials
Partials can be used instead of get_template_part and also give the ability
to pass variables to the partials. The partial can access the variables using $this.

From within a template, layout or another partial:

    $this->partial('preview', 'whatever', array('divClass' => 'cooool'));


If partials/preview/whatever.php is found it will be called,
otherwise the default is partials/preview/_default.php
Within the partial you can do:

    <div class="<?php echo $this->divClass; ?>">
        Hola mundo
    </div>