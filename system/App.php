<?php

namespace System;

use system\View;
use system\Config;
use system\Router;

class App
{

	public $DB;

	public $View;
	public $Config;
	public $Router;

	public function __construct()
	{
		$this->View   = new View();
		$this->Config = new Config();
		$this->Router = new Router();
	}

	public function run()
	{
		$this->DB = new DB();
		//$this->Router->getRouteByPath();
		$this->Router->go();
		$record = new \App\Data\Post();
		if ($this->DB) $this->DB->disconnect();
	}

}