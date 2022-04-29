<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{id}', [HomeController::class, 'byCategory']);

// front page post
Route::get('/post/{id}', [PostController::class, 'singlePost'])->name('post');

// comments
Route::post('/post/{id}/comment', [CommentController::class, 'store']);
// this is with route model binding
Route::get('/comment/{comment}', [CommentController::class, 'edit']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
Route::put('/comment/{id}', [CommentController::class, 'update']);


// admin panel
Route::get('/admin', function() {
    return view('dashboard');
});

// categories
Route::get('/admin/categories', [CategoryController::class, 'index']);
Route::post('/admin/category', [CategoryController::class, 'store']);

Route::get('/admin/tags', [TagController::class, 'index']);
Route::post('/admin/tags', [TagController::class, 'store']);

// admin post
Route::get('/admin/posts', [PostController::class, 'index']);
Route::get('/admin/post/{id}', [PostController::class, 'show']);
Route::get('/admin/post', [PostController::class, 'create']);
Route::post('/admin/post', [PostController::class, 'store']);


Route::post('/getAutocompleteTags', [TagController::class, 'getAutocompleteTags']);

// composer require guzzlehttp/guzzle

Route::get('/cat-fact', function() {

    $response = Http::get('https://catfact.ninja/fact');
    
    $factArr = json_decode($response->body(), true);

    return $factArr['fact'];

});


Route::get('/bitcoin-stats', function() {
    $response = Http::get('https://api.coindesk.com/v1/bpi/currentprice.json');

    $data = json_decode($response->body());

    return 'Current price of BTC is ' . $data->bpi->USD->rate . ' $';

});

Route::get('/user/create', function() {


    $response = Http::withHeaders([
        'app-id' => '6268527d8fd8a37e35300290'
    ])
    ->withBody(json_encode([
            'firstName' => 'Nikola',
            'lastName' => 'Janeski',
            'email' => 'nikola2.janeski@gmail.com'
    ]), 'application/json')
    ->post('https://dummyapi.io/data/v1/user/create');

dd($response->body());
    $users = json_decode($response->body())->data;


    dd($users[0]);
});

