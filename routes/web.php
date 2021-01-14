<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Eloquent
|--------------------------------------------------------------------------
|
| Con fines prácticos el crud no se realizará en
| los controladores 
|
*/
use App\Models\Post;


Route::get('eloquent', function () {
    // $posts = Post::all();

    // $posts = Post::where('id','>=','10')
    //     ->get();

    // $posts = Post::where('id','>=','10')
    //     ->orderBy('id','desc')
    //     ->get();

    $posts = Post::where('id', '>=', '10')
        ->orderBy('id','desc')
        ->take(4)
        ->get();


    foreach($posts as $post) {
        echo "$post->id $post->title <br>";
    }
});
