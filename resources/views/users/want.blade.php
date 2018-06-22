@extends('layouts.app')

@section('content')
<div class="user-profile">
  　<div class="main-part col-md-3 text-center float-left">
        <div class="icon text-center">
             @if ($user->avatar_filename)
              <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar"class="rounded-circle" style="width: 150px;height: 150px;"/>
             @else
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="rounded-circle">
            @endif
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
            @include('user_follow.follow_button', ['user' => $user])
            <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                 <li class="nav-item" class="{{ Request::is('users/*/') ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link">BOOKS <span class="badge badge-light">{{ $count_items }}</span></a></li>
                <li class="nav-item" class="{{ Request::is('users/*/want') ? 'active' : '' }}"><a href="{{ route('users.want_items', ['id' => $user->id]) }}" class="nav-link active"><i class="fas fa-heart"></i> WANT <span class="badge badge-light">{{ $count_want }}</span></a></li>
                <li class="nav-item" class="{{ Request::is('users/*/read') ? 'active' : '' }}"><a href="{{ route('users.read_items', ['id' => $user->id]) }}" class="nav-link"><i class="fas fa-bookmark"></i> READ <span class="badge badge-light">{{ $count_read }}</span></a></li>
                <li class="nav-item" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link">Followings <span class="badge badge-light">{{ $count_followings }}</span></a></li>
                <li class="nav-item" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link">Followers <span class="badge badge-light">{{ $count_followers }}</span></a></li>
           </ul>
    </div>
        
        <div class="tab-content">
            @include('items.items', ['items' => $want_items])
             {!! $want_items->render() !!}
        </div>
</div>
@endsection