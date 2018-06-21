@if (Auth::user()->is_wanting($item->title))
    {!! Form::open(['route' => 'item_user.dont_want', 'method' => 'delete']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
        {!! Form::button('<i class="fas fa-heart fa-3x"></i>', ['type'=> 'submit','class' => 'btn btn-link text-danger']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => 'item_user.want']) !!}
        {!! Form::hidden('book_title', $item->title) !!}
        {!! Form::button('<i class="far fa-heart fa-3x"></i>', ['type' =>'submit' ,'class' => 'btn btn-link text-white']) !!}
    {!! Form::close() !!}
@endif