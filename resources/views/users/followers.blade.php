@extends('layouts.app')

@section('content')
      　<div class="user-profile col-md-12">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="img-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
       </div>
            @include('user_follow.follow_button', ['user' => $user])
        
           <div class="status text-center">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item" ><a href="{{ Request::is('users/*/want') ? 'active' : '' }}"><a href="{{ route('users.want_items', ['id' => $user->id]) }}" class="nav-link">WANT <span class="badge">{{ $count_want }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/read') ? 'active' : '' }}"><a href="{{ route('users.read_items', ['id' => $user->id]) }}" class="nav-link">READ <span class="badge">{{ $count_read }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link"><span class="badge">{{ $count_followings }}</span>Followings </a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link active"><span class="badge">{{ $count_followers }}</span>Followers </a></li>
            </ul>
            @include('users.users', ['users' => $users])
        </div>
@endsection