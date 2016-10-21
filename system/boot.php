<?php

session_start();

$load = [
	'system/',
	'app/Controllers/',
	'app/Data/',
];

$exclude = [
	'system/boot.php',
	'system/Functions.php'
];

$root = str_replace("system", "", __DIR__);

foreach ($load as $directory)
{
	$directory_path = "{$root}{$directory}";
	$iterator = new \RecursiveDirectoryIterator($directory_path);
	$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);

	foreach (new \RecursiveIteratorIterator($iterator) as $file)
	{
		require_once $file;
	}
}
