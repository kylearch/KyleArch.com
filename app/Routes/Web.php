<?php

$routes = [
	'' => ['name' => 'index', 'controller' => 'DefaultController', 'method' => 'index', 'accepts' => ['get']],
	'blog' => ['name' => 'blog', 'controller' => 'DefaultController', 'method' => 'blog', 'accepts' => ['get']],
	'blog/{id}' => ['name' => 'blog.post', 'controller' => 'DefaultController', 'method' => 'post', 'accepts' => ['get']],
];