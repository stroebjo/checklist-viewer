<?php

require __DIR__.'/vendor/autoload.php';

use Philo\Blade\Blade;

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

// check for URL: overview or detail page
$selection = str_replace(url(), '', $_SERVER['REQUEST_URI']);
$selection = preg_replace('/[^a-z0-9-\/]/i', '', $selection);

$checklists      = [];
$checklists_folder = [];
define('CHECKLIST_DIR', __DIR__.'/checklists/');


$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

$blade = new Blade($views, $cache);



// Will exclude everything under these directories
$exclude = ['.git'];

if (is_dir(CHECKLIST_DIR . $selection )) {

	// show directory listing of current dir.

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

