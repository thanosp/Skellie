<?php
namespace Skelie;
/**
 * View class.
 * Templates and Layouts all extend this
 * @package Skelie
 */
class View
{
    protected $template = null;
    protected $arguments = null;

    /**
     * We need the template file and the arguments that will
     * be made accessible to the view
     * @param string $template
     * @param array $arguments
     */
    public function __construct($template, array $arguments)
    {
        $this->template = $template;
        $this->arguments = $arguments;
    }

    /**
     * Directly prints stuff like get_template_part used to.
     */
    public function render()
    {
        global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
       
        require $this->template;
    }

    /**
     * Magic for fetching arguments from the view
     */
    public function __get($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name] : null;
    }

    
    /**
     * Will render a partial using WPView
     * @param string $slug
     * @param string $name specialization of the slug. ignored if not found
     * @param array $arguments optional arguments for the view
     */
    function partial($slug, $name = null, $arguments = array())
    {
        $templateName = get_template_directory() . "/partials/{$slug}/{$name}.php";
        if ($name !== null && file_exists($templateName)) {
            $template = $templateName;
        } else {
            $template = get_template_directory() . "/partials/{$slug}/_default.php";
        }
       
        //let the view know what kind of partial it renders
        if (! isset($arguments['slug'])) {
            $arguments['slug'] = $slug;
        }
        if (! isset($arguments['type'])) {
            $arguments['type'] = $name;
        }
       
        $view = new self($template, $arguments);
        $view->render();
    }
}
  