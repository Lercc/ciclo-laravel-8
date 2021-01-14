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

Route::get('posts', function () {
    $posts = Post::all();

    foreach($posts as $post) {
        echo "$post->id - <b>{$post->user->name}</b> - $post->title <br>";
    }
});


Use App\Models\User;

Route::get('users', function () {
    $users = User::all();

    foreach($users as $user) {
        echo "$user->id - <b>{$user->name}</b> - {$user->posts->count()} <br>";
    }
});

