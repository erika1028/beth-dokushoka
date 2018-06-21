<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['content','user_id','item_id','point'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
