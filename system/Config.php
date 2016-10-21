<?php

namespace System;

class Config
{

	public function __construct($config_file = "config.php")
	{
		require_once base_path($config_file);
		foreach ($config as $key => $data) $this->$key = $data;
	}



}