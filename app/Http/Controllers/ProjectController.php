<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Profile;
use Auth;

class ProjectController extends Controller
{
    public function index(){
        return view('adminpages.project.listProject');
    }
    public function getviewproject(){
        $user = Profile::all();
        return view('layouts.component.project')->with(compact('user'));
    }
    public function addprojectview(){
        return view('adminpages.project.addProject');
    }
    public function editprojectview(){
        return view('adminpages.project.editProject');
    }
    public function getviewprojectdetail(){
        $user = Profile::all();
        return view('layouts.component.projectdetail')->with(compact('user'));
    }
    public function updateproject(Request $req, $id){
        if($req->isMethod('post')){
            $project = Project::where('id', $id)->get();
            foreach($project as $pj){
                $oldimg = $pj->imagepost;
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
                    $result = $req->file('imagepost')->storeOnCloudinary('projects');
                    $name = $result->getFileName();
               
                        Project::where('id', $id)->update([
                            'title' => $req->title,
                            'short_desc' => $req->short_desc,
                            'description' => $req->description,
                            'imagepost' => $name
                        ]);     
                    }
                    else{
                       
                        cloudinary()->destroy($oldimg);
                        $result = $req->file('imagepost')->storeOnCloudinary('projects');
                        $name = $result->getFileName();
                         Project::where('id', $id)->update([
                            'title' => $req->title,
                            'short_desc' => $req->short_desc,
                            'description' => $req->description,
                            'imagepost' => $name
                        ]);
                    }
                }
                Project::where('id', $id)->update([
                    'title' => $req->title,
                    'short_desc' => $req->short_desc,
                    'description' => $req->description,
                ]);
          
        }
    }
    public function deleteproject($id){
        $project = Project::where('id', $id)->get();
        foreach($project as $pj){
            $oldimg = $pj->imagepost;
        }
        cloudinary()->destroy($oldimg);
    Project::where('id', $id)->delete();
    }
    public function saveproject(Request $req){
        if($req->isMethod('post')){
            if($req->file('imagepost')){
        
                $result = $req->file('imagepost')->storeOnCloudinary('projects');
                $name = $result->getFileName();
         
                    $res = Project::create([
                        'title' => $req->title,
                        'user_id' => Auth::User()->id,
                        'short_desc' => $req->short_desc,
                        'description' => $req->content,
                        'imagepost' => $name
                    ]);
            }
            else{
                $res = Project::create([
                    'title' => $req->title,
                    'user_id' => Auth::User()->id,
                    'short_desc' => $req->short_desc,
                    'description' => $req->content,
                ]);
            }
            
           
        }
    }
}
