<?php
namespace Skelie;
/**
 * Layout class
 *
 * @category Wordpress
 * @package WPLayout
 * @version $Id: WPLayout.php 22 2012-02-02 08:26:36Z thanos $
 */
class Layout extends View
{
    protected $contentClosure = null;
   
    public function __construct($template, \Closure $content, $arguments)
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
