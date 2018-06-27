<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewItemController extends Controller
{
    public function post()
    {
     \Auth::user()->post($review->id);
     return redirect()->back();
    }
}
