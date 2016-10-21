<?php

namespace System;

use Exception;

class View
{

	protected $_dir;
	protected $_view;
	protected $_variables = [];

	public function __construct()
	{
		$this->_dir = preg_replace('/system\/?$/', '', __DIR__) . "app/Views/";
	}

	public function render($view, $variables = [])
	{
		$filename = trim(str_replace(".", "/", $view), " /");
		$this->_view = "{$this->_dir}{$filename}.php";
		$this->_variables = array_merge($this->_variables, $variables);
		try {
			$this->_include($filename);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	private function _include($filename)
	{
		if ( ! is_file($this->_view)) throw new Exception("File 'app/Views/{$filename}.php' not found");
		extract($this->_variables, EXTR_OVERWRITE);
		include $this->_view;
	}

}