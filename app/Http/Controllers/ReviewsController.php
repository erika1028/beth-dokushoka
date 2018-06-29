<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Review;

use App\Item;

use App\User;

class ReviewsController extends Controller
{

     
    
   public function store(Request $request)
    {

          $this->validate($request, [
            'content' => 'required|max:20000',
            'item_id'=> 'required',
        ]);
        $request->user()->reviews()->create([
            'content' => $request->content,
            'item_id' => $request->item_id,
        ]);
        return redirect(route('items.show', $request->item_id));
    }
    
      public function destroy($id)
    {
        $review = \App\Review::find($id);

        if (\Auth::id() === $review->user_id) {
            $review->delete();
        }

        return redirect()->back();
    }
    
     public function timeline()
    {
        $data = [];
        
            $user = \Auth::user();
            $reviews = $user->feed_reviews()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'reviews' => $reviews,
            ];
        
        return view('timeline', $data);
    }
    
}