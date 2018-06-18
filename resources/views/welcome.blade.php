@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>素敵な本と出会う場所</h1>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">DokUsHoKaを始める</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')
    テスト