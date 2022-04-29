<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $allPosts = Post::all();

        $response = Http::get('https://api.weatherbit.io/v2.0/current?&postal_code=1000&country=MK&key=d6106cb90a0e43d3ac7d68e80602e52f&units=M');

        $data = json_decode($response->body()); 
        $icon = $data->data[0]->weather->icon;
        $temp = $data->data[0]->temp;



        $response = Http::withHeaders([
            'app-id' => '6268527d8fd8a37e35300290'
        ])->get('https://dummyapi.io/data/v1/user');
    
        $users = json_decode($response->body())->data;
    

        return view('home', ['posts' => $allPosts, 'icon' => $icon, 'temp' => $temp, 'users' => $users]);
    }

    public function byCategory($id)
    {
        $posts = Category::findOrFail($id)->posts;
        return view('home', compact('posts'));
    }
}
