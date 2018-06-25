<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Item;

class ItemUserController extends Controller
{
    public function want()
    {
        $title = request()->book_title;

        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('BooksBookSearch', [
            'title' => $title,
        ]);
        $rws_item = $rws_response->getData()['Items'][0]['Item'];

        $item = Item::firstOrCreate([
            'title' => $rws_item['title'],
            'author' => $rws_item['author'],
            'url' => $rws_item['itemUrl'],
            'image_url' => str_replace('?_ex=120x120', '', $rws_item['mediumImageUrl']),
        ]);

        \Auth::user()->want($item->id);

        return redirect()->back();
    }

    public function dont_want()
    {
        $title = request()->book_title;

        if (\Auth::user()->is_wanting($title)) {
            $itemId = Item::where('title', $title)->first()->id;
            \Auth::user()->dont_want($itemId);
        }
        return redirect()->back();
    }
    
    
    public function read()
    {
        $title = request()->book_title;

        $client = new \RakutenRws_Client();
        $client->setApplicationId(env('RAKUTEN_APPLICATION_ID'));
        $rws_response = $client->execute('BooksBookSearch', [
            'title' => $title,
        ]);
        $rws_item = $rws_response->getData()['Items'][0]['Item'];

        $item = Item::firstOrCreate([
            'title' => $rws_item['title'],
            'author' => $rws_item['author'],
            'url' => $rws_item['itemUrl'],
            'image_url' => str_replace('?_ex=120x120', '', $rws_item['mediumImageUrl']),
        ]);

        \Auth::user()->read($item->id);

        return redirect()->back();
    }

    public function dont_read()
    {
        $title = request()->book_title;

        if (\Auth::user()->is_reading($title)) {
            $itemId = Item::where('title', $title)->first()->id;
            \Auth::user()->dont_read($itemId);
        }
        return redirect()->back();
    }
    
    public function post()
    {
       
    }
    
}