<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\User;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
     public function read_items()
    {
        return $this->items()->where('type', 'read')->withTimeStamps();
    }
    
    /* public function read_items()
    {
        return $this->belongsToMany(Item::class, 'item_user', 'user_id', 'item_id')->withTimestamps();
    }*/

     public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('type')->withTimestamps();
    }

    public function want_items()
    {
        return $this->items()->where('type', 'want');
    }

    public function want($itemId)
    {
        $exist = $this->is_wanting($itemId);

        if ($exist) {
            return false;
        } else {
            $this->items()->attach($itemId, ['type' => 'want']);
            return true;
        }
    }

    public function dont_want($itemId)
    {
        $exist = $this->is_wanting($itemId);

        if ($exist) {
            \DB::delete("DELETE FROM item_user WHERE user_id = ? AND item_id = ? AND type = 'want'", [\Auth::user()->id, $itemId]);
        } else {
            return false;
        }
    }

    public function is_wanting($itemIdOrCode)
    {
        if (is_numeric($itemIdOrCode)) {
            $item_id_exists = $this->want_items()->where('item_id', $itemIdOrCode)->exists();
            return $item_id_exists;
        } else {
            $item_title_exists = $this->want_items()->where('title', $itemIdOrCode)->exists();
            return $item_title_exists;
        }
    }
    
   

    public function read($itemId)
    {
        $exist = $this->is_reading($itemId);

        if ($exist) {
            return false;
        } else {
            $this->items()->attach($itemId, ['type' => 'read']);
            return true;
        }
    }

    public function dont_read($itemId)
    {
        $exist = $this->is_reading($itemId);

        if ($exist) {
            \DB::delete("DELETE FROM item_user WHERE user_id = ? AND item_id = ? AND type = 'read'", [\Auth::user()->id, $itemId]);
        } else {
            return false;
        }
    }

    public function is_reading($itemId)
    {
        if (is_numeric($itemId)) {
            $item_id_exists = $this->read_items()->where('item_id', $itemId)->exists();
            return $item_id_exists;
        } else {
            $item_title_exists = $this->read_items()->where('title', $itemId)->exists();
            return $item_title_exists;
        }
    }
    
       public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
{
    $exist = $this->is_following($userId);
    $its_me = $this->id == $userId;

    if ($exist || $its_me) {
        return false;
    } else {
        $this->followings()->attach($userId);
        return true;
    }
}

public function unfollow($userId)
{
    $exist = $this->is_following($userId);
    $its_me = $this->id == $userId;


    if ($exist && !$its_me) {
        $this->followings()->detach($userId);
        return true;
    } else {
        return false;
    }
}


public function is_following($userId) {
    return $this->followings()->where('follow_id', $userId)->exists();
}
    
}
