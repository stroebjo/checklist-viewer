<?php

namespace App;

class Checklist {

	public $name = null;

	public $description = null;

	public $items = [];

	public function __construct($filename)
	{
		$scope = str_replace(CHECKLIST_DIR, '', $filename);

		$this->id = pathinfo($scope, PATHINFO_DIRNAME) . '/' . pathinfo($scope, PATHINFO_FILENAME);

		$this->path    = $filename;
		$this->changed = filemtime($filename);
		// -> remember! there is no createn date

		$md = file_get_contents($filename);

		// get name
		preg_match('/# (.+)/', $md, $m);
		$this->name = trim((isset($m[1])) ? $m[1] : $filename);

		// scrape all todos
		$needle     = "\n## ";
		$positions  = [];
		$lastPos    = 0;

		while (($lastPos = strpos($md, $needle, $lastPos)) !== false) {

			// @todo check for second headings. don't use third, etc.

			$positions[] = $lastPos;
			$lastPos = $lastPos + strlen($needle);
		}

		foreach($positions as $i => $pos) {
			$item = substr($md, $pos, ((isset($positions[$i + 1 ])) ? $positions[$i + 1 ]  - $pos : strlen($md)));

			if (empty($item)) {
				continue;
			}

			preg_match('/## (.+)/', $item, $m);

			$item_name = $m[1];
			$item_description = preg_replace('/## (.+)/', '', $item);

			$this->items[] = new ChecklistItem(
				$item_name,
				$item_description
			);
		}
	}

	/**
	 * Return simple array of todos for trello integration.
	 *
	 */
	public function getItems()
	{
		$items = [];

		foreach($this->items as $item) {
			$items[] = [
				'name' => $item->name,
				'description' => $item->description,
			];
		}

		return $items;
	}
}
