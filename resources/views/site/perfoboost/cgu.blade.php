@extends('layouts.site_skerlingo')

@section('content')

    <!-- start page title -->


    <section class="bg-light-gray half-section cgu-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <!-- start feature box item -->
                <div class="col-12">
                    <div
                        class="alt-font feature-box bg-white  h-100 padding-2-rem-lr padding-35px-tb lg-padding-1-rem-lr margin-15px-bottom">
                        <div
                            class="feature-box-icon top-minus-45px position-absolute feature-box-icon-rounded dark bg-fast-blue w-85px h-85px rounded-circle box-shadow-small ">
                            <i class="line-icon-Cursor-Click2 text-white icon-very-medium"></i>
                            <div class="bg-extra-dark-gray rounded-circle"></div>
                        </div>
                        <div class="feature-box-content text-left">
                            <h5 class="text-dark text-center font-weight-600 w-600px margin-35px-top ml-auto mr-auto mb-5">
                                {!! $traductions[34]['value'] !!}
                            </h5>

                            {!! $traductions[35]['value'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
