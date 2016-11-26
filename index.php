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

$checklist_dir   = 'checklists/';
$checklist_files = scandir($checklist_dir);
$checklists      = [];

foreach ($checklist_files as $checklist) {
	if (in_array($checklist, ['.', '..', '.git'])) {
		continue;
	}

	$checklists[] = new Checklist($checklist_dir . $checklist);
}

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';

$blade = new Blade($views, $cache);


// check for URL
$selection = str_replace(url(), '', $_SERVER['REQUEST_URI']);

if (!empty($selection) && $selection = get_selection($checklists, $selection)) {
	echo $blade->view()->make('checklist.show', ['checklist' => $selection])->render();
} else {
	echo $blade->view()->make('checklist.list', ['checklists' => $checklists])->render();
}



