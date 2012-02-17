Features
--------
* Regular wordpress template files can now have layouts which will render the template in a placeholder.
* Layouts, templates and partials can render partials and pass arguments to them.
* Layouts, templates and views are objects so you can use $this.
* Layouts and partials have default fallbacks like get_template_part of wordpress.
* Cleaner theme folder with all partials in one place.
* Cleaner templates with all the wrapping code being in layouts.
* Only uses one filter so the chance of it breaking upon wordpress update is minimal.
* Does not break wordpress plugins and you don't have to rewrite them either.
 
### Layouts
One regular wordpress template will now have a layout attached to it by default.
A layout is basically a wrapper around templates in order to avoid duplicate wrapping code.
Layouts will render the template in a placeholder within them.
The default layout is located in layouts/default.php (duh)
You can override or specify a new layout from within the template with a comment like this:

    /**
    * Template name: Template of doom
    * @layout 2-columns
    */
In this example layouts/2-columns.php will be rendered instead (if it is found).

A layout is like a regular wordpress template but contains a placeholder where the content
from the template is actually rendered into. Rendering that content occurs with:

    <?php echo $this->content(); ?>


### Partials
Partials can be used instead of get_template_part and also give the ability
to pass variables to the partials. The partial can access the variables you pass it using $this.

From within a template, layout or another partial (even itself):

    echo $this->partial('preview', 'whatever', array('divClass' => 'cooool'));


If partials/preview/whatever.php is found it will be called,
otherwise the default is partials/preview.php if it exists or partials/preview/default.php
The reason for this is that if you don't have many partials of a certain type you shouldn't
have to create a directory for it.

Within the partial you can do:

    <div class="<?php echo $this->divClass; ?>">
        Hola mundo
    </div>
    
and continue doing your regular wordpress stuff.

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