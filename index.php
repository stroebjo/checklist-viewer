<?php

require __DIR__.'/vendor/autoload.php';

use Philo\Blade\Blade;

function url($url = null) {
	$path = $_SERVER['SCRIPT_NAME'];
	$base = dirname($path);
	$root = rtrim($base, '/') . '/';

	return htmlspecialchars($root . $url);
}

function return_breadcrumb() {
	$selection = str_replace(url(), '', $_SERVER['REQUEST_URI']);
	$selection = preg_replace('/[^a-z0-9-\/]/i', '', $selection);

	$return = [];
	$items = explode('/', $selection);

	foreach($items as $i => $item) {

		if (empty($item)) {
			continue;
		}

		$oItem = new stdClass();
		$oItem->name = $item;
		$oItem->href = implode('/', array_slice($items, 0, $i + 1));


		$return[] = $oItem;

	}

	return $return;
}


// check for URL: overview or detail page
$selection = str_replace(url(), '', $_SERVER['REQUEST_URI']);
$selection = preg_replace('/[^a-z0-9-\/]/i', '', $selection);
define('CHECKLIST_DIR', __DIR__.'/checklists/');


$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);

if (is_dir(CHECKLIST_DIR . $selection )) {

	// show directory listing of current dir.
	$checklists      = [];
	$checklists_folder = [];

	$dir = new DirectoryIterator(CHECKLIST_DIR . $selection );

	foreach ($dir as $fileinfo) {

		// skip . and ..
		if ($fileinfo->isDot()) {
			continue;
		}

		// skip files
		if (in_array($fileinfo->getFilename(), ['.git', '.gitlab-ci.yml'])) {
			continue;
		}

		if ($fileinfo->isFile()) {
			$checklists[] = new \App\Checklist($fileinfo->getPathname());
		} else {
			$checklists_folder[] = new \App\Folder($fileinfo->getPathname());
		}
	}

	echo $blade->view()->make('checklist.list', ['checklists_folder' => $checklists_folder, 'checklists' => $checklists])->render();


} else if (is_file(CHECKLIST_DIR . $selection . '.md')) {

	// actual file is selected. Show it.

	$checklist = new \App\Checklist(CHECKLIST_DIR . $selection . '.md');

	echo $blade->view()->make('checklist.show', ['checklist' => $checklist])->render();
} else {
	// 404, ¯\_(ツ)_/¯
	echo $blade->view()->make('error.404')->render();
}

