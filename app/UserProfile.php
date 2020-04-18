<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
         'user_id', 'name', 'gender', 'birth_place', 'profile_image', 'comment'
    ];
    
    protected function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
