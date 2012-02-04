<?php
namespace Skelie;
/**
 * Layout class
 *
 * @package Skelie
 */
class Layout extends View
{
    protected $contentClosure = null;
   
    /**
     * We need to know which file to render,
     * what to call for getting the content
     * and which arguments to pass through when requested.
     * @param string $template
     * @param \Closure $content
     * @param array $arguments
     */
    public function __construct($template, \Closure $content, array $arguments)
    {
        $this->template = $template;
        $this->contentClosure = $content;
        $this->arguments = $arguments;
    }

    public function render()
    {
        global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
       
        require $this->template;
    }
   
    public function content()
    {
        $closure = $this->contentClosure;
        $closure();
    }
} 
