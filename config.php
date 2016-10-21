<?php

$config = [

	'database' => [
		'app' => [
			'host' => secret('DB_HOST'),
			'user' => secret('DB_USER'),
			'pass' => secret('DB_PASS'),
			'name' => secret('DB_NAME'),
		]
	],

];