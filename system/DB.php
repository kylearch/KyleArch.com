<?php

namespace System;

class DB
{

	protected $_query;
	protected $_select;
	protected $_table;
	protected $_where = [];
	protected $_joins = [];
	protected $_orderBy = [];
	protected $_groupBy = [];

	public static $_instance;

	public function __construct()
	{
		global $app;
		$this->connection = new \PDO("mysql:host=" . config('database.app.host') . ";dbname=" . config('database.app.name'), config('database.app.user'), config('database.app.pass'));
		self::$_instance = $this;
	}

	public function disconnect()
	{
		if ($this->connection) $this->connection = NULL;
	}

	public function raw($sql)
	{
		$this->_query = $sql;
	}

	public function setTable($table)
	{
		$this->_table = $table;
	}

	public static function query($sql)
	{
		global $app;
		$results = [];
		$statement = $app->DB->connection->prepare($sql);
		$statement->execute();
		while ($row = $statement->fetchObject())
		{
			$results[] = $row;
		}
		$statement->closeCursor();
		$statment = NULL;
		return $results;
	}

	public static function queryOne($sql)
	{
		$results = self::query($sql);
		return ($results) ? $results[0] : NULL ;
	}

}