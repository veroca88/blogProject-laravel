<?php

use Illuminate\Support\Facades\Route;

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
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    // Is the the hardcode way! "First step" when things are seen raw   
    // $post = file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html');
    $post = file_get_contents(__DIR__ . "/../resources/posts/{$slug}.html");

    // "Second step" separate the path to check if exist or not
    // $path = __DIR__ . "/../resources/posts/{$slug}.html";

    // if( ! file_exists($path)) {
        //dd show a small error message on the web -> quick debugging
        //ddd show a entire page of error message on the web - > ddd("File doesn't exist");
        //abort(404); shows message 404 NOT FOUND

    //     return redirect('/');
    // }

    // $post = file_get_contents($path);

    return view('post', [
        'post' => $post
    ]);
});
