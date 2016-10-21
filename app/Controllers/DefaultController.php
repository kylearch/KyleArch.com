<?php

namespace App\Controllers;

use App\Data\Post;

class DefaultController
{

	public function index()
	{
		$content = 'pages.index';
		view('layouts.main', compact('content'));
	}

	public function blog()
	{
		$content = 'pages.blog';
		$posts = Post::all();
		
		view('layouts.main', compact('content', 'posts'));
	}

	public function post($id)
	{
		$content = 'pages.post';
		$post = Post::find($id);

		view('layouts.main', compact('content', 'post'));
	}

}