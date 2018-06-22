@extends('layouts.app')
 
@section('content')
    <div class="row">
            <div class= "col-lg-4 col-md-6 float-left">
                    
                        <div class="card text-white">
                            <div class="colorfilter-base">
                                <img class="card-img" src="{{ $item->image_url }}" alt="" class="colorfilter-image">
                            </div>
                            <div class="card-img-overlay text-center">
                                    <p class="text-white font-weight-bold card-title">{{ $item->title }}</p>
                                <div class="btn-group" role="group">
                                    @if (Auth::check()) 
                                    @include('items.want_button', ['item' => $item])
                                    @include('items.read_button', ['item' => $item])
                                    @endif
                                </div>
                            </div>
                        </div>
                             <p class="text-center"><a href="{{ $item->url }}" target="_blank">楽天詳細ページへ</a></p>
            </div>

        <div class="col-lg-8 col-md-6">
            <div class="card-group">
                <div class="card">
                    <div class="card-header text-center">
                        Wantしたユーザ
                    </div>
                    <div class="card-body">
                        @foreach ($want_users as $user)
                            <a href="{{ route('users.want_items', $user->id) }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        Readユーザ
                    </div>
                    <div class="card-body">
                        @foreach ($read_users as $user)
                            <a href="{{ route('users.read_items', $user->id) }}">{{ $user->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                    <div class="card-header text-center">
                        Reviews
                    </div>
                    <div class="card-body">
                       <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="ユーザー名" aria-label="ユーザー名" aria-describedby="basic-addon1">
                        </div>
                    </div>
            </div>
            
        </div>
    </div>
@endsection