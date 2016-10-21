<?php

namespace System;

use Exception;

class Router
{

	protected $_url;
	protected $_path;
	protected $_name;
	protected $_method;
	protected $_controller;
	protected $_http_method;
	protected $_accepts;
	protected $_route;
	protected $_args;

	public $url = [];
	public $route = [];
	public $routes = [];
	public $controller;

	public function __construct()
	{
		try {
			$this->_compileRoutes();
			$this->_http_method = $_SERVER['REQUEST_METHOD'];
			$this->_url         = self::deriveUrl();
			$this->url          = self::parseUrl($this->_url);
			$this->route        = $this->_parseRoute($this->url['path']);
			$this->_args        = $this->getRouteArgs();
		} catch (Exception $e) {
			$code = $e->getCode();
			$message = $e->getMessage();
			view("errors.{$code}", compact('message', 'code'));
			exit();
		}
	}

	public function getUrl()
	{
		return $this->_url;
	}

	public function getPath()
	{
		return $this->_path;
	}

	public function getRouteArgs()
	{
		$route_parts = explode("/", $this->_route);
		$path_parts = explode("/", $this->_path);
		$args = [];

		foreach ($route_parts as $index => $part)
		{
			if (preg_match('/{[^}]+}/', $part))
			{
				$key = trim($part, "{}");
				$args[$key] = $path_parts[$index];
			}
		}

		return $args;
	}

	public function go()
	{
		call_user_func_array([$this->controller, $this->_method], $this->_args);
	}

	private function _compileRoutes()
	{

		$route_files = glob("../app/Routes/*.php");
		foreach ($route_files as $route_file)
		{
			include $route_file;
			$this->routes = array_merge($this->routes, $routes);
		}
	}

	private function _parseRoute($path = NULL)
	{
		foreach ($this->routes as $path => $route)
		{
			$parts = explode("/", $path);
			$pattern = "/^" . preg_replace('/{[^}]+}/', '[^\/]+', str_replace("/", "\/", $path)) . "$/";
			if (preg_match($pattern, $this->url['path']))
			{
				$this->_route = $path;
				$this->_path = $this->url['path'];

				foreach ($route as $key => $value) $this->{"_$key"} = $value;
				$controller = getNamespace('controller') . $this->_controller;
				$this->controller = new $controller;

				if ( ! method_exists($this->controller, $this->_method)) throw new Exception("Controller '{$this->_controller}' does not have a method named '{$this->_method}'");

				$this->_args = $this->getRouteArgs();

				return $this->routes[$path];
			}
		}
		throw new Exception("Route Note Found", 500);
	}

	public static function deriveUrl()
	{
		return $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	public static function parseUrl($url = NULL, $key = NULL)
	{
		$url_parts = parse_url($url);
		if (isset($url_parts['path'])) $url_parts['path'] = trim($url_parts['path'], " /");
		if ( ! is_null($key) && isset($url_parts[$key])) return trim($url_parts[$key], " /");
		return ( ! is_null($key)) ? FALSE : $url_parts ;
	}

}