@extends('front.layout.app')
@section('content')
    <div class="mysql-logo-all-page">
        <img src="{{asset('/uploads/present_logo/'.$mainSlide->present_logo)}}" alt="">
    </div>
    <div id="fullpage">
        <section class="vertical-scrolling main-section">
            <div class="haph-logo">
                <a href="{{$mainSlide->logo_url}}" target="_blank"><img
                        src="{{asset('/uploads/logo/'.$mainSlide->logo)}}"
                        alt=""></a>
            </div>
            <h2 class="ml-main-text">{{$mainSlide->main_name}}</h2>
            <div class="content-main-slider">
                <p><strong>Թեմա՝</strong> {{$mainSlide->topic}}</p>
                <p><strong>ՈՒսանող՝</strong> {{$mainSlide->student}}</p>
                <p><strong>Ղեկավար՝</strong> {{$mainSlide->head}}</p>
            </div>
        </section>

        @foreach($orders as $item)
            <section class="vertical-scrolling">
                @if (!empty(current($item->subheadings->many)))
                    <div class="horizontal-scrolling">
                        @include('front.pages.components.content',[
                                                                      'header' =>$item->subheadings->text_header,
                                                                      'content' => $item->subheadings->content
                                                                    ])
                    </div>
                    @foreach($item->subheadings->many as $many)
                        <div class="horizontal-scrolling">
                            @include('front.pages.components.content',[
                                                                    'header' =>$many->text_header,
                                                                    'content' => $many->content
                                                                  ])
                        </div>
                    @endforeach
                @else
                    <div class="presentacion-contents">
                        @include('front.pages.components.content',[
                                                                    'header' =>$item->subheadings->text_header,
                                                                    'content' => $item->subheadings->content
                                                                  ])

                    </div>
                @endif
            </section>
        @endforeach
    </div>
@endsection
