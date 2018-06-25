<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Item;

use App\User;

class ReviewsController extends Controller
{
      public function index()
    {
            $data = [];
            $user = \Auth::user();
            $item = Item::find();
            $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'item' =>$item,
                'review' =>$review,
                'reviews' => $reviews,
            ];
            
            $data += $this->counts($user);
            return view('items.show', $data);
    }
    
      public function store(Request $request)
    {  
        $user = \Auth::user();
        $item = Item::find();
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

          $request->user()->reviews()->create([
            'content' => $request->content,
            'item_id' => $item->id,
            
        ]);
        
        
        return redirect()->back();
    }
    
      public function destroy($id)
    {
        $review = \App\Review::find($id);

        if (\Auth::id() === $review->user_id) {
            $review->delete();
        }

        return redirect()->back();
    }
    
}