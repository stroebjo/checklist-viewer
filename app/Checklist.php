<?php


class Checklist {

	public $name = null;

	public $description = null;

	public $items = [];

	public function __construct($filename)
	{
		$this->id = basename($filename, '.md');

		$md = file_get_contents($filename);

		$needle = '## ';

		preg_match('/# (.+)/', $md, $m);

		$this->name = trim($m[1]);

		$positions  = [];
		$lastPos = 0;

		while (($lastPos = strpos($md, $needle, $lastPos)) !== false) {
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
			$item_description = preg_replace('/^.+\n/', '', $item);

			$this->items[] = new ChecklistItem(
				$item_name,
				$item_description
			);
		}
	}
}
