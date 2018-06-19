@if (Auth::user()->is_reading($item->title))
    {!! Form::open(['route' => 'item_user.dont_read', 'method' => 'delete']) !!}
        {!! Form::hidden('title', $item->title) !!}
        {!! Form::submit('Read', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'item_user.read']) !!}
        {!! Form::hidden('title', $item->title) !!}
        {!! Form::submit('Read', ['class' => 'btn btn-light']) !!}
    {!! Form::close() !!}
@endif