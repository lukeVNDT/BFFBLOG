<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function deletecate($id){
        $res = Category::where('id', $id)->delete();
        if($res) {
            return 'success';
        }
        else{
            return 'failed';
        }
    }
    public function savecat($id, Request $req){
       if($req->isMethod('post')){
        $res = Category::where('id', $id)->update([
            'name' => $req->name,
            'description' => $req->description
        ]);

        if($res){
            return 'category successfully added!';
        }
        else{
            return 'failed';
        }
       }
    }
    public function editcat($id){
        $res = Category::where('id', $id)->get();

        return view('adminpages.category.EditCategory');
    }
    public function listcategory(){
        return view('adminpages.category.category');
    }
    public function addcat(Request $req){
        if($req->isMethod('post')){
            $res = Category::insert([
                'name' => $req->name,
                'description' => $req->content
            ]);

            if($res){
                return 'category successfully added!';
            }
            else{
                return 'failed';
            }
        }
    }
    public function index(){
        return view('adminpages.category.addCategory');
    }
    public function addCategory(Request $req){
        $this->validate($req,[
            'name' => 'required|min:3|max:40'
        ]);
        $cate = new Category();
        $cate->name = $req->name;
        $cate->save();
        return ['message'=>'OK'];

    }
    public function getAllCategory(){
        $allCate = Category::all();
        return response()->json(['categories' => $allCate, 200]);
    }
    public function updateCategory($id){
        $category = Category::find($id);
        return response()->json([
            'categories' => $category
        ]);
    }
    public function saveCategory(Request $req, $id){
        $cate = Category::find($id);
        $cate->update([
            'name' => $req->name
        ]);

    }
    public function deleteCategory($id){
        Category::find($id)->delete();
    }

}
