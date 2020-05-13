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
                        <div class="costume-size">
                            <span>{{$item->subheadings->text_header}}</span>
                            <ul>
                                @if($item->subheadings->content->contentType->type === 'json')
                                    @foreach(json_decode($item->subheadings->content->content) as $content)
                                        <li><p>{{$content}}</p></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    @foreach($item->subheadings->many as $many)
                        <div class="horizontal-scrolling">
                            <div class="costume-size">
                                <span>{{$many->text_header}}</span>
                                <ul>
                                    @foreach(json_decode($many->content->content) as $content_man)
                                        <li><p>{{$content_man}}</p></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="presentacion-contents">
                        <div class="costume-size">
                            <span>{{$item->subheadings->text_header}}</span>
                            <ul>
                                @if($item->subheadings->content->contentType->type === 'json')
                                    @foreach(json_decode($item->subheadings->content->content) as $content)
                                        <li><p>{{$content}}</p></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            </section>
        @endforeach
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {


            $('#fullpage').fullpage({
                sectionsColor: ['{{$mainSlide->background}}', '#146fb3', '#567df2', '#5C832F', '#B8B89F', '#1572b8', '#1572b8', '#1572b8'],
                sectionSelector: '.vertical-scrolling',
                slideSelector: '.horizontal-scrolling',
                navigation: true,
                slidesNavigation: true,
                controlArrows: false,
                afterSlideLoad: function (anchorLink, index, slideAnchor, slideIndex) {
                    if (anchorLink == 'fifthSection' && slideIndex == 1) {
                        $.fn.fullpage.setAllowScrolling(false, 'up');
                        $(this).css('background', '#374140');
                        $(this).find('h2').css('color', 'white');
                        $(this).find('h3').css('color', 'white');
                        $(this).find('p').css(
                            {
                                'color': '#DC3522',
                                'opacity': 1,
                                'transform': 'translateY(0)'
                            }
                        );
                    }
                },

                onSlideLeave: function (anchorLink, index, slideIndex, direction) {
                    if (anchorLink == 'fifthSection' && slideIndex == 1) {
                        $.fn.fullpage.setAllowScrolling(true, 'up');
                    }
                }
            });

        });

    </script>
@endpush
