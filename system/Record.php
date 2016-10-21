<?php

namespace System;

use System\DB;

class Record extends DB
{

	public function __construct()
	{
		global $app;
		if ( ! isset($app->DB)) $app->DB = new DB();
	}

	public static function all()
	{
		$instance = self::getInstance();
		return self::query("SELECT * FROM `{$instance->_table}`");
	}

	public static function find($id)
	{
		$instance = self::getInstance();
		return self::queryOne("SELECT * FROM `{$instance->_table}` WHERE `id` = '{$id}'");
	}

	private static function getInstance()
	{
		$called_class = get_called_class();
		return new $called_class;
	}

}