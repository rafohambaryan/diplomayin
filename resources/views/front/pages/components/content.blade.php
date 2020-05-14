<div class="costume-size">
    <span>{{$header}}</span>
    <ul>
        @if($content)
            @switch($content->contentType->type)
                @case('json')
                @foreach(json_decode($content->content) as $content_man)
                    <li><p>{{$content_man}}</p></li>
                @endforeach
                @break
                @case('img')
                @break
            @endswitch
        @endif
    </ul>
</div>
