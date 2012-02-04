<?php
require_once __DIR__. '/WPView.php';
require_once __DIR__. '/WPLayout.php';
require_once __DIR__. '/WPTemplate.php';

class WPApplication
{
	public $templateFile = null;

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
	    preg_match('/\@layout ([a-z]+)/', file_get_contents($template), $matches);
	    if (isset($matches[1]) && strlen($matches[1]) > 1) {
	        $layout = $matches[1];
	    } else {
	        $info = new SplFileInfo($template);
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
	function renderLayout($layout, Closure $content, $arguments = array())
	{
	    $templateName = get_template_directory() . "/layouts/{$layout}.php";
	    if (file_exists($templateName)) {
	        $template = $templateName;
	    } else {
	        $template = get_template_directory() . "/layouts/default.php";
	    }
	   
	    //let the view know what kind of partial it renders
	    if (! isset($arguments['layout'])) {
	        $arguments['layout'] = $layout;
	    }
	   
	    $view = new WPLayout($template, $content, $arguments);
	    $view->render();
	}

	public function run()
	{
		$templateFile = $this->templateFile;
		$layout = $this->getTemplateLayout($templateFile);
	    $this->renderLayout($layout, function () use ($templateFile) {
	        $arguments = array('layout' => $layout);
	        $template = new WPTemplate($templateFile, $arguments);
	        $template->render();
	    });
	}
}