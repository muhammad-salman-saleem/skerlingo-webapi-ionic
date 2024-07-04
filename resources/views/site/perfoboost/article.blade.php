@extends('layouts.site_skerlingo')

@section('content')
    <!-- start section -->
    <section class="overlap-height bg-slate-blue">
        <div class="container">
            <div class="row">
                <div
                    class="col-12 col-lg-8 offset-xl-1 col-md-6 d-flex justify-content-center flex-column padding-6-half-rem-top overlap-gap-section sm-padding-4-rem-top xs-no-padding-top">
                    <div
                        class="d-inline-block text-extra-large text-uppercase margin-25px-bottom text-white line-height-22px">
                        <a href="#" class="alt-font text-white">{{ $article['type_label'] }}</a>
                    </div>
                    <h3 class="alt-font text-white mb-sm-0 font-weight-600 xs-margin-25px-bottom">
                        {{ $article['label'] }}</h3>
                </div>
                <div class="col-12 col-md-3 d-none d-md-flex justify-content-center flex-column padding-6-half-rem-top">
                    <span class="sm-100px w-100 h-1px d-inline-block align-middle bg-white opacity-5"></span>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="overflow-visible py-0">
        <div class="container-fluid">
            <div class="row overlap-section align-items-center justify-content-end z-index-0">
                <div class="col-12 position-absolute left-minus-50px p-0 tilt-box d-none d-md-block"
                    data-tilt-options='{ "maxTilt": 20, "perspective": 1000, "easing": "cubic-bezier(.03,.98,.52,.99)", "scale": 1, "speed": 500, "transition": true, "reset": true, "glare": false, "maxGlare": 1 }'>
                    <span
                        class="alt-font text-black font-weight-700 opacity-1 letter-spacing-minus-7px text-big">{{ $article['label'] }}</span>
                </div>
                <div class="col-12 col-md-9 px-0">
                    <figure class="sixteen-nine-img">
                        <img src="{{ $article['image_url'] }}" alt="" class="w-100" />
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="half-section ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 offset-lg-1 last-paragraph-no-margin wow animate__fadeIn" data-wow-delay="0.2s">
                    <div class="article-description">
                        {!! $article['contenu'] !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
