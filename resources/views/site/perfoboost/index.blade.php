@extends('layouts.site_skerlingo')

@section('content')
    <!-- start section -->
    <section class="p-0">
        <div class="swiper-container white-move h-600px md-h-500px sm-h-500px"
            data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-pagination", "clickable": true }, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav" }, "autoplay": { "delay": 10000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
            <div class="swiper-wrapper">

                @foreach ($slides as $item)
                    <!-- start slider item -->
                    <div class="swiper-slide cover-background_"
                        style="background-size:cover;background-image:url('{{ $item['image_url'] }}');">
                        <div class="overlay-bg bg-gradient-dark-slate-blue"></div>
                        <div class="container h-100">
                            <div class="row h-100">
                                <div
                                    class="col-12 col-xl-8 col-lg-8 col-sm-8 h-100 d-flex justify-content-center flex-column">
                                    <p
                                        class="alt-font text-large text-white opacity-7 font-weight-300 margin-20px-bottom xs-margin-20px-bottom">
                                        PERFOBOOST</p>
                                    <h5
                                        class="alt-font text-shadow-double-large font-weight-600 text-white margin-55px-bottom w-90 md-w-100 md-no-text-shadow xs-margin-35px-bottom">
                                        {{ $item['label'] }}</h5>
                                    <div class="d-inline-block">
                                        <a href="{{ $item['categorie_url'] }}" target="_blank"
                                            class="btn btn-fancy btn-medium btn-round-edge btn-white margin-30px-right xs-margin-15px-bottom">{{ $item['categorie_label'] }}</a>
                                        <a href="https://api.whatsapp.com/send?phone=+212660252180"
                                            class="btn btn-link btn-large text-white top-minus-5px font-weight-400">Contactez-nous</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end slider item -->
                @endforeach

            </div>

            <!-- start slider arrow -->
            <div class="swiper-button-previous-nav swiper-button-prev slider-navigation-style-05"><i
                    class="line-icon-Arrow-OutLeft"></i></div>
            <div class="swiper-button-next-nav swiper-button-next slider-navigation-style-05"><i
                    class="line-icon-Arrow-OutRight"></i></div>
            <!-- end slider arrow -->
            <!-- start slider pagination -->
            <div class="swiper-pagination swiper-light-pagination"></div>
            <!-- end slider pagination -->
            <!-- start slider navigation -->
            <!-- <div class="swiper-button-next-nav swiper-button-next rounded-circle slider-navigation-style-07"><i class="feather icon-feather-arrow-right"></i></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="swiper-button-previous-nav swiper-button-prev rounded-circle slider-navigation-style-07"><i class="feather icon-feather-arrow-left"></i></div>  -->
            <!-- end slider navigation -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="big-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-5 col-lg-5 col-md-6 xs-margin-30px-bottom text-center text-md-left wow animate__fadeIn"
                    data-wow-delay="0.2s">
                    <h4 class="alt-font cd-headline slide font-weight-600 text-extra-dark-gray">
                        <span class="d-block p-0">PerfoBoost est un cabinet de conseil et de formation en</span>
                        <span class="cd-words-wrapper d-initial p-0">
                            <b
                                class="text-fast-blue border-width-2px border-bottom border-fast-blue letter-spacing-minus-1px is-visible">stratégie
                                commercial</b>
                            <b
                                class="text-fast-blue border-width-2px border-bottom border-fast-blue letter-spacing-minus-1px">développement
                                commercial</b>
                            <b
                                class="text-fast-blue border-width-2px border-bottom border-fast-blue letter-spacing-minus-1px">stratégie
                                marketing</b>
                        </span>
                    </h4>
                </div>
                <div class="col-12 col-xl-5 offset-xl-2 col-md-6 offset-lg-1 text-center text-md-left last-paragraph-no-margin wow animate__fadeIn"
                    data-wow-delay="0.4s">
                    <span class="alt-font font-weight-600 text-extra-dark-gray text-uppercase d-block margin-15px-bottom">a
                        propos de nous</span>
                    <p class="text-extra-medium w-95 line-height-36px md-w-100">Nous accompagnons chaque jour des femmes et
                        des hommes pour améliorer leur rentabilité et celle de leur business en trouvant des solutions
                        pratiques et adaptées à leurs problématiques et celles de leurs organisations sur des thématiques
                        commerciales et marketing.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->



    @foreach ($rubriques as $item)
        @if (count($item['children']->toArray([])) > 0 && $item['enable'])
            <!-- start section -->
            <section class="{{ $loop->iteration % 2 == 0 ? 'bg-light-gray' : '' }}">
                <div class="container">
                    <div class="row justify-content-center wow animate__fadeIn">
                        <div
                            class="col-12 col-lg-5 col-sm-9 text-center text-lg-left md-margin-40px-bottom sm-margin-15px-bottom xs-margin-20px-bottom">
                            <span
                                class="alt-font font-weight-500 text-fast-blue text-extra-medium d-block margin-20px-bottom sm-margin-10px-bottom text-uppercase">{{ $item['label'] }}</span>
                            <h5 class="alt-font text-extra-dark-gray font-weight-600 w-95 lg-w-100">
                                {{ $item['presentation'] }}</h5>
                        </div>
                        <div class="col-12 col-lg-6 offset-lg-1 wow animate__fadeIn" data-wow-duration="0.3">

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 margin-8-rem-top md-margin-6-rem-top">
                            <div class="outside-box-right">
                                <!-- start slider -->
                                <div class="swiper-container white-move"
                                    data-slider-options='{"loop": false, "slidesPerView": 1, "spaceBetween": 30, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 2 } } }'>
                                    <div class="swiper-wrapper">

                                        @foreach ($item['children']->toArray([]) as $child)
                                            @if ($child['enable'])
                                                <!-- start interactive banner item -->
                                                <div class="swiper-slide interactive-banners-style-07">
                                                    <div
                                                        class="interactive-banners-box bg-dark-slate-blue border-radius-6px">
                                                        <div class="interactive-banners-box-image">
                                                            <figure class="sixteen-nine-img">
                                                                <img src="{{ $child['icon_url'] }}" alt=""
                                                                    class="w-100" />
                                                            </figure>
                                                            <div class="overlay-bg bg-gradient-dark-slate-blue-transparent">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="fancy-text-content padding-65px-lr md-padding-55px-lr xs-padding-30px-lr">
                                                            <div class="text-white opacity-6 margin-10px-bottom">
                                                                {{ $child['label'] }}</div>
                                                            <div
                                                                class="alt-font text-large font-weight-500 text-white margin-15px-bottom w-60 lg-w-90 sm-w-50 xs-w-90 md-margin-5px-bottom">
                                                                {{ $child['presentation'] }}</div>
                                                            <a href="{{ $item['url_page'] }}"
                                                                class="btn btn-fancy btn-fast-blue btn-very-small btn-round-edge margin-15px-top">Plus
                                                                de détails</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end interactive banner item -->
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- end slider -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end section -->
        @endif
    @endforeach

    <!-- start section -->
    @if (false)
        <section class="p-0 wow animate__fadeIn">
            <div class="container-fluid">
                <div class="row">
                    <div class="col h-500px p-0 md-h-450px xs-h-450px">
                        <iframe class="w-100 h-100 filter-grayscale-50"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13294.738252779485!2d-7.5491164!3d33.5875384!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9426547fd82039bc!2sAW%20Soudage%20sarl%20au!5e0!3m2!1sfr!2sma!4v1633775728303!5m2!1sfr!2sma"></iframe>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- end section -->
@endsection
