<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\admin;
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
    return view('home');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::get('/logout', [App\Http\Controllers\AccountController::class, 'logout']);
Route::get('/user', [App\Http\Controllers\AccountController::class, 'getuser']);
Route::get('/aboutme', [App\Http\Controllers\AccountController::class, 'aboutme']);
Route::post('/saveuserinfo', [App\Http\Controllers\AccountController::class, 'saveuser']);
Route::get('/backend', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin')->middleware(admin::class);;
Route::get('/add-category', [App\Http\Controllers\CategoryController::class, 'index']);
Route::get('/addpost', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/postdetail/{id}', [App\Http\Controllers\PostController::class, 'postdetail']);
Route::get('/post', [App\Http\Controllers\PostController::class, 'listpost']);
Route::delete('/post/{id}', [App\Http\Controllers\PostController::class, 'deletepost']);
Route::delete('/category/{id}', [App\Http\Controllers\CategoryController::class, 'deletecate']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'listcategory']);
Route::any('save-post', [App\Http\Controllers\PostController::class, 'addpost']);
Route::any('save-category', [App\Http\Controllers\CategoryController::class, 'addcat']);
Route::any('edit-category/{id}', [App\Http\Controllers\CategoryController::class, 'editcat']);
Route::any('edit-post/{id}', [App\Http\Controllers\PostController::class, 'editpost']);
Route::any('save-category/{id}', [App\Http\Controllers\CategoryController::class, 'savecat']);
Route::any('save-post/{id}', [App\Http\Controllers\PostController::class, 'savepost']);
// Route::group(['prefix' => 'admin', 'middleware' => ['auth' => 'admin']], function(){
//     Route::get('/backend', function(){
//             return view('admin.index');
//     });
//     Route::any('addPost', 'adminController@addPost');
//     Route::any('posts', 'adminController@posts');

// });
