@extends('layouts.app')

@section('content')
        <div class="row">
             <div class="main-part col-md-3 text-center">
                 <div class="icon">
                     @if ($user->avatar_filename)
                      <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar"class="rounded-circle" style="width: 150px;height: 150px;"/>
                     @else
                      <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="rounded-circle">
                     @endif
                </div>
                <div class="name">
                        <h1>{{ $user->name }}</h1>
                </div>
            </div>
            <div class="col-md-9">
                @if (count($reviews) > 0)
                    @include('reviews.reviews', ['reviews' => $reviews])
                @endif
            </div>
        </div>
@endsection