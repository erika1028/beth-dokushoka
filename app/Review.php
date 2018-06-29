<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['content','point','item_id', 'user_id'];
    
  public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
