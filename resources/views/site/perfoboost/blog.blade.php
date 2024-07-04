@extends('layouts.site_skerlingo')

@section('content')
    <!-- start page title -->
    <section class="pt-3 pb-5 half-section" data-parallax-background-ratio="0.5"
        style="background-image:url('images/portfolio-bg2.jpg');">
        <div class="container">
            <div class="row align-items-stretch justify-content-center extra-small-screen">
                <div
                    class="col-12 col-xl-6 col-lg-7 col-md-8 page-title-extra-small text-center d-flex justify-content-center flex-column">
                    <h1 class="alt-font text-gradient-sky-blue-pink margin-15px-bottom d-inline-block">PERFOBOOST</h1>
                    <h2
                        class="text-extra-dark-gray alt-font font-weight-600 letter-spacing-minus-1px line-height-50 sm-line-height-45 xs-line-height-30 no-margin-bottom">
                        Blog</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->
    <!-- start section -->
    <section class="pt-0 padding-eleven-lr xl-padding-two-lr xs-no-padding-lr">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 blog-content">
                    <ul
                        class="blog-grid blog-wrapper grid grid-loading grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                        <li class="grid-sizer"></li>
                        <!-- start blog item -->
                        @foreach ($articles as $item)
                            <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="{{ $item['url_page'] }}" title=""><img src="{{ $item['image_url'] }}"
                                                alt=""></a>
                                        <a href="{{ $item['url_page'] }}"
                                            class="blog-category alt-font">{{ $item['type_label'] }}</a>
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="{{ $item['url_page'] }}"
                                            class="alt-font text-small d-inline-block margin-10px-bottom">{{ $item['date'] }}</a>
                                        <a href="{{ $item['url_page'] }}"
                                            class="alt-font font-weight-500 text-extra-medium text-extra-dark-gray margin-15px-bottom d-block">{{ $item['label'] }}</a>
                                        <p class="p-three-dots mb-0">{{ $item['intro'] }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <!-- end blog item -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
