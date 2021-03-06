@extends('layouts.app')

@section('cover')

<div class="jumbotron jumbotron-extend">
            <h1>素敵な本と出会う場所</h1>
            @if (!Auth::check())
                <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">Registration</a>
            @endif
</div>
@endsection

@section('content')
  @include('items.items')
    {!! $items->render() !!}
@endsection