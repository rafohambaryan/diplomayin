<div class="costume-size">
    <span>{{$header}}</span>
    @if($content)
        <div>
            @switch($content->contentType->type)
                @case('json')
                <ul>
                    @foreach(json_decode($content->content) as $content_man)
                        <li><p>{{$content_man}}</p></li>
                    @endforeach
                </ul>
                @break
                @case('img')
                @if (json_decode($content->content))
                    @foreach(json_decode($content->content) as $content_man)
                        <p>{{$content_man}}</p>
                    @endforeach
                @endif
                <img src="{{asset('/uploads/img/'.$content->img)}}" class="mt-3" width="100%" alt="img">
                @break
            @endswitch
        </div>
    @endif
</div>
