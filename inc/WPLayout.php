<?php
/**
 * Layout class
 * 
 * @category Wordpress
 * @package WPLayout
 * @version $Id: $
 */
class WPLayout extends WPView
{
    protected $contentClosure = null;
    
    public function __construct($template, Closure $content, $arguments)
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