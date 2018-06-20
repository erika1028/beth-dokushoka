@extends('layouts.app')

@section('content')
    <h1>Ranking</h1>
    @include('items.items',['items' => $items])
    
@endsection