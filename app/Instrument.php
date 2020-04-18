<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $fillable = [
         'user_id', 'type', 'maker', 'instrument_name', 'price', 'comment', 'instrument_image'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorite', 'instrument_id', 'user_id')->withTimestamps();
    }
    
    public function comments()
   {
       return $this->hasMany(Comment::class);
   }
}
