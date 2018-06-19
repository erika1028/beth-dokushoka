@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="item">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <img src="{{ $item->image_url }}" alt="">
                    </div>
                    <div class="panel-body">
                        <p class="item-title">{{ $item->title }}</p>
                        <div class="buttons text-center">
                            @if (Auth::check())
                                @include('items.want_button', ['item' => $item])
                                @include('items.read_button', ['item' => $item])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="want-users">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Wantしたユーザ
                    </div>
                    <div class="panel-body">
                        @foreach ($want_users as $user)
                            <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="read-users">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        Readユーザ
                    </div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>
            <p class="text-center"><a href="{{ $item->url }}" target="_blank">楽天詳細ページへ</a></p>
        </div>
    </div>
@endsection