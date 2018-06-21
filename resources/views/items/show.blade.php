@extends('layouts.app')

@section('content')
    <div class="row">
     <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card">
                        <img class="card-img" src="{{ $item->image_url }}" alt="" class="">
                        <div class="card-body">
                                <p class="card-title item-title">{{ $item->title }}</p>
                            <div class="text-center">
                             <div class="btn-group" role="group">
                                @if (Auth::check()) 
                               @include('items.want_button', ['item' => $item])
                               @include('items.read_button', ['item' => $item])
                               @endif
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="want-users">
                <div class="card">
                    <div class="card-header text-center">
                        Wantしたユーザ
                    </div>
                    <div class="card-body">
                        @foreach ($want_users as $user)
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="read-users">
                <div class="card card-default">
                    <div class="card-header text-center">
                        Readユーザ
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div>
            </div>
            <p class="text-center"><a href="{{ $item->url }}" target="_blank">楽天詳細ページへ</a></p>
        </div>
    </div>
@endsection