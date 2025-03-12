<?php

use App\Http\Controllers\Api\HealthCheckController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsWebController;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('posts.index');
});*/

Route::get('/', [HomeController::class, 'index'])->name('index.home');
Route::get('/home', [HomeController::class, 'index'])->name('index.home');
Route::get('/welcome', [HomeController::class, 'welcomePage'])->name('index.welcome');

Route::prefix('index')->group(function (){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/welcome', [HomeController::class, 'welcomePage'])->name('welcome');
});

Route::prefix('api')->group(function (){
    Route::get('/checkhealth', [HealthCheckController::class, 'check']);

    Route::post('/storeposts', [PostsController::class, 'storeData'])->name('api.posts.input');
    Route::get('/listposts', [PostsController::class, 'listData']);
    Route::get('/findposts/{id}', [PostsController::class, 'findData']);
    Route::delete('/deleteposts/{id}', [PostsController::class, 'deleteData']);
    Route::put('/updateposts/{id}', [PostsController::class, 'updateData']);
    //Route::post('/updateposts', [PostsController::class, 'updateData']);
    Route::get('/findpostsbyauthors/{keyword}', [PostsController::class, 'findByAuthors']);

    Route::resource('/categoryposts', \App\Http\Controllers\Api\CategoryPostsController::class);
});

Route::get('/listposts', [PostsWebController::class, 'index'])->name('posts.list');
Route::get('/listpostscomponent', [PostsWebController::class, 'listComponent'])->name('posts.list.component');
Route::get('/inputposts', [PostsWebController::class, 'createData'])->name('posts.input');
Route::post('/saveposts', [PostsWebController::class, 'saveData'])->name('posts.save');

