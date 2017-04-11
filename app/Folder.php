<?php

namespace App;

class Folder {

	public $name = null;

	public $description = null;

	public $checklists = [];

	public function __construct($folder)
	{
		$this->id      = str_replace(CHECKLIST_DIR, '', $folder);
		$this->name    = pathinfo($this->id, PATHINFO_BASENAME);
	}
}
