<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
         'comment', 'instrument_id'
    ];
    
    public function instrument()
   {
       return $this->belongsTo(Instrument::class);
   }
   
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
