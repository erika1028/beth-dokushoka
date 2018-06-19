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
    
    public function read_items()
    {
        return $this->items()->where('type', 'read');
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

    public function is_reading($itemIdOrCode)
    {
        if (is_numeric($itemIdOrCode)) {
            $item_id_exists = $this->read_items()->where('item_id', $itemIdOrCode)->exists();
            return $item_id_exists;
        } else {
            $item_title_exists = $this->read_items()->where('title', $itemIdOrCode)->exists();
            return $item_title_exists;
        }
    }
    
}
