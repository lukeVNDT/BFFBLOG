<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Image;
use File;

class AccountController extends Controller
{
    public function index(){
     
        return view('adminpages.account.account');
    }
    public function aboutme(){
        $user = Profile::all();
        return view('layouts.component.aboutme')->with(compact('user'));
    }
    public function saveuser(Request $req){
        $id = Auth::user()->id;
        $user = Profile::where('user_id', $id)->get();
        foreach($user as $person){
            $oldimg = $person->image;
        }
        if($user->count() > 0){
            if($req->image){
                if($req->image != $oldimg){
                    $image = $req->file('image');
                   $imagename = $image->getClientOriginalName();
                    $img = Image::make( $image)->resize(100, 100);
                    $upload_path = public_path()."/uploadimage/";
                    $img->save($upload_path.$imagename);
                    $imagesaved = $upload_path.$imagename;
                    $imageold = $upload_path.$oldimg;
                    Profile::where('user_id', $id)->update([
                        'user_id' => $id,
                        'firstname' => $req->firstname,
                        'lastname' => $req->lastname,
                        'number' => $req->number,
                        'address' =>  $req->address,
                        'country' => $req->country,
                        'shortdescription' => $req->shortdescription,
                        'details' => $req->details,
                        'fb_link' => $req->fb_link,
                        'github_link' => $req->github_link,
                        'image' => $imagename
                    ]);

                    // if(File::exists($imageold)){
                    //     File::delete(
                    //         $imageold
                    //             );
                    // }

                }
                else{
                    $image = $req->file('image');
                    $imagename = $image->getClientOriginalName();
                     $img = Image::make( $image)->resize(100, 100);
                     $upload_path = public_path()."/uploadimage/";
                     $img->save($upload_path.$imagename);
                     $imagesaved = $upload_path.$imagename;
                     Profile::where('user_id', $id)->update([
                        'user_id' => $id,
                        'firstname' => $req->firstname,
                        'lastname' => $req->lastname,
                        'number' => $req->number,
                        'address' =>  $req->address,
                        'country' => $req->country,
                        'shortdescription' => $req->shortdescription,
                        'details' => $req->details,
                        'fb_link' => $req->fb_link,
                        'github_link' => $req->github_link,
                        'image' => $imagename
                    ]);
                     if(File::exists($imagesaved)){
                         File::delete(
                             $upload_path.$imagename
                                 );
                     }
                }
            }

            Profile::where('user_id', $id)->update([
                'user_id' => $id,
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'number' => $req->number,
                'address' =>  $req->address,
                'country' => $req->country,
                'shortdescription' => $req->shortdescription,
                'details' => $req->details,
                'fb_link' => $req->fb_link,
                'github_link' => $req->github_link
            ]);
            
        }
       else{
        if($req->image){
                $image = $req->file('image');
               $imagename = $image->getClientOriginalName();
                $img = Image::make( $image)->resize(100, 100);
                $upload_path = public_path()."/uploadimage/";
                $img->save($upload_path.$imagename);
                $imagesaved = $upload_path.$imagename;
                Profile::create([
                    'user_id' => $id,
                    'firstname' => $req->firstname,
                    'lastname' => $req->lastname,
                    'number' => $req->number,
                    'address' =>  $req->address,
                    'country' => $req->country,
                    'shortdescription' => $req->shortdescription,
                    'details' => $req->details,
                    'fb_link' => $req->fb_link,
                    'github_link' => $req->github_link,
                    'image' => $imagename
                ]);

                // if(File::exists($imageold)){
                //     File::delete(
                //         $imageold
                //             );
                // }

            
           
        }
        else{
            Profile::create([
                'user_id' => $id,
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'number' => $req->number,
                'address' =>  $req->address,
                'country' => $req->country,
                'shortdescription' => $req->shortdescription,
                'details' => $req->details,
                'fb_link' => $req->fb_link,
                'github_link' => $req->github_link
            ]);
        }

       }
        
    }
    public function getuser(){
        
        $profile = Profile::with('user')->get();

        return response()->json(
            $profile
        );

    }
    public function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
