<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ReviewsController extends Controller
{
      public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $reviews = $user->reviews()->orderBy('created_at', 'desc')->paginate(10);
            $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->paginate(20);

            $data = [
                'user' => $user,
                'items' => $items,
                'reviews' => $reviews,
            ];
            
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
    
      public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->reviews()->create([
            'content' => $request->content,
        ]);
        
         $request->item()->reviews()->create([
            'content' => $request->content,
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