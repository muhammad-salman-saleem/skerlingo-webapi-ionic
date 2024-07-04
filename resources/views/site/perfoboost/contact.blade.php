@extends('layouts.site_skerlingo')

@section('content')
    <!-- start section -->
    <section id="contact-start" class="half-section padding-35px-bottom bg-light-gray pt-md-0">
        <div class="container">
            <div
                class="z-index-6 position-relative  bg-white box-shadow-large padding-6-rem-all md-padding-5-rem-all xs-padding-4-rem-tb xs-padding-2-rem-lr">
                <div class="row justify-content-center">
                    <div class="col-12 col-xl-6 col-lg-6 text-center margin-2-half-rem-bottom md-margin-1-rem-bottom">
                        <span class="alt-font letter-spacing-minus-1-half text-extra-medium d-block margin-5px-bottom">Merci
                            de nous envoyer votre demande</span>
                        <h4 class="alt-font font-weight-700 text-extra-dark-gray">Contactez-nous</h4>
                    </div>
                    <div class="col-12">
                        <!-- start contact form -->

                        <div class="success_form_submit padding-60px-tb w-350px m-auto">
                            <img class="w-70px" src="{{ asset('assets/site/skerlingo/images/check.svg') }}"
                                alt="Logo">
                            <h6 class="alt-font text-black font-weight-700 margin-2-rem-tb"></h6>
                            <p class="line-height-22px text-medium mb-0"></p>
                        </div>
                        <form action="{{ route('contact_form') }}" method="post" id="contact-form"
                            class="contact-form margin-30px-top">
                            <input type="hidden" name="_token" value="">

                            <input type="text" class="d-none" name="raison_form">
                            <div class="row ">
                                <div class="col-md-8 margin-2-rem-bottom sm-margin-25px-bottom">
                                    <input class="medium-input bg-white margin-25px-bottom" name="nom" type="text"
                                        name="name" placeholder="Nom complet" required>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="medium-input bg-white margin-25px-bottom" name="email"
                                                type="email" name="email" placeholder="E-mail" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="medium-input bg-white margin-25px-bottom" type="tel"
                                                id="phoneContact" placeholder="Téléphone" name="tel" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="fancy-label-container margin-25px-bottom">
                                                <input
                                                    class="small-input text-black border-radius-5px no-margin-bottom border-color-gray79"
                                                    type="text" name="company_name" required>
                                                <label for="" class="fancy-label text-gray79 text-medium">Entreprise</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="medium-input bg-white margin-25px-bottom" type="text" name="sujet"
                                        placeholder="Sujet" required>
                                    <textarea class="medium-textarea bg-white" rows="6" name="message" placeholder="Message"></textarea>
                                    <div class="text-center text-md-right">
                                        <button id="project-contact-us-button" class="btn btn-medium btn-fast-blue mb-0"
                                            type="submit">Envoyer</button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <!-- start feature box item -->
                                        <div class="md-margin-50px-bottom sm-margin-30px-bottom">
                                            <div class="feature-box text-center">
                                                <div class="feature-box-icon">
                                                    <i
                                                        class="line-icon-Headset icon-extra-medium text-fast-blue margin-30px-bottom md-margin-15px-bottom sm-margin-10px-bottom"></i>
                                                </div>
                                                <div class="feature-box-content last-paragraph-no-margin">
                                                    <span
                                                        class="alt-font font-weight-500 margin-10px-bottom d-block text-extra-dark-gray text-small text-uppercase">Téléphone</span>
                                                    <p>+212 679-790129</p>
                                                </div>
                                            </div>
                                            <div class="margin-35px-top feature-box text-center">
                                                <div class="feature-box-icon">
                                                    <i
                                                        class="line-icon-Mail-Read icon-extra-medium text-fast-blue margin-30px-bottom md-margin-15px-bottom sm-margin-10px-bottom"></i>
                                                </div>
                                                <div class="feature-box-content last-paragraph-no-margin">
                                                    <span
                                                        class="alt-font font-weight-500 margin-10px-bottom d-block text-extra-dark-gray text-small text-uppercase">E-mail</span>
                                                    <p><a href="mailto:contact@skerlingo.ma"
                                                            class="text-sky-blue-hover">contact@skerlingo.ma</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end feature box item -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-results d-none"></div>
                            <input type="hidden" name="indicatif" value="" id="indicatif">
                        </form>
                        <!-- end contact form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
@endsection
