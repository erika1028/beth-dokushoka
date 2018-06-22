@extends('layouts.app')

@section('content')
<div class="user-profile mt-3">
  　<div class="main-part col-md-3 text-center float-left ">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="rounded-circle">
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
            @include('user_follow.follow_button', ['user' => $user])
            <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
 <li class="nav-item" ><a href="{{ Request::is('users/*/') ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link">BOOKS <span class="badge badge-light">{{ $count_items }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/') ? 'active' : '' }}"><a href="{{ route('users.want_items', ['id' => $user->id]) }}" class="nav-link">WANT <span class="badge badge-light">{{ $count_want }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/read') ? 'active' : '' }}"><a href="{{ route('users.read_items', ['id' => $user->id]) }}" class="nav-link">READ <span class="badge badge-light">{{ $count_read }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link active">Followings <span class="badge badge-light">{{ $count_followings }}</span></a></li>
                <li class="nav-item" ><a href="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link">Followers <span class="badge badge-light">{{ $count_followers }}</span></a></li>
           </ul>
    </div>
        
        <div class="tab-content">
            @include('users.users', ['users' => $users])
        </div>
</div>
@endsection