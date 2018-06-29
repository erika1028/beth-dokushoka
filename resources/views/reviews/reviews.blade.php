
@foreach ($reviews as $review)
<?php $user = $review->user; ?>
     <div class="my-3">
        <div class="row">
            <div class="col-md-1 col-2">
                <a href="#"class="mr-3">
                     @if ($user->avatar_filename)
                      <img src="{{ asset('storage/avatar/' . $user->avatar_filename) }}" alt="avatar"class="rounded-circle" style="width: 100%; height: auto;"/>
                    @else
                      <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="rounded-circle" style="width: 100%; height: auto;" >
                    @endif
                </a>
            </div>
            <div class="col-md-8 col-8">
                <div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $user->name, ['id' => $review->id]) !!} <span class="text-muted">posted at {{ $review->created_at }}</span>
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
            </div>
            <div class="col-md-3 col-2 p-0 pr-2">
            @if (Request::route()->getName() == "timeline")
            <div class="card">
                <div class="colorfilter-base">
                        <img class="card-img" src="{{ $review->item->image_url }}" alt="" class="colorfilter-image">
                </div>
                <div class="card-img-overlay text-center">
                        <p class="card-title font-weight-bold"><a class="text-white" href="{{ route('items.show', $review->item->id) }}">{{ $review->item->title }}</a></p>

                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
@endforeach
{!! $reviews->render() !!}