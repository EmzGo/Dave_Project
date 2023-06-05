<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('assets/front/css/owl.carousel.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/front/images/Favicon.jpg') }}">

    <title>Home</title>

    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body>

    <div class="p-wrapper">
        <div class="p-socails-header">
            <ul>
                <li>
                    <a href="https://www.facebook.com/photowalksindia" target="_blank"><img src="{{ asset('assets/front/images/facebook.png') }}"></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/photowalksindia/?hl=en" target="_blank"><img src="{{ asset('assets/front/images/instagram.png') }}"></a>
                </li>
            </ul>
        </div>
        <header class="p-header">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand d-lg-none d-md-none" href="#"><img src="{{ asset('assets/front/images/logo-mobile.png') }}"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.index') }}">home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.about_us') }}">about</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.gallery') }}">gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.index') }}"><img src="{{ asset('assets/front/images/Logo.png') }}" alt=""></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.schedule') }}">schedule</a>
                            </li>
                            <li class="nav-item t-common-outline-btn">
                                <a class="nav-link" href="{{ route('front.contact_us') }}">contact us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- start page title -->
        @yield('content')
        <!-- end page title -->
    </div>
    @php
        $cities = \App\Models\City::where('status', 1)->get();
    @endphp
    <footer class="p-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 text-center">
                    <div class="p-footer-logo">
                        <img src="{{ asset('assets/front/images/Logo.png') }}" alt="">
                        <p class="p-white mb-0">© 2022 PhotoWalks India. All rights reserved</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="p-black-footer">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"
                                placeholder="Enter Mail Id to get latest updates and be a part of our community"
                                aria-label=" " aria-describedby=" ">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="p-links-footer">
                                            <ul>
                                                <h6>Cities</h6>
                                                @if ($cities->isNotEmpty())
                                                    @foreach ($cities as $city)
                                                        <li><a href="{{ route('front.schedule', $city->name) }}">{{ $city->name }}</a></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="p-links-footer">
                                            <ul>
                                                <h6>PhotoWalks</h6>
                                                <li><a href="#"> Heritage Walk CST </a></li>
                                                <li><a href="#"> Dobhi Ghat </a></li>
                                                <li><a href="#"> Kotachi Wadi </a></li>
                                                <li><a href="#"> Mandai </a></li>
                                                <li><a href="#"> Shaniwar Wada </a></li>
                                                <li><a href="#"> Pottery Town </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="p-links-footer">
                                            <ul>
                                                <h6> Explore </h6>
                                                <li><a href="#"> Mentors </a></li>
                                                <li><a href="#"> Gallery </a></li>
                                                <li><a href="#"> Fujifilm World </a></li>
                                                <li><a href="#"> Workshops </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="p-links-footer">
                                            <ul>
                                                <h6>Information </h6>
                                                <li> <a href="{{ route('front.about_us') }}"> About </a></li>
                                                <li><a href="{{ route('front.contact_us') }}"> Contact Us</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-bottom-logo">
                                <div class="logo-white">
                                    <p>in association</p>
                                    <img src="{{ asset('assets/front/images/footer-bottom-logo.png') }}" alt="">
                                </div>
                                <div class="potowala-link">
                                    <div class="follow-link">
                                        <ul>
                                            <li>Follow Us</li>
                                            <li>
                                                <a href="https://www.facebook.com/photowalksindia" target="_blank"><img src="{{ asset('assets/front/images/facebook.png') }}"></a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/photowalksindia/?hl=en" target="_blank"><img src="{{ asset('assets/front/images/instagram.png') }}"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="#">#photowalksindia</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/front/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/libs/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/libs/validate/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        // img-city-box
        $(document).ready(function() {
            $('.blog-slider').owlCarousel({
                loop: true,
                margin: 30,
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        margin: 15,
                        stagePadding: 30,
                    },
                    768: {
                        items: 2,
                        margin: 15,
                        stagePadding: 100,
                    },
                    1024: {
                        items: 3,
                        margin: 15,
                        stagePadding: 150,
                    },
                    1366: {
                        items: 3
                    }
                }
            })
        })
    </script>
    <script type="text/javascript">
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 7000
        });
    </script>
    @if (Session::has('alert-message'))
        <script type="text/javascript">
            Toast.fire({
                type: "{{ Session::get('alert-class', 'info') }}",
                title: "{{ Session::get('alert-message') }}"
            });
        </script>
    @endif
    @stack('after-scripts')
    @if (trim($__env->yieldContent('page-script')))
        @yield('page-script')
    @endif

</body>

</html>
