<?php
/**
 * View class for wordpress 
 * @category Wordpress
 * @package WPView
 * @version $Id: WPView.php 14 2012-02-01 12:24:05Z thanos $
 */
class WPView
{
    public $template = null;
    public $arguments = null;

    public function __construct($template, $arguments)
    {
        $this->template = $template;
        $this->arguments = $arguments;
    }

    public function render()
    {
        global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
        
        require $this->template;
    }

    public function __get($name)
    {
        return isset($this->arguments[$name]) ? $this->arguments[$name] : null;
    }
}
