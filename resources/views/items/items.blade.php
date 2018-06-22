@if ($items)
    <div class="row">
        @foreach ($items as $key=>$item)
                <div class= "items col-xl-3 col-md-4 col-sm-6">
                    
                        <div class="card">
                            <div class="colorfilter-base">
                                <img class="card-img" src="{{ $item->image_url }}" alt="" class="colorfilter-image">
                            </div>
                            <div class="card-img-overlay text-center">
                                @if ($item->id)
                                    <p class="card-title font-weight-bold"><a class="text-white" href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></p>
                                @else
                                    <p class="text-white font-weight-bold card-title">{{ $item->title }}</p>
                                @endif
                                <div class="btn-group" role="group">
                                    @if (Auth::check()) 
                                    @include('items.want_button', ['item' => $item])
                                    @include('items.read_button', ['item' => $item])
                                    @endif
                                </div>
                            </div>
                            @if(isset($item->count))
                            <div class="card-footer">
                                <p class="text-center">{{ $key+1 }}位: {{ $item->count }} 人</p>
                            </div>
                            @endif
                        </div>
                </div>
        @endforeach
    </div>
    
@endif