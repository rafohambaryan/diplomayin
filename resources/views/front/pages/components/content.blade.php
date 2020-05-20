<div class="costume-size">
    <span>{{$header}}</span>
    @if($content)
        <div>
            @if (json_decode($content->content))
                <ul>
                    @foreach(json_decode($content->content) as $content_man)
                        <li><p>{!! $content_man !!}</p></li>
                    @endforeach
                </ul>
            @endif
            @if ($content->img)
                <img src="{{asset('/uploads/img/'.$content->img)}}" class="mt-3" width="100%" alt="img">
            @endif
        </div>
    @endif
</div>
