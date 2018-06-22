@extends('layouts.app')

@section('content')

{!! Form::open(['url' => '/upload', 'method' => 'post', 'files' => true]) !!}

<div class="form-group">
    @if ($user->avatar_filename)
        <p>
            <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar" />
        </p>
    @endif
    {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
    {!! Form::file('file') !!}
</div>

<div class="form-group">
    {!! Form::submit('Upload', ['class' => 'btn btn-light']) !!}
</div>
{!! Form::close() !!}

@endsection