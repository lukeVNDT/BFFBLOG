<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','category_id', 'title','short_desc', 'description','imagepost','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
