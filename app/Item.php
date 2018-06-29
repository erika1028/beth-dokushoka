<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $fillable = ['title', 'author','publishername','url', 'image_url'];

     public function reviews()
    {
        return $this->hasMany(Review::class)->paginate(20);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('type')->withTimestamps();
    }

    public function want_users()
    {
        return $this->users()->where('type', 'want');
    }
    
    public function read_users()
    {
        return $this->users()->where('type', 'read');
    }
    
  
}
