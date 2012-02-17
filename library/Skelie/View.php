<?php
namespace Skelie;

/**
 * View class.
 * Templates and Layouts all extend this
 * @package Skelie
 */
abstract class View
{
    protected $template = null;
    protected $arguments = null;

    /**
     * We need the template file and the arguments that will
     * be made accessible to the view
     * @param string $template
     * @param array $arguments
     */
    public function __construct($template, array $arguments = array())
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
        
        ob_start();
        require $this->template;
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    /**
     * Magic for fetching arguments from the view
     */
    public function __get($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name] : null;
    }

    protected function getDefaultPartial($slug, $name)
    {
        $templateFile = $this->templatePath("/partials/{$slug}/default.php");
        if (file_exists($templateFile)) {
            return $templateFile;
        } else {
            return $this->templatePath("/partials/{$slug}.php");
        }
    }
    
    /**
     * Will render a partial using a new view object
     * @param string $slug
     * @param string $name specialization of the slug. ignored if not found
     * @param array $arguments optional arguments for the view
     * @return string
     */
    public function partial($slug, $name = null, $arguments = array())
    {
        $templateFile = $this->templatePath("/partials/{$slug}/{$name}.php");

        if (!file_exists($templateFile)) {
            $templateFile = $this->getDefaultPartial($slug, $name);
        }
       
        //let the view know what kind of partial it renders
        if (! isset($arguments['slug'])) {
            $arguments['slug'] = $slug;
        }
        if (! isset($arguments['type'])) {
            $arguments['type'] = $name;
        }
       
        $view = new Partial($templateFile, $arguments);
        return $view->render();
    }

    /**
     * Prepends the given path with the template path
     * @param string $path
     * @return string
     */ 
    public function templatePath($path = null)
    {
        return get_template_directory() . $path;
    }
}
  