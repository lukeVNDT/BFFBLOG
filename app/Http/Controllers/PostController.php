<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Profile;
use Image;
use Auth;
use File;
use Cloudder;

class PostController extends Controller
{
    public function index(){
        return view('adminpages.post.addPost');
    }
    public function postdetail(){
        $user = Profile::all();
        return view('layouts.component.postdetail')->with(compact('user'));
    }
    public function savepost(Request $req, $id){
        if($req->isMethod('post')){
            $post = Post::where('id', $id)->get();
            foreach($post as $posts){
                $oldimg = $posts->imagepost;
            }
                if($req->imagepost){
                    if($req->file('imagepost')->getClientOriginalName() != $oldimg){
                    // old code backup
                    //     $image = $req->file('imagepost');
                    //    $imagename = $image->getClientOriginalName();
                    //     $img = Image::make($image);
                    //     $upload_path = public_path()."/uploadimage/";
                    //     $imagesaved = $upload_path.$imagename;
                    //     $imageold = $upload_path.$oldimg;
                    cloudinary()->destroy($oldimg);
                    $result = $req->file('imagepost')->storeOnCloudinary('posts');
                    $name = $result->getFileName();
               
                        Post::where('id', $id)->update([
                            'title' => $req->title,
                            'short_desc' => $req->short_desc,
                            'category_id' => $req->category_id,
                            'description' => $req->description,
                            'imagepost' => $name
                        ]);     
                    }
                    else{
                       
                        cloudinary()->destroy($oldimg);
                        $result = $req->file('imagepost')->storeOnCloudinary('posts');
                        $name = $result->getFileName();
                         Post::where('id', $id)->update([
                            'title' => $req->title,
                            'category_id' => $req->category_id,
                            'short_desc' => $req->short_desc,
                            'description' => $req->description,
                            'imagepost' => $name
                        ]);
                    }
                }
                Post::where('id', $id)->update([
                    'title' => $req->title,
                    'category_id' => $req->category_id,
                    'short_desc' => $req->short_desc,
                    'description' => $req->description,
                ]);
          
        }
    }
    public function editpost($id){
        $res = Post::where('id', $id)->get();

        return view('adminpages.post.editPost');
    }
    public function deletepost($id){
        $post = Post::where('id', $id)->get();
            foreach($post as $posts){
                $oldimg = $posts->imagepost;
            }
            cloudinary()->destroy($oldimg);
        Post::where('id', $id)->delete();
    }

    public function listpost(){
        return view('adminpages.post.ListPost');
    }
    
    public function getAllPost(){
        $post = Post::with('category', 'user')->orderBy('id','DESC')->get();

        return response()->json([
            'posts' => $post
        ], 200);
    }
    public function addpost(Request $req){
        // dd($req->all());
        if($req->isMethod('post')){
            if($req->file('imagepost')){
        
                $result = $req->file('imagepost')->storeOnCloudinary('posts');
                $name = $result->getFileName();
         
                    $res = Post::create([
                        'title' => $req->title,
                        'category_id' => $req->category_id,
                        'user_id' => Auth::User()->id,
                        'short_desc' => $req->short_desc,
                        'description' => $req->content,
                        'imagepost' => $name
                    ]);
            }
            else{
                $res = Post::create([
                    'title' => $req->title,
                    'category_id' => $req->category_id,
                    'user_id' => Auth::User()->id,
                    'short_desc' => $req->short_desc,
                    'description' => $req->content,
                ]);
            }
            
           
        }
    }
   
}
