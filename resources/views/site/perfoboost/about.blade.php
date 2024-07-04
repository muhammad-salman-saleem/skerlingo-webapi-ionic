@extends('layouts.site_skerlingo')

@section('content')
    <!-- start page title -->
    <section id="about" class="overlap-height wow animate__fadeIn padding-60px-bottom parallax"
        data-parallax-background-ratio="0.5" style="background-image:url('images/our-story-bg.jpg');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10 col-lg-10 text-center overlap-gap-section">
                    <div class="w-40px h-2px bg-fast-blue separator-line-vertical margin-30px-tb d-inline-block">
                    </div>
                    <h5 class="alt-font font-weight-600 text-extra-dark-gray letter-spacing-minus-1px about-title">
                        {!! $traductions[24]['value'] !!}
                    </h5>
                    <div class="w-40px h-2px bg-fast-blue separator-line-vertical margin-30px-tb d-inline-block">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- start section -->
    <section id="reading" class="p-0 bg-extra-dark-gray wow animate__fadeIn background-position-center"
        style="background-image: url('{{ asset('assets/site/asmex/images/about.jpg') }}');">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 cover-background md-h-550px sm-h-400px xs-h-300px">
                    <div class="absolute-middle-center sm-w-100 text-center">
                        <h1 style="clip-path: polygon(0 0%, 100% 0%, 100% 35%, 0 165%);"
                            class="alt-font fancy-text-content title-extra-large-heavy font-weight-600 text-white d-inline-block align-middle letter-spacing-minus-5px xs-padding-30px-tb">
                            35</h1>
                        <h4
                            class="alt-font left-minus-35px text-white text-right d-inline-block align-middle w-190px sm-w-130px mx-auto position-relative no-margin-bottom margin-50px-top">
                            {!! $traductions[25]['value'] !!}</h4>
                    </div>
                </div>
                <div class="col-12 col-lg-6 padding-8-half-rem-lr lg-padding-5-half-rem-lr padding-twelve-tb lg-padding-twelve-tb xs-padding-15px-lr"
                    style="background: rgb(251 100 30 / 90%);">
                    <h4 class="alt-font text-white font-weight-400 margin-30px-bottom  sm-margin-20px-bottom">
                        {!! $traductions[26]['value'] !!}
                    </h4>
                    <p class="alt-font margin-10px-bottom text-large line-height-30px font-weight-300 text-white">
                        {!! $traductions[27]['value'] !!}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="bg-light-gray section  wow animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center margin-seven-bottom">
                    <h6 class="alt-font text-extra-dark-gray font-weight-600 w-70 md-w-100 margin-auto">
                        {!! $traductions[28]['value'] !!}</h6>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <!-- start feature box item -->
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 text-center wow animate__zoomIn" data-wow-delay="0.3s">
                    <div
                        class="feature-box bg-white border-radius-10px bg-hover-fast-blue h-100 padding-2-rem-lr padding-35px-tb lg-padding-1-rem-lr margin-15px-bottom">
                        <div class="feature-box-icon">
                            <i
                                class="line-icon-Laptop-Secure icon-large text-fast-blue margin-20px-bottom d-inline-block"></i>
                        </div>
                        <div class="feature-box-content last-paragraph-no-margin">
                            <span class="alt-font font-weight-400 d-block text-medium-slate-blue line-height-24px">
                                {!! $traductions[29]['value'] !!}</span>
                        </div>
                    </div>
                </div>
                <!-- end feature box item -->
                <!-- start feature box item -->
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 text-center wow animate__zoomIn" data-wow-delay="0.3s">
                    <div
                        class="feature-box bg-white border-radius-10px bg-hover-fast-blue h-100 padding-2-rem-lr padding-35px-tb lg-padding-1-rem-lr margin-15px-bottom">
                        <div class="feature-box-icon">
                            <i
                                class="line-icon-File-ClipboardFileText icon-large text-fast-blue margin-20px-bottom d-inline-block"></i>
                        </div>
                        <div class="feature-box-content last-paragraph-no-margin">
                            <span class="alt-font font-weight-400 d-block text-medium-slate-blue line-height-24px">
                                {!! $traductions[30]['value'] !!}</span>
                        </div>
                    </div>
                </div>
                <!-- end feature box item -->
                <!-- start feature box item -->
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 text-center wow animate__zoomIn" data-wow-delay="0.3s">
                    <div
                        class="feature-box bg-white border-radius-10px bg-hover-fast-blue h-100 padding-2-rem-lr padding-35px-tb lg-padding-1-rem-lr margin-15px-bottom">
                        <div class="feature-box-icon">
                            <i class="line-icon-Network icon-large text-fast-blue margin-20px-bottom d-inline-block"></i>
                        </div>
                        <div class="feature-box-content last-paragraph-no-margin">
                            <span class="alt-font font-weight-400 d-block text-medium-slate-blue line-height-24px">
                                {!! $traductions[31]['value'] !!}</span>
                        </div>
                    </div>
                </div>
                <!-- end feature box item -->
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="wow animate__fadeIn pb-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center text-md-left sm-margin-30px-bottom">
                    <h6 class="alt-font text-extra-dark-gray text-center font-weight-600 mb-0 top-line-h">
                        {!! $traductions[32]['value'] !!}
                    </h6>
                </div>
            </div>
            <div
                class="row row-cols-2 row-cols-md-4 row-cols-sm-2 client-logo-style-01 align-items-center justify-content-center margin-4-rem-top sm-margin-5-rem-top">
                @foreach (File::glob(public_path('storage/partners_logos/institutionnel') . '/*') as $path)
                    <!-- start client item -->
                    <div
                        class="col text-center margin-30px-bottom sm-margin-15px-bottom feature-box-show-hover box-shadow-small-hover border-radius-6px feature-box-bg-white-hover">
                        <div class="client-box padding-15px-all">
                            <a href="#">
                                <img class="client-box-image" src="{{ str_replace(public_path(), '', $path) }}">
                            </a>
                        </div>
                    </div>
                    <!-- end client item -->
                @endforeach

            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="wow animate__fadeIn pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center text-md-left margin-30px-tb">
                    <h6 class="alt-font text-extra-dark-gray text-center font-weight-600 mb-0 top-line-h">
                        {!! $traductions[33]['value'] !!}
                    </h6>
                </div>
            </div>
            <div
                class="row row-cols-2 row-cols-md-4 row-cols-sm-2 client-logo-style-01 align-items-center justify-content-center margin-4-rem-top sm-margin-5-rem-top">
                @foreach (File::glob(public_path('storage/partners_logos/internationaux') . '/*') as $path)
                    <!-- start client item -->
                    <div
                        class="col text-center margin-30px-bottom sm-margin-15px-bottom feature-box-show-hover box-shadow-small-hover border-radius-6px feature-box-bg-white-hover">
                        <div class="client-box padding-15px-all">
                            <a href="#">
                                <img class="client-box-image" src="{{ str_replace(public_path(), '', $path) }}">
                            </a>
                        </div>
                    </div>
                    <!-- end client item -->
                @endforeach

            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
