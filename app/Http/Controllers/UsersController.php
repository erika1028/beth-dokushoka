<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\User;

use App\Item;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $count_items = $user->items()->count();
        $count_want = $user->want_items()->count();
        $count_read = $user->read_items()->count();
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->paginate(10);

        return view('users.show', [
            'user' => $user,
            'items' => $items,
            'count_items' => $count_items,
            'count_want' => $count_want,
            'count_read' => $count_read,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
        ]);
    }
     public function followings($id)
    {
        $user = User::find($id);
        $count_followings = $user->followings()->count();
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
            'count_followings' => $count_followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $count_followers = $user->followers()->count();
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
            'count_followers' => $count_followers,
            
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    public function read_items($id)
    {
        $user = User::find($id);
        $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->paginate(20);
        $read_items = $user->read_items()->paginate(10);

        $data = [
            'user' => $user,
            'items' => $items,
            'read_items' =>$read_items,
        ];

        $data += $this->counts($user);

        return view('users.read', $data);
    }
    
    
      public function want_items($id)
    {
    
         $user = User::find($id);
         $items = \DB::table('items')->join('item_user', 'items.id', '=', 'item_user.item_id')->select('items.*')->where('item_user.user_id', $user->id)->distinct()->paginate(20);
         $want_items = $user->want_items()->paginate(10);

        $data = [
            'user' => $user,
            'items' => $items,
            'want_items' => $want_items,
        ];

        $data += $this->counts($user);

        return view('users.want', $data);
    }
    
    
    
       public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function settings()
    {
        $user = User::find(auth()->id());

        return view('users.setting', compact('user'));
    }

    
     public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                'required',
                'file',
                'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $filename = $request->file->store('public/avatar');

            $user = User::find(auth()->id());
            $user ->avatar_filename = basename($filename);
            $user ->save();

            return redirect('/');
            
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors;
        }
    }

    
}