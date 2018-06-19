@if (Auth::user()->is_wanting($item->title))
    {!! Form::open(['route' => 'item_user.dont_want', 'method' => 'delete']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
        {!! Form::submit('Want', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'item_user.want']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
        {!! Form::submit('Want it', ['class' => 'btn btn-light']) !!}
    {!! Form::close() !!}
@endif