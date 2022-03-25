<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'user_id','firstname','lastname', 'number', 'address', 'country', 'shortdescription', 'details','fb_link','github_link', 'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
