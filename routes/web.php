<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CommentsController;
use App\Http\Middleware\admin;
use App\Models\Post;

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
    $posts=Post::orderBy('created_at','DESC')->paginate(2);
    $lastAddedPosts=Post::orderBy('created_at','DESC')->take(3)->get();
    return view('index',compact('posts','lastAddedPosts'));
});

     

Auth::routes ();
Route::group(['middleware'=>['auth','admin']], function() {
    Route::get('/posts/create',function(){
    });
});

Route::get('/post/create', [PostsController::class,'create'])->name('posts.create');
Route::get('/post/show', [PostsController::class,'show'])->name('posts.show');
Route::get('/post/store', [PostsController::class,'store'])->name('posts.store');
Route::post('/post/{id}', [PostsController::class,'update'])->name('posts.update');
Route::get('/post/{id}', [PostsController::class,'destroy'])->name('posts.destroy');
Route::post('/post/{id}', [PostsController::class,'update'])->name('posts.update');
Route::get('/post/{id}', [PostsController::class,'destroy'])->name('posts.destroy');
Route::post('/posts/search', [PostsController::class,'search'])->name('posts.search');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::get('/users/login', [UsersController::class, 'login'])->name('users.login');

Route::post('/users/register', [UsersController::class, 'register'])->name('users.register');
Route::get('/users/logout', [UsersController::class, 'logout'])->name('users.logout');
Route::post('/users/auth', [UsersController::class, 'auth'])->name('users.auth');
Route::post('/comments/add', [CommentsController::class, 'store'])->name('comments.store');

