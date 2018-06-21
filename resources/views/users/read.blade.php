@extends('layouts.app')

@section('content')
 　　　　　<div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
              
        <div class="status text-center">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('users/*/want_items') ? 'active' : '' }}"><a href="{{ route('users.want_items', ['id' => $user->id]) }}">WANT</a></li>
                <li role="presentation" class="{{ Request::is('users/*/read-items') ? 'active' : '' }}"><a href="{{ route('users.read_items', ['id' => $user->id]) }}">READ</a></li>
            </ul>
              @include('items.items', ['items' => $items])
        </div>
    </div>
@endsection