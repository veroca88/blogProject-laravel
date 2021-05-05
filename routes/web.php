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
    // remember this {post} param should also be in the post.blade.php (VIEWS)

    // 1. Is this the hardcode way! "First step" when things are seen raw   
    // $post = file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html');
    // $post = file_get_contents(__DIR__ . "/../resources/posts/{$slug}.html");

    // 2. "Second step" separate the path to check if exist or not
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    // ddd($path);

    if( ! file_exists($path)) {
        //dd show a small error message on the web -> quick debugging
        //ddd show a entire page of error message on the web - > ddd("File doesn't exist");
        // abort(404); // shows message 404 NOT FOUND       
        return redirect('/');
    }

    // To cache and see the path (traditional way)
    // 5 is TTL or instead we can use now()->addDay() or now()->addMinutes()
    // (old version of function structure) ===     
    $post = cache()->remember("post.{$slug}", 5, function () use ($path) {
        var_dump('file_get_content');
        return  file_get_contents($path);
    });
    // (arrow function, new version) === 
    // fn() => file_get_content($path)

    // $post = file_get_contents($path);

    return view('post', [
        'post' => $post
    ]);
    // Below in where we are saying that in our url should be any letter
    // from A to Z upper or lower case ->whereAlpha('post'); 
})->where('post', '[A-z_\-]+');
