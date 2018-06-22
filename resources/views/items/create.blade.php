@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-md-3 col-sm-12">
    <div class="search">
            <div class="form-label">
                {!! Form::open(['route' => 'items.create', 'method' => 'get', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::text('title', $title, ['class' => 'form-control form-control-lg', 'placeholder' => 'キーワードを入力', 'size' => 40]) !!}
                    </div>
                    {!! Form::submit('書籍検索', ['class' => 'btn btn-light btn-md']) !!}
                {!! Form::close() !!}
            </div>
    </div>
</div>
    @include('items.items', ['items' => $items])
@endsection