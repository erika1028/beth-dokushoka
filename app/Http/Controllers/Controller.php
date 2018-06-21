<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function counts($user) {
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        $count_want = $user->want_items()->count();
        $count_read = $user->read_items()->count();

        return [
           'count_want' => $count_want,
            'count_read' => $count_read,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
        ];
    }
}


