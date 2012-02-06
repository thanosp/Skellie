<?php
namespace Skelie;

require_once __DIR__. '/View.php';
require_once __DIR__. '/Layout.php';
require_once __DIR__. '/Template.php';

/**
 * The frame bootstraps the application
 * It brings the layout and the template together
 * @package Skelie
 */
class Frame extends View
{
	protected $templateFile = null;

	/**
	 * Bootstrapping requires the template file 
	 * that wordpress decided we should render
	 */
	public function __construct($templateFile)
	{
	    $this->templateFile = $templateFile;
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
	 */
	function renderLayout($layout, \Closure $content, $arguments = array())
	{
	    $layoutFile = $this->templatePath("/layouts/{$layout}.php");
	    if (! file_exists($layoutFile)) {
	        $layoutFile = $this->templatePath("/layouts/default.php");
	    }
	   
	    //let the view know what kind of partial it renders
	    if (! isset($arguments['layout'])) {
	        $arguments['layout'] = $layout;
	    }
	   
	    $layout = new Layout($layoutFile, $content, $arguments);
	    $layout->render();
	}

	/**
	 * Init point. Starts the whole process
	 */
	public function render()
	{
	    $templateFile = $this->templateFile;
	    $layout = $this->getTemplateLayout($templateFile);
	    $this->renderLayout($layout, function () use ($templateFile) {
	        $arguments = array('layout' => $templateFile);
	        $template = new Template($templateFile, $arguments);
	        $template->render();
	    });
	}
}