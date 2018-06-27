<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;

class ItemsController extends Controller
{
    public function create()
    {
        $title = request()->title;
        $items =[];
        if($title){
            $client= new\RakutenRws_Client();
            $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
            
            $rws_response = $client->execute('BooksBookSearch', [
                'title' => $title,
                'imageFlag' => 1,
                'hits' => 20,
            ]);

            foreach ($rws_response->getData()['Items'] as $rws_item) {
                $item = new Item();
                $item->title = $rws_item['Item']['title'];
                $item->author = $rws_item['Item']['author'];
                $item->url = $rws_item['Item']['itemUrl'];
                $item->image_url = str_replace('?_ex=120x120', '', $rws_item['Item']['mediumImageUrl']);
                $items[] = $item;
            }
        }

        return view('items.create', [
            'title' => $title,
            'items' => $items,
        ]);
    }
      public function show($id)
    {
      $user = \Auth::user();
      $item = Item::find($id);
      $want_users = $item->want_users;
      $read_users = $item->read_users;

      $data =[
          'item' => $item,
          'user' => $user,
          'want_users' => $want_users,
          'read_users' => $read_users,
      ];
      
      $data += $this->counts($user);
      return view('items.show',$data);
    }
}
