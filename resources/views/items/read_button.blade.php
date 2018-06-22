@if (Auth::user()->is_reading($item->title))
    {!! Form::open(['route' => 'item_user.dont_read', 'method' => 'delete']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
         {!! Form::button('<i class="fas fa-bookmark fa-2x"></i>', ['type'=> 'submit','class' => 'btn btn-link text-warning']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'item_user.read']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
        {!! Form::button('<i class="far fa-bookmark fa-2x"></i>', ['type'=> 'submit','class' => 'btn btn-link text-white']) !!}
    {!! Form::close() !!}
@endif