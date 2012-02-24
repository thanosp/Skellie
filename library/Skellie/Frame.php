<?php
namespace Skellie;

require_once __DIR__. '/View.php';
require_once __DIR__. '/Partial.php';
require_once __DIR__. '/Layout.php';
require_once __DIR__. '/Template.php';

/**
 * The frame bootstraps the application
 * It brings the layout and the template together
 * @package Skellie
 */
class Frame extends View
{
    /**
     * Upon true only templates that explicitely call
     * for a skellie layout will run through Skellie
     * @var boolean
     */
    public $cherryPickingRequired = false;

    /**
     * Cherry picking will allow co-existance of
     * both Skellie and wordpress rendering.
     * 
     * @param boolean $flag defaults to true
     * @return $this
     */
    public function requireCherryPicking($flag = true)
    {
        $this->cherryPickingRequired = $flag;
        return $this;
    }
    
	/**
	 * Figures out what layout to use for the given template
	 * Hack, hack, bacon and hack
	 * @param string $template
	 * @return string
	 */
	public function getTemplateLayout($template)
	{
	    // looks for an annotation that denotes the layout to use
	    preg_match('/\@layout ([a-z0-9\-\_\.]+)/', file_get_contents($template), $matches);
	    if (isset($matches[1]) && strlen($matches[1]) > 1) {
	        $layout = $matches[1];
	    } else {
	        $info = new \SplFileInfo($template);
	        $layout = $info->getBasename('.php');
	    }
	    return $layout;
	}

	/**
	 * Renders a layout pushing the content closure to it
	 * @param string $layout
	 * @param Closure $content
	 * @param array $arguments
	 * @return string
	 */
	protected function renderLayout($layout, \Closure $content, $arguments = array())
	{
	    $layoutFile = $this->templatePath("/layouts/{$layout}.php");
	    if (! file_exists($layoutFile)) {
	        if ($this->cherryPickingRequired) {
	            return null;
	        }
	        $layoutFile = $this->templatePath("/layouts/default.php");
	    }
	   
	    //let the view know what kind of partial it renders
	    if (! isset($arguments['layout'])) {
	        $arguments['layout'] = $layout;
	    }
	   
	    $layout = new Layout($layoutFile, $content, $arguments);
	    return $layout->render();
	}

	/**
	 * Init point. Starts the whole process
	 * @return string
	 */
	public function render()
	{
	    $templateFile = $this->template;
	    $layout = $this->getTemplateLayout($templateFile);
	    return $this->renderLayout($layout, function () use ($templateFile) {
	        $arguments = array('layout' => $templateFile);
	        $template = new Template($templateFile, $arguments);
	        return $template->render();
	    });
	}
}