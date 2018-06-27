
<div class="">

@foreach ($reviews as $review)
     <li class="media">
        <a href="#"class="mr-3">
             @if ($user->avatar_filename)
              <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar"class="rounded-circle" style="width: 50px;height: 50px;"/>
            @else
              <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="rounded-circle" style="width: 50px;height: 50px;" >
            @endif
        </a>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $review->created_at }}</span>
            </div>
            
            <div>
                <p>{!! nl2br(e($review->content)) !!}</p>
            </div>
            <div>
                @if (Auth::id() == $review->user_id)
                    {!! Form::open(['route' => ['reviews.destroy', $review->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-light btn-sm']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $reviews->render() !!}

   