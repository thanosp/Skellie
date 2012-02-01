<?php
require_once 'inc/WPView.php';

/**
 * Returns a versioned file name based on the last modified file date
 * 
 * @param string $fileUrl Pointing to the file as would have been from the html
 * @return string a versioned filename
 */
function getAssetVersionNumber($fileUrl)
{
    if (false === defined('ABSPATH')) {
        return $fileUrl;
    }
    
    $publicRoot = __DIR__;
    $path = $publicRoot . $fileUrl;
    
    if (false === is_file($path)) {
        return $fileUrl;
    }
    
    $modTime = filemtime($path);
    $pathInfo = pathinfo($path);
    
    if (! isset($pathInfo['extension'])) {
        return $fileUrl;
    }
    
    $versionedFilename = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['filename'] . ".{$modTime}." . $pathInfo['extension'];
    
    return str_replace($publicRoot, '', $versionedFilename);
}

/**
 * Will render a partial using WPView
 * @param string $slug 
 * @param string $name specialization of the slug. ignored if not found 
 * @param array $arguments optional arguments for the view
 */
function partial($slug, $name = null, $arguments = array())
{
    $templateName = __DIR__ . "/partials/{$slug}/{$name}.php";
    if ($name !== null && file_exists($templateName)) {
        $template = $templateName;
    } else {
        $template = __DIR__ . "/partials/{$slug}.php";
    }
    
    //let the view know what kind of partial it renders
    if (! isset($arguments['slug'])) {
        $arguments['slug'] = $slug;
    }
    if (! isset($arguments['type'])) {
        $arguments['type'] = $name;
    }
    
    $view = new WPView($template, $arguments);
    $view->render();
}

/**
 * Limits an excerpt to the given number of characters
 * @param integer $limit in words
 * @return string
 */
function getTheLimitedExcerpt($limit = 30, $allowUnfilteredManualExcerpt = false)
{
    global $post;
    //first select the excerpt
    $manualExcerpt = $post->post_excerpt;
    if (strlen($manualExcerpt) > 0) {
        if ($allowUnfilteredManualExcerpt) {
            return $manualExcerpt;
        }
        $excerpt = $manualExcerpt;
    } else {
        $excerpt = get_the_excerpt();
    }
    
    $words = explode(' ', $excerpt);
    
    //then limit the excerpt
    if ($limit > 1 && count($words) > $limit) {
        $excerpt = implode(' ', array_slice($words, 0, $limit - 1)) . '...';
    }
    return $excerpt;
}
