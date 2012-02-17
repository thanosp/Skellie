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
   
    /**
     * Will call the closure so that the content is rendered
     * Should be called from within the layout
     * @return string
     */
    public function content()
    {
        $closure = $this->contentClosure;
        return $closure();
    }
} 
