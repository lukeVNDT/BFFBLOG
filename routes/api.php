<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/getcategory', function(Request $req){
    $cate = Category::all();
    return response()->json(
       $cate
    );
});

Route::get('/getpost', function(Request $req){
    $post = Post::join('profile', 'profile.user_id', '=', 'posts.user_id')
    ->select('*', 'posts.id as postid')->paginate(6);
    return response()->json(
       $post
    );
});

Route::get('/geteditcategory/{id}', function($id){
    $cate = Category::where('id', $id)->get();
    return response()->json(
       $cate
    );
});

Route::get('/geteditpost/{id}', function($id){
    $post = Post::where('id', $id)->get();
    return response()->json(
       $post
    );
});

Route::get('/post', function(Request $req){
    if(!empty($req->keywords)){
        $post = Post::join('profile', 'profile.user_id', '=', 'posts.user_id')
        ->where('title','LIKE','%'.$req->keywords.'%')->select('*', 'posts.id as postid')->paginate(6);
        return response()->json(
           $post
        );
    }
    else{
        $post = Post::join('profile', 'profile.user_id', '=', 'posts.user_id')
    ->select('*', 'posts.id as postid')->paginate(6);
    return response()->json(
       $post
    );
    }
    
});

Route::get('/getresultpost', function(Request $req){
    if($req->keywords != ''){
        $post = Post::join('profile', 'profile.user_id', '=', 'posts.user_id')
        ->where('title','LIKE','%'.$req->keywords.'%')->select('*', 'posts.id as postid')->paginate(6);
        return response()->json(
           $post
        ); 
    }
    else if(empty($req->keywords)){
        $post = Post::join('profile', 'profile.user_id', '=', 'posts.user_id')
    ->select('*', 'posts.id as postid')->paginate(6);
    return response()->json(
       $post
    );
    }
    
});
Route::get('/getproject', function(Request $req){
    $project = Project::join('profile', 'profile.user_id', '=', 'projects.user_id')
    ->select('*', 'projects.id as projectid')->paginate(6);
    return response()->json(
       $project
    );
});

Route::get('/geteditproject/{id}', function($id){
    $project = Project::where('id', $id)->get();
    return response()->json(
       $project
    );
});

Route::get('/getresultproject', function(Request $req){
    if($req->page != ''){
        $project = Project::join('profile', 'profile.user_id', '=', 'projects.user_id')
        ->select('*', 'projects.id as projectid')->paginate(6);
        return response()->json(
           $project
        ); 
    }
    
    
});



