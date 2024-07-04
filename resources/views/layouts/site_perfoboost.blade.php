@php
$rubriquesLayout = App\Http\Resources\RubriqueTree::collection(
    App\Rubrique::where('secteur', 1)
        ->where('enable', 1)
        ->whereNull('parent_id')
        ->orderBy('ordre')
        ->get(),
)->toArray([]);
$pays = App\Pays::get();

$traductionsLayout = App\Http\Resources\TraductionTree::collection(
    App\Traduction::where(function ($query) {
        $query->whereIn('rubrique_id', [13, 14, 22, 23]);
    })
        ->orderBy('ordre')
        ->get()->keyBy->id,
)->toArray([]);
@endphp
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>PERFOBOOST </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Dromen Agency">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <meta name="description" content="">
    <!-- favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/site/skerlingo/images/favicon/faviconn.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets/site/skerlingo/images/favicon/faviconn.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets/site/skerlingo/images/favicon/faviconn.png') }}">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- style sheets and font icons  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/skerlingo/css/font-icons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/skerlingo/css/theme-vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/skerlingo/css/style.css?v=48462761') }}" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/skerlingo/css/custom.css?v=48462761') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/skerlingo/css/responsive.css') }}" />
</head>


<body data-mobile-nav-style="classic">
    <!-- start header -->
    <header class="header-with-topbar header-appear">
        <nav
            class="navbar navbar-expand-lg top-space navbar-light header-light fixed-top navbar-boxed <?php echo isset($lightNav) ? 'light-nav bg-transparent' : 'bg-white top-space'; ?>">
            <div class="container-fluid nav-header-container">
                <div class="col-7 col-lg-2 mr-auto pl-lg-0">
                    <a class="navbar-brand" href="{{ route('home_page_' . Session::get('locale')) }}">
                        <img src="{{ asset('assets/site/skerlingo/images/' . (isset($lightNav) ? 'pb-white-logo.svg' : 'pb-white-logo.svg')) }}"
                            data-at2x="{{ asset('assets/site/skerlingo/images/' . (isset($lightNav) ? 'pb-white-logo.svg' : 'pb-white-logo.svg')) }}"
                            class="default-logo" alt="">
                        <img src="{{ asset('assets/site/skerlingo/images/pb-white-logo.svg') }}"
                            data-at2x="{{ asset('assets/site/skerlingo/images/pb-white-logo.svg') }}"
                            class="mobile-logo" alt="">
                    </a>
                </div>

                <div class="col-auto menu-order px-lg-0">
                    <button class="navbar-toggler float-right" type="button" data-toggle="collapse"
                        data-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                    </button>
                    <div class=" collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown simple-dropdown d-none">
                                <a href="{{ route('home_page_' . Session::get('locale')) }}"
                                    class="nav-link">Accueil</a>
                            </li>
                            @foreach ($rubriquesLayout as $item)
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="{{ count($item['children']->toArray([])) > 0 ? '#' : $item['url_page'] }}"
                                        class="nav-link">{{ $item['label'] }}</a>
                                    <i class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown"
                                        aria-hidden="true"></i>
                                    @if (count($item['children']->toArray([])) > 0)
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach ($item['children']->toArray([]) as $child)
                                                @if ($child['enable'])
                                                    <li class="dropdown"><a
                                                            href="{{ $child['url_page'] }}">{{ $child['label'] }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            <li class="nav-item dropdown simple-dropdown">
                                <a href="{{ route('blog_page_' . Session::get('locale')) }}" class="nav-link">Blog</a>
                            </li>
                            <li class="nav-item dropdown simple-dropdown">
                                <a href="{{ route('contact_page_' . Session::get('locale')) }}"
                                    class="nav-link">Contact</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-auto text-right pr-0 pl-0 font-size-0">
                    <div class="text-center elements-social social-icon-style-05">
                        <ul class="extra-small-icon">
                            <li><a class="facebook" href="#" target="_blank"><i
                                        class="fab fa-facebook-f"></i><span></span></a></li>
                            <li><a class="instagram" href="#" target="_blank"><i
                                        class="fab fa-instagram"></i><span></span></a></li>
                            <li><a class="linkedin" href="#" target="_blank"><i
                                        class="fab fa-linkedin"></i><span></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- end header -->

    @yield('content')


    <!-- start footer -->
    <footer class="footer-dark bg-slate-blue">
        <div class="footer-top padding-four-tb lg-padding-eight-tb sm-padding-50px-tb">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- start footer column -->
                    <div
                        class="col-12 col-lg-4 col-sm-6 order-5 order-lg-0 text-md-center text-lg-left last-paragraph-no-margin_">
                        <a href="#" class="footer-logo margin-25px-bottom margin-5px-top d-inline-block "><img
                                src="{{ asset('assets/site/skerlingo/') }}/images/pb-white-logo-footer.svg"
                                class="border-radius-4px"
                                data-at2x="{{ asset('assets/site/skerlingo/') }}/images/pb-white-logo-footer.svg"
                                alt=""></a>

                        <p class="w-85 margin-15px-bottom">387 BD Mohammed 5, 1er étage, Numéro 3 Casablanca</p>
                        <div><i
                                class="feather icon-feather-phone-call icon-very-small margin-10px-right text-white"></i>+212
                            679-790129</div>
                        <div><i class="feather icon-feather-mail icon-very-small margin-10px-right text-white"></i><a
                                href="#">contact@skerlingo.ma</a></div>
                        <div
                            class="elements-social social-icon-style-05 icon-with-animation d-flex align-items-center">

                            <p class="text-small no-margin-bottom">RETROUVEZ-NOUS SUR</p>
                            <ul class="margin-10px-left small-icon light">
                                <li><a class="facebook" href="#" target="_blank"><i
                                            class="fab fa-facebook-f"></i><span></span></a></li>
                                <li><a class="instagram" href="#" target="_blank"><i
                                            class="fab fa-instagram"></i><span></span></a></li>
                                <li><a class="linkedin" href="#" target="_blank"><i
                                            class="fab fa-linkedin"></i><span></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- end footer column -->
                    <!-- start footer column -->

                    @foreach ($rubriquesLayout as $item)
                        @if (count($item['children']->toArray([])) > 0)
                            <div
                                class="col-12 col-lg col-md-3 col-sm-4 order-1 order-lg-0 md-margin-40px-bottom xs-margin-25px-bottom">
                                <span
                                    class="alt-font text-small font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom  opacity-8 text-uppercase">{{ $item['label'] }}</span>
                                <ul>

                                    @foreach ($item['children']->toArray([]) as $child)
                                        @if ($child['enable'])
                                            <li><a href="{{ $child['url_page'] }}">{{ $child['label'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom padding-20px-tb border-top border-color-white-transparent">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-md-12 text-center last-paragraph-no-margin sm-margin-20px-bottom">
                        <p class="alt-font text-small">© Copyright PERFOBOOST 2021. Designed by <a
                                class="text-decoration-line-bottom text-extra-dark-gray" href="https://dromen.agency"
                                target="_blank">Dromen Agency</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!-- start scroll to top -->
    <a class="scroll-top-arrow bg-fast-blue" href="javascript:void(0);"><i
            class="feather icon-feather-chevron-up text-white"></i></a>
    <!-- end scroll to top -->
    <!-- javascript -->
    <script type="text/javascript" src="{{ asset('assets/site/skerlingo/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/site/skerlingo/js/theme-vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/site/skerlingo/js/main.js?v=48462761') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-fr_FR.js"></script>
    <script type="text/javascript" src="{{ asset('assets/site/skerlingo/js/custom.js?v=48462761') }}"></script>
</body>

</html>
