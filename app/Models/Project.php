<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title','short_desc', 'description','imagepost','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
