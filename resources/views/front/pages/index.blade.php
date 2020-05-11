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
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>


        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ինչ է MySQL- ը:</span>
                    <ul>
                        <li><p>MySQL- ն այդպիսի բաց կոդով տվյալների հիման վրա տվյալների բազաների կառավարման համակարգ է:
                                Ծրագիրը, որը սահմանում է, ստեղծում և շահարկում է տվյալների բազան, հայտնի է որպես
                                տվյալների բազայի կառավարման համակարգ: Ծրագրավորողը կարող է օգտագործել SQL հարցումները
                                MySQL- ում `տվյալների պահեստավորման և որոնման համար: Այն ապահովում է տվյալների
                                կառավարում, տվյալների միգրացիա և տվյալների պաշտպանություն:</p></li>
                        <li>
                            <p>
                                MySQL- ը տրամադրում է NET պլատֆորմին, C ++, Python- ին,
                                Java- ին ՝ տվյալների բազայի ծրագրեր կառուցելու համար:
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="vertical-scrolling">
            <div class="presentacion-contents">
                <div class="costume-size">
                    <span>Ընդհանուր նկարագրություն</span>
                    <ul>
                        <li><p>Ինչ է MySQL- ը:</p></li>
                        <li><p>Պատմություն:</p></li>
                        <li><p>Օգտագործում է:</p></li>
                        <li><p>Շարահյուսություն (Syntax)</p></li>
                        <li><p>Նկարագրություն (client server):</p></li>
                        <li><p>Ինչու MySQL:</p></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
// fullpage customization
            $('#fullpage').fullpage({
                sectionsColor: ['{{$mainSlide->background}}', '#146fb3', '#567df2', '#5C832F', '#B8B89F', '#1572b8', '#1572b8', '#1572b8'],
                sectionSelector: '.vertical-scrolling',
                // slideSelector: '.horizontal-scrolling',
                navigation: true,
                // slidesNavigation: true,
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
