@extends('layouts.site_skerlingo')

@section('content')

    <!-- start section -->
    <section class="big-section wow animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-12 shopping-content d-flex flex-column flex-lg-row align-items-md-center">
                    <div class="w-55 md-w-100">
                        <div class="product-images-box lightbox-portfolio row">
                            <div class="col-12 col-lg-9 px-lg-0 order-lg-2 product-image md-margin-10px-bottom">
                                <div class="swiper-container product-image-slider"
                                    data-slider-options='{ "spaceBetween": 10, "watchOverflow": true, "navigation": { "nextEl": ".slider-product-next", "prevEl": ".slider-product-prev" }, "thumbs": { "swiper": { "el": ".product-image-thumb", "slidesPerView": "auto", "spaceBetween": 15, "direction": "vertical", "navigation": { "nextEl": ".swiper-thumb-next", "prevEl": ".swiper-thumb-prev" } } } }'
                                    data-thumb-slider-md-direction="horizontal">
                                    <div class="swiper-wrapper">
                                        @foreach ($produit['images']->toArray([]) as $image)
                                            <!-- start slider item -->
                                            <div class="swiper-slide">
                                                <a class="gallery-link" href="{{ $image['image_url'] }}"><img class="w-100"
                                                        src="{{ $image['image_url'] }}" alt=""></a>
                                            </div>
                                            <!-- end slider item -->
                                        @endforeach
                                    </div>
                                </div>
                                <div class="slider-product-next swiper-button-next text-extra-dark-gray"><i
                                        class="fa fa-chevron-right"></i></div>
                                <div class="slider-product-prev swiper-button-prev text-extra-dark-gray"><i
                                        class="fa fa-chevron-left"></i></div>
                            </div>
                            <div
                                class="col-12 col-lg-3 order-lg-1 single-product-thumb md-margin-50px-bottom sm-margin-40px-bottom">
                                <div
                                    class="swiper-container product-image-thumb slider-vertical padding-15px-lr padding-45px-bottom md-no-padding left-0px">
                                    <div class="swiper-wrapper">
                                        @foreach ($produit['images']->toArray([]) as $image)
                                            <div class="swiper-slide"><img class="w-100" src="{{ $image['image_url'] }}"
                                                    alt=""></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper-thumb-next-prev text-center">
                                    <div class="swiper-button-prev swiper-thumb-prev"><i class="fa fa-chevron-up"></i></div>
                                    <div class="swiper-button-next swiper-thumb-next"><i class="fa fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-45 md-w-100 product-summary padding-7-rem-left lg-padding-5-rem-left md-no-padding-left">
                        <div class="breadcrumb text-small p-0">
                            <!-- start breadcrumb -->
                            <ul>
                                <li><a href="{{ route('home_page_' . Session::get('locale')) }}">Accueil</a></li>
                                <li><a href="{{ route('products_page_' . Session::get('locale')) }}">Nos produits</a></li>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                        <div class="d-flex align-items-center margin-2-rem-tb md-margin-1-rem-tb">
                            <div class="flex-grow-1">
                                <div
                                    class="text-extra-dark-gray font-weight-600 text-extra-large alt-font no-margin-bottom">
                                    {{ $produit['label'] }}</div>
                                <span class="alt-font product-price text-medium font-weight-400"><span
                                        class="font-weight-500">{{ $produit['marque_label'] }}</span></span>
                            </div>
                        </div>
                        <div>
                            <p>{{ $produit['introduction'] }}</p>

                        </div>


                        <div>
                            @if ($produit['fiche_url'])
                                <a href="{{ $produit['fiche_url'] }}" class="btn btn-slate-blue btn-medium"
                                    target="_blank">Fiche technique <i class="far fa-file-pdf right-icon"></i>
                                </a>
                            @endif
                            <a target="_blank"
                                href="https://wa.me/+212660252180?text=Demande de prix : {{ $produit['label'] }}"
                                class="btn btn-fast-blue btn-medium">Demande de prix <i
                                    class="fas fa-info-circle right-icon"></i></a>
                        </div>
                        @if ($produit['keywords'])
                            <div class="d-flex alt-font margin-4-rem-top align-items-center">
                                <div class="flex-grow-1">
                                    <span
                                        class="text-uppercase text-extra-small font-weight-500 text-extra-dark-gray d-block">Keywords
                                        :

                                        @foreach ($produit['keywords'] as $keyword)
                                            <a href="{{ route('search_products') }}?keywords={{ $keyword }}"
                                                class="font-weight-400">{{ $keyword }}</a>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
    <!-- start section -->
    <section class="border-top border-width-1px border-color-medium-gray pt-0 wow animate__fadeIn">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 p-0 tab-style-07">
                    <ul
                        class="nav nav-tabs justify-content-center text-center alt-font font-weight-500 text-uppercase margin-4-rem-bottom border-bottom border-color-medium-gray md-margin-50px-bottom sm-margin-35px-bottom">
                        <li class="nav-item"><a data-toggle="tab" href="#description"
                                class="nav-link active">Description</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                href="#additionalinformation">Caractéristiques</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="tab-content">
                <!-- start tab item -->
                <div id="description" class="tab-pane fade in active show">
                    {!! $produit['details'] !!}
                </div>
                <!-- end tab item -->
                <!-- start tab item -->
                <div id="additionalinformation" class="tab-pane fade">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <table class="table-style-02">
                                <tbody>
                                    @foreach ($produit['caracteristiques'] as $caracteristique)
                                        <tr>
                                            <th class="text-extra-dark-gray font-weight-500">
                                                {{ $caracteristique['label'] }}</th>
                                            <td>{{ $caracteristique['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end tab item -->
            </div>
        </div>
    </section>
    <!-- end section -->
    @if ($produits)
        <!-- start section -->
        <section class="border-top border-width-1px border-color-medium-gray wow animate__fadeIn">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-5 col-md-6 text-center margin-4-rem-bottom sm-margin-2-rem-bottom">
                        <span class="alt-font font-weight-500 text-uppercase d-inline-block margin-5px-bottom">Autres
                            produits</span>
                        <h5 class="alt-font font-weight-600 text-extra-dark-gray letter-spacing-minus-1px">Autres produits
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 filter-content">
                        <ul
                            class="product-listing shop-wrapper grid grid-loading grid-4col xl-grid-4col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large text-center">
                            <li class="grid-sizer"></li>
                            @foreach ($produits as $item)
                                <!-- start product item -->
                                <li class="grid-item wow animate__fadeIn">
                                    <div class="product-box margin-45px-bottom lg-margin-25px-bottom xs-no-margin-bottom">
                                        <div class="product-image border-radius-4px">
                                            <a href="{{ $item['url_page'] }}">
                                                @foreach ($item['images']->toArray([]) as $image)
                                                    @php
                                                        if ($loop->index == 2) {
                                                            break;
                                                        }
                                                    @endphp

                                                    <img class="{{ $loop->index == 1 ? 'hover-img' : '' }}"
                                                        src="{{ $image['image_url'] }}" alt="" />
                                                @endforeach
                                                <span
                                                    class="product-badge bg-slate-blue">{{ $item['secteur_label'] }}</span>
                                            </a>
                                            <div class="product-hover-details">
                                                <a href="{{ $item['url_page'] }}"
                                                    class="alt-font text-white text-small font-weight-500 text-uppercase"><i
                                                        class="feather icon-feather-shopping-bag margin-10px-right"></i>Plus
                                                    de
                                                    détails</a>
                                            </div>
                                        </div>
                                        <div class="product-footer text-center padding-25px-top xs-padding-10px-top">
                                            <a href="#"
                                                class="alt-font text-extra-medium text-extra-dark-gray text-black-hover font-weight-500 d-inline-block p-one-dots">{{ $item['label'] }}</a>
                                            <div class="product-price text-medium d-none">140 000,00 MAD</div>
                                        </div>
                                    </div>
                                </li>
                                <!-- end product item -->
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->
    @endif

@endsection
