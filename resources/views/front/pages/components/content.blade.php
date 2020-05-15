<div class="costume-size">
    <span>{{$header}}</span>
    @if($content)
        @switch($content->contentType->type)
            @case('json')
            <ul>
                @foreach(json_decode($content->content) as $content_man)
                    <li><p>{{$content_man}}</p></li>
                @endforeach
            </ul>
            @break
            @case('img')
            <img src="{{asset('/uploads/img/'.$content->img)}}" alt="">
            @break
        @endswitch
    @endif
</div>
