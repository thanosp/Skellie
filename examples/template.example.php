<?php
// imagine this located in your theme directory

// Calls upon the archive partial to render the actual articles.
// The archive partial can then be reused for categories and tags as well

$title = 'Search results for &ldquo;'.get_search_query().'&rdquo;';
$this->partial('list', 'archive', array('title' => $title, 'collection' => 'search'));