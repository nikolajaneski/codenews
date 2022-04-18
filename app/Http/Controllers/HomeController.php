<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();

        return view('home', ['posts' => $allPosts]);
    }
}