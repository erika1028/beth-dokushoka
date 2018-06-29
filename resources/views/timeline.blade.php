@extends('layouts.app')

@section('content')
            <div class="timeline">
                @if (count($reviews) > 0)
                    @include('reviews.reviews', ['reviews' => $reviews])
                @endif
            </div>
@endsection