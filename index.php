<?php

require 'vendor/autoload.php';
use Philo\Blade\Blade;


require_once('app/Checklist.php');
require_once('app/ChecklistItem.php');

function url($url = null) {
	$path = $_SERVER['SCRIPT_NAME'];
	$base = dirname($path);
	$root = rtrim($base, '/') . '/';

	return htmlspecialchars($root . $url);
}

function get_selection($all, $needle) {
	foreach($all as $a) {
		if ($a->id === $needle) {
			return $a;
		}
	}

	return false;
}


$checklists      = [];
$checklist_dir   = 'checklists/';

// Will exclude everything under these directories
$exclude = ['.git'];

/**
 * @param SplFileInfo $file
 * @param mixed $key
 * @param RecursiveCallbackFilterIterator $iterator
 * @return bool True if you need to recurse or if the item is acceptable
 */
$filter = function ($file, $key, $iterator) use ($exclude) {
	if ($iterator->hasChildren() && !in_array($file->getFilename(), $exclude)) {
        return true;
    }
    return $file->isFile();
};

$iterator = new RecursiveDirectoryIterator($checklist_dir);
$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
$rii = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator( $iterator, $filter));

foreach ($rii as $file) {

	if (in_array(basename($file), ['.gitlab-ci.yml'])) {
		continue;
	}

	$checklists[] = new Checklist($file);
}



$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

$blade = new Blade($views, $cache);


// check for URL: overview or detail page
$selection = str_replace(url(), '', $_SERVER['REQUEST_URI']);

if (!empty($selection) && $selection = get_selection($checklists, $selection)) {
	echo $blade->view()->make('checklist.show', ['checklist' => $selection])->render();
} else {
	echo $blade->view()->make('checklist.list', ['checklists' => $checklists])->render();
}



