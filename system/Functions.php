<?php

use System\View;
use System\Config;
use System\Router;

/**
 * Global View Render function
 */
if ( ! function_exists('view'))
{
	function view($view_file, $variables = [])
	{
		global $app;
		$view = (isset($app->View)) ? $app->View : new View();
		$view->render($view_file, $variables);
	}
}

/**
 * Global link to public file
 */
if ( ! function_exists('asset'))
{
	function asset($file)
	{
		return base_url($file);
	}
}

/**
 * Generate URL starting with Base URL
 */
if ( ! function_exists('base_url'))
{
	function base_url($file = NULL)
	{
		$url_parts = Router::parseUrl(Router::deriveUrl());
		$url = $url_parts['scheme'] . "://" . $url_parts['host'] . "/";
		if ( ! is_null($file)) $url .= $file;
		return $url;
	}
}

/**
 * Generate path from project root
 */
if ( ! function_exists('base_path'))
{
	function base_path($file = NULL)
	{
		$path = preg_replace('/system\/?$/', '', __DIR__);
		if ( ! is_null($file)) $path .= $file;
		return $path;
	}
}

/**
 * Read file
 */
if ( ! function_exists('file_contents'))
{
	function file_contents($file)
	{
		$filepath = base_path($file);
		return (is_file($filepath)) ? file_get_contents($filepath) : NULL ;
	}
}

/**
 * Get Namespace
 */
if ( ! function_exists('getNamespace'))
{
	function getNamespace($area)
	{
		return "\\app\\Controllers\\";
	}
}

/**
 * Get secret value
 */
if ( ! function_exists('secret'))
{
	function secret($key, $default = '')
	{
		$secrets = file(base_path(".secret"));
		foreach ($secrets as $secret)
		{
			if (strpos($secret, "{$key}=") === 0) return trim(str_replace("{$key}=", "", $secret));
		}
		return NULL;
	}
}

/**
 * Get config value
 */
if ( ! function_exists('config'))
{
	function config($key, $default = '')
	{
		global $app;
		$keys = explode(".", $key);
		$object_key = array_shift($keys);
		$ref = $app->Config->$object_key;
		if (isset($ref))
		{
			if (is_array($ref))
			{
				foreach ($keys as $key) $ref = $ref[$key];
				return $ref;
			}
			else
			{
				return $ref;
			}
		}
	}
}