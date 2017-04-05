<?php

namespace App;

class ChecklistItem {

	public $name = null;

	public $description = null;

	public $checked = false;

	public function __construct($name, $description = null)
	{
		$parsedown = new \Parsedown();

		$this->name = trim($name);
		$this->description = trim($description);

		$this->nameHTML        = $parsedown->line($this->name);
		$this->descriptionHTML = $parsedown->text($this->description);
	}
}


