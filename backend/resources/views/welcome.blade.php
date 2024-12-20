<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>PrecisePresence - App precision attandance </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" " />
    <meta name="keywords" content="" />
    <meta content="Themesdesign" name="author" />

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}" type="text/css" id="bootstrap-style" />





    <!-- Material Icon Css -->
    <link rel="stylesheet" href="{{ asset('landing/css/materialdesignicons.min.css') }}" type="text/css" />

    <!-- Unicon Css -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('landing/css/tiny-slider.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('landing/css/swiper.min.css') }}" type="text/css" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('landing/css/style.min.css') }}" type="text/css" />

    <!-- colors -->
    <link href="{{ asset('landing/css/colors/default.css') }}" rel="stylesheet" type="text/css" id="color-opt" />

</head>

<body data-bs-spy="scroll" data-bs-target="#navbarCollapse">

    <!-- light-dark mode button -->
    <a href="javascript: void(0);" id="mode" class="mode-btn text-white rounded-end" onclick="toggleBtn()">
        <i class="uil uil-brightness mode-dark mx-auto"></i>
        <i class="uil uil-moon bx-spin mode-light"></i>
    </a>

    <!-- START  NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-light" id="navbar">
        <div class="container-fluid">

            <!-- LOGO -->
            <a class="navbar-brand logo text-uppercase" href="index-1.html">
                <img src="images/logo-light.png" class="logo-light" alt="" height="30">
                <img src="images/logo-dark.png" class="logo-dark" alt="" height="30">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto" id="navbar-navlist">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#app">Application</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Login</a>
                    </li>
                </ul>
                <div class="ms-auto">
                </div>
            </div>
        </div>
    </nav>
    <!-- END NAVBAR -->



    <!-- home section -->
    <section class="home bg-light" id="home">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="images/baby-phone.png" alt="" class="img-fluid mb-4 smallphone-image">
                    <h1 class="display-5 fw-bold">Revolutionize Attendance with Precision</h1>
                    <p class="mt-4 text-muted">Say goodbye to outdated attendance systems!
                        PrecisePresence combines advanced Facial Recognition and GPS Accuracy to streamline attendance tracking like never before.</p>
                        <a href="application/PrecisePresence.apk" download class="btn bg-gradiant mt-4">Download App</a>
                </div>



                <div class="col-lg-5 offset-md-1 ">
                    <img src="{{ asset('landing/pp.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->

        <div class="background-line"></div>
    </section>
    <!-- end home section -->



    <!-- service section -->
    <section class="section service bg-light" id="service">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title text-center mb-5">
                        <h6 class="mb-0 fw-bold text-primary">PrecisePresence</h6>
                        <h2 class="f-40">Attendance never this easy!</h2>
                        <div class="border-phone">
                            <p class="text-muted">All your attendance needs, at your fingertips.</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between">
                <div class="col-lg-4">
                    <div class="service-box text-center">
                        <div class="service-icon p-4"
                            style="background-image: url(./images/service/bomb.png); background-repeat: no-repeat; background-position: center;">
                            <i class="mdi mdi-security text-gradiant f-30"></i>
                        </div>

                        <div class="service-content mt-4">
                            <a href="">
                                <h5 class="fw-bold">Fully Secured</h5>
                            </a>
                            <p class="text-muted">PrecisePresence ensures your data is protected with advanced
                                encryption and secure cloud storage. Your privacy and security are our top priorities.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pt-4 pt-lg-0">
                    <div class="service-box text-center shadow">
                        <div class="service-icon p-4"
                            style="background-image: url(./images/service/bomb.png); background-repeat: no-repeat; background-position: center;">
                            <i class="mdi mdi-lightbulb-on text-gradiant f-30"></i>
                        </div>

                        <div class="service-content mt-4">
                            <a href="">
                                <h5 class="fw-bold">Future of Attendance</h5>
                            </a>
                            <p class="text-muted">Revolutionize the way you track attendance with cutting-edge facial recognition and GPS technology.
                                Say goodbye to outdated methods!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 pt-4 pt-lg-0">
                    <div class="service-box text-center">
                        <div class="service-icon p-4"
                            style="background-image: url(./images/service/bomb.png); background-repeat: no-repeat; background-position: center;">
                            <i class="mdi mdi-google-nearby text-gradiant f-30"></i>
                        </div>

                        <div class="service-content mt-4">
                            <a href="">
                                <h5 class="fw-bold">Beyond Attendance</h5>
                            </a>
                            <p class="text-muted">Manage more than just attendance—handle leave requests
                                seamlessly within the same platform, making workforce management easier than ever.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->


    <!-- start features -->
    <div class="section features" id="features">
        <!-- start container -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title text-center mb-5">
                        <h6 class="mb-0 fw-bold text-primary">PrecisePresence Features</h6>
                        <h2 class="f-40">Features from our app </h2>
                        <p class="text-muted">Lest get to know our app.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">


                <div class="col-lg-12">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item mb-3" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Top Features</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row align-items-center">
                                <div class="col-lg-4 order-2 order-lg-first">
                                    <div class="features-item text-start text-lg-end">
                                        <div class="icon avatar-sm text-center ms-lg-auto rounded-circle">
                                            <i class="mdi mdi-message-alert-outline f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Modern Features</h5>
                                            <p>Take attendance with ease using advanced face recognition and GPS technology, making every check-in accurate and secure.</p>
                                        </div>
                                    </div>

                                    <div class="features-item text-start text-lg-end mt-5">
                                        <div class="icon avatar-sm text-center ms-lg-auto rounded-circle">
                                            <i class="mdi mdi-autorenew f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Lifetime Support</h5>
                                            <p>Enjoy 24/7 support to assist with any issues, updates, or questions, ensuring a seamless user experience for both employees and administrators.</p>
                                        </div>
                                    </div>

                                    <div class="features-item text-start text-lg-end mt-5 mb-5">
                                        <div class="icon avatar-sm text-center ms-lg-auto rounded-circle">
                                            <i class="mdi mdi-eyedropper f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Stunning Design</h5>
                                            <p>Experience a visually appealing interface designed for intuitive navigation and an effortless user experience for everyone.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img src="{{ asset('landing/home.png') }}" alt="" class="img-fluid">
                                </div>
                                <div class="col-lg-4 order-last">
                                    <div class="features-item">
                                        <div class="icon avatar-sm text-center rounded-circle">
                                            <i class="mdi mdi-lifebuoy f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Advanced Management</h5>
                                            <p>Admins can manage multiple locations, divisions, and attendance settings, set the system to their organization's needs with precision.</p>
                                        </div>
                                    </div>

                                    <div class="features-item mt-5">
                                        <div class="icon avatar-sm text-center rounded-circle">
                                            <i class="mdi mdi-dropbox f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Comprehensive Reporting</h5>
                                            <p>Access detailed monthly reports, tracking employee lateness, leave, and attendance while allowing admins to approve or reject leave requests efficiently.</p>
                                        </div>
                                    </div>

                                    <div class="features-item mt-5">
                                        <div class="icon avatar-sm text-center rounded-circle">
                                            <i class="mdi mdi-flask f-24"></i>
                                        </div>
                                        <div class="content mt-3">
                                            <h5>Responsive Design</h5>
                                            <p>Easily adapt PrecisePresence to any device with its responsive design, ensuring a smooth experience whether on a phone, tablet, or computer.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">

                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <img src="images/features/phone2.png" alt="" class="img-fluid">
                                </div>

                                <div class="col-lg-6">
                                    <h2 class="mb-4">Smart Features</h2>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="features-box mt-4">
                                                <div class="d-flex">
                                                    <div class="icon">
                                                        <i class="mdi mdi-check-circle f-20 me-2"></i>
                                                    </div>
                                                    <div class="heading">
                                                        <h6 class="mt-1">Fast Messaging</h6>
                                                        <p class="text-muted">Soluta velit sint, esse quis tempora
                                                            impedit corrupti in recusandae tenetur dignissimos
                                                            voluptates..</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="features-box mt-4">
                                                <div class="d-flex">
                                                    <div class="icon">
                                                        <i class="mdi mdi-check-circle f-20 me-2"></i>
                                                    </div>
                                                    <div class="heading">
                                                        <h6 class="mt-1">User Freindly</h6>
                                                        <p class="text-muted">Amet repudiandae illo quasi enim iusto
                                                            corporis ratione? Laudantium reprehenderit sint provident.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="features-box mt-4">
                                                <div class="d-flex">
                                                    <div class="icon">
                                                        <i class="mdi mdi-check-circle f-20 me-2"></i>
                                                    </div>
                                                    <div class="heading">
                                                        <h6 class="mt-1">Minimal Interface</h6>
                                                        <p class="text-muted">Repellat ad in autem, odio quos ex eum
                                                            recusandae cupiditate assumenda nihil incidunt dolorem qui
                                                            soluta.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="features-box mt-4">
                                                <div class="d-flex">
                                                    <div class="icon">
                                                        <i class="mdi mdi-check-circle f-20 me-2"></i>
                                                    </div>
                                                    <div class="heading">
                                                        <h6 class="mt-1">Notification</h6>
                                                        <p class="text-muted">Ipsam nisi quam velit maxime corrupti ut
                                                            quos, ad eum laudantium voluptatibus, facilis numquam
                                                            repellendus.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end features -->



    <!-- start testimonial -->
    <section class="section bg-light testimonial" id="testimonial">
        <!-- start container -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="title">
                        <p class=" text-primary fw-bold mb-0">Client Testimonial <i
                                class="mdi mdi-cellphone-iphone"></i>
                        </p>
                        <h3>What they think of us!</h3>
                        <p class="text-muted">These are testimonials from clients who have already used our app.</p>
                        <button class="btn bg-gradiant">Read More Testimonial <i
                                class="mdi mdi-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="testi-slider" id="testi-slider">
                        <div class="item">
                            <div class="testi-box position-relative overflow-hidden">
                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <img src="{{ asset('landing/mek.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-4">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar">
                                                        <img src="" alt=""
                                                            class="img-fluid rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <p class="f-14 mb-0 text-dark fw-bold"><span
                                                            class="text-muted fw-normal">Review By </span> Malik Abdul Azis
                                                    </p>
                                                    <div class="date">
                                                        <p class="text-muted mb-0 f-14">28 jan, 2024 <span>10:25
                                                                AM</span></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <h5 class="fw-bold">Intuitive interface, enjoyable experience.</h5>
                                                <p class="text-muted f-14">Start working with PrecisePresence that can provide
                                                    everything you need to attendance, permission, and remote work.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="back-image position-absolute end-0 bottom-0">
                                    <img src="images/testi/rating-image.png" alt="" class="img-fluid">
                                </div>

                            </div>
                        </div>
                        <!-- slider item -->


                        <!-- slider item -->

                        <!-- slider item -->

                        <!-- slider item -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end testimonial -->



    <!-- pricing section -->

    <!-- end pricing -->



    <!-- slider section -->
    <section class="section app-slider bg-light" id="app">
        <!-- start container -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title text-center mb-5">
                        <h6 class="mb-0 fw-bold text-primary">App Screen!</h6>
                        <h2 class="f-40">See our App Screenshots!</h2>
                        <p class="text-muted">PrecisePresence is designed with a user-friendly interface and intuitive navigation, ensuring a seamless experience.
                            Enjoy modern UI/UX that simplifies attendance and leave management at your fingertips.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper-container">
                        <div class="fream-phone ">
                            <img src="images/testi/phone-fream.png" alt="" class="img-fluid">
                        </div>

                        <div class="swiper-wrapper">
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/1.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/2.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/3.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/4.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/5.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="swiper-slide border-radius">
                                <img src="{{ asset('landing/5.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>

                        <!-- navigation buttons -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
    </section>
    <!-- end section -->



    <!-- team section -->
    {{-- <section class="section team" id="team">
        <!-- start container -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="title text-center mb-5">
                        <h6 class="mb-0 fw-bold text-primary">Our Team!</h6>
                        <h2 class="f-40">A dedicated team of experts!</h2>
                        <p class="text-muted">Always seeking innovative solutions to overcome any challenge.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-lg-3 col-md-6">
                    <div class="team-box text-end">
                        <div class="row justify-content-end">
                            <div class="col-lg-9 col-10">
                                <div class="team-image">
                                    <img src="images/team/img1.png" alt="" class="img-fluid">
                                </div>
                                <div class="team-icon ">
                                    <div class="d-flex mt-2">
                                        <div class="social-icon facebook mx-2">
                                            <a href=""> <i class="mdi mdi-facebook f-20"></i></a>
                                        </div>
                                        <div class="social-icon instagram mx-2">
                                            <a href=""><i class="mdi mdi-instagram f-20"></i></a>
                                        </div>
                                        <div class="social-icon twitter mx-2">
                                            <a href=""><i class="mdi mdi-twitter f-20"></i></a>
                                        </div>
                                        <div class="social-icon linkedin mx-2">
                                            <a href=""><i class="mdi mdi-linkedin f-20"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-info position-absolute">
                            <h6>Nurfauzi <span class="f-14 text-muted fw-normal">/ Developer</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-box">
                        <div class="row justify-content-end">
                            <div class="col-lg-9 col-10">
                                <div class="team-image text-end">
                                    <img src="images/team/img4.png" alt="" class="img-fluid">
                                </div>
                                <div class="team-icon">
                                    <div class="d-flex mt-2">
                                        <div class="social-icon facebook mx-2">
                                            <a href=""> <i class="mdi mdi-facebook f-20"></i></a>
                                        </div>
                                        <div class="social-icon instagram mx-2">
                                            <a href=""><i class="mdi mdi-instagram f-20"></i></a>
                                        </div>
                                        <div class="social-icon twitter mx-2">
                                            <a href=""><i class="mdi mdi-twitter f-20"></i></a>
                                        </div>
                                        <div class="social-icon linkedin mx-2">
                                            <a href=""><i class="mdi mdi-linkedin f-20"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-info position-absolute">
                            <h6>Shofwah <span class="f-14 text-muted fw-normal">/ Designer</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-box">
                        <div class="row justify-content-end">
                            <div class="col-lg-9 col-10">
                                <div class="team-image text-end">
                                    <img src="images/team/img3.png" alt="" class="img-fluid">
                                </div>
                                <div class="team-icon">
                                    <div class="d-flex mt-2">
                                        <div class="social-icon facebook mx-2">
                                            <a href=""> <i class="mdi mdi-facebook f-20"></i></a>
                                        </div>
                                        <div class="social-icon instagram mx-2">
                                            <a href=""><i class="mdi mdi-instagram f-20"></i></a>
                                        </div>
                                        <div class="social-icon twitter mx-2">
                                            <a href=""><i class="mdi mdi-twitter f-20"></i></a>
                                        </div>
                                        <div class="social-icon linkedin mx-2">
                                            <a href=""><i class="mdi mdi-linkedin f-20"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-info position-absolute">
                            <h6>Dhio <span class="f-14 text-muted fw-normal">/ Developer</span></h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="team-box">
                        <div class="row justify-content-end">
                            <div class="col-lg-9 col-10">
                                <div class="team-image text-end">
                                    <img src="images/team/img2.png" alt="" class="img-fluid">
                                </div>
                                <div class="team-icon">
                                    <div class="d-flex mt-2">
                                        <div class="social-icon facebook mx-2">
                                            <a href=""> <i class="mdi mdi-facebook f-20"></i></a>
                                        </div>
                                        <div class="social-icon instagram mx-2">
                                            <a href=""><i class="mdi mdi-instagram f-20"></i></a>
                                        </div>
                                        <div class="social-icon twitter mx-2">
                                            <a href=""><i class="mdi mdi-twitter f-20"></i></a>
                                        </div>
                                        <div class="social-icon linkedin mx-2">
                                            <a href=""><i class="mdi mdi-linkedin f-20"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="team-info position-absolute">
                            <h6>Azahra <span class="f-14 text-muted fw-normal">/ Designer</span></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end container -->
    </section> --}}
    <!-- end section -->



    <!-- cta section -->
    <section class="section cta" id="cta">
        <div class="bg-overlay-gradiant"></div>
        <!-- start container -->
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-6">
                    <div class="py-5">
                        <h1 class="display-5 text-white">The future of attendance, today.</h1>
                        <p class="text-white-50 mt-3 f-18">PrecisePresence is an  attendance app.
                            Available for download on both iOS and Android platforms,
                            allowing users to track attendance,manage leave requests, and generate comprehensive reports
                            </p>
                        <div class="d-flex mt-4 ">
                            <div class="app-store">
                                <a href=""><img src="images/img-appstore.png" alt="" class="img-fluid"></a>
                            </div>
                            <div class="googleplay">
                                <a href=""><img src="images/img-googleplay.png " alt="" class="img-fluid ms-3"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-phone-image">
                        <img src="images/cta-bg.png" alt="" class=" img-fluid">
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->


    <!-- contact section -->
    <section class="section contact overflow-hidden" id="contact">
        <!-- start container -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="title text-center mb-5">
                        <h6 class="mb-0 fw-bold text-primary">Contact Us</h6>
                        <h2 class="f-40">Get In Touch!</h2>
                        <p class="text-muted">.</p>

                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="contact-box">
                        <div class="mb-4">
                            <h4 class=" fw-semibold mb-1">Contact for Support</h4>
                            <p class="text-muted">Contact us for further help , join us now!.</p>
                        </div>

                        <div class="custom-form mt-4 ">
                            <form method="post" name="myForm" onsubmit="return validateForm()">
                                <p id="error-msg" style="opacity: 1;">
                                    <!-- <div class="alert alert-warning">*Please enter a Name*</div> -->
                                </p>

                                <div id="simple-msg"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="name" id="name" type="text" class="form-control contact-form"
                                                placeholder="Your name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input name="email" id="email" type="email"
                                                class="form-control contact-form" placeholder="Your email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mt-2">
                                            <input type="text" class="form-control contact-form" id="subject"
                                                placeholder="Your Subject..">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mt-2">
                                            <textarea name="comments" id="comments" rows="4"
                                                class="form-control contact-form h-auto"
                                                placeholder="Your message..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-lg-12 d-grid">
                                        <input type="submit" id="submit" name="send"
                                            class="submitBnt btn btn-rounded btn-primary" value="Send Message">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-lg-7">
                    <div class="m-5">
                        <div class="position-relative">
                            <div class="contact-map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.482954032423!2d112.61612090000001!3d-7.948940185308463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1734170748577!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="mdi mdi-google-maps f-50 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Location</h5>
                            <p class="f-14 mb-0 text-muted">Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mt-4 mt-lg-0">
                        <div class="flex-shrink-0">
                            <i class="mdi mdi-email f-50 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Email</h5>
                            <p class="f-14 mb-0 text-muted">Email: ZiDhiShofZar@precisepresence.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mt-4 mt-lg-0">
                        <div class="flex-shrink-0">
                            <i class="mdi mdi-phone f-50 text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1">Phone</h5>
                            <p class="f-14 mb-0 text-muted">08123456789</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end section -->



    <!-- footer section -->
    <section class=" section footer bg-dark overflow-hidden">
        <div class="bg-arrow">

        </div>
        <!-- container -->
        <div class="container">
            <div class="row ">
                <div class="col-lg-4">
                    <a class="navbar-brand logo text-uppercase" href="index-1.html">
                        <img src="images/logo-footer.png" class="logo-light" alt="" height="30">
                    </a>
                    <p class="text-white-50 mt-2 mb-0"></p>

                    <div class="footer-icon mt-4">
                        <div class=" d-flex align-items-center">
                            <a href="" class="me-2 avatar-sm text-center" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Facebook">
                                <i class="mdi mdi-facebook f-24 align-middle text-primary"></i>
                            </a>
                            <a href="" class="mx-2 avatar-sm text-center" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Twitter">
                                <i class="mdi mdi-twitter f-24 align-middle text-primary"></i>
                            </a>
                            <a href="" class="mx-2 avatar-sm text-center" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Googleplay">
                                <i class="mdi mdi-google-play f-24 align-middle text-primary"></i>
                            </a>
                            <a href="" class="mx-2 avatar-sm text-center" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="Linkedin">
                                <i class="mdi mdi-linkedin f-24 align-middle text-primary"></i>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="text-start mt-4 mt-lg-0">
                        <h5 class="text-white fw-bold">Product</h5>
                        <ul class="footer-item list-unstyled footer-link mt-3">
                            <li><a href="">Features</a></li>
                            <li><a href="">Pricing</a></li>
                            <li><a href="">Get App</a></li>
                            <li><a href="">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 ">
                    <div class="text-start">
                        <h5 class="text-white fw-bold">Policies</h5>
                        <ul class="footer-item list-unstyled footer-link mt-3">
                            <li><a href="">Security & Provciy</a></li>
                            <li><a href="">Marketplace</a></li>
                            <li><a href="">Term & Condition</a></li>
                            <li><a href="">Collection</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <h5 class="text-white">Subscribe</h5>
                    <div class="input-group my-4">
                        <input type="text" class="form-control p-3" placeholder="subscribe" aria-label="subscribe"
                            aria-describedby="basic-addon2">
                        <a href="" class="input-group-text bg-primary text-white px-4" id="basic-addon2">Go</a>
                    </div>
                    <p class="mb-0 text-white-50">publishes will show up in your Subscriptions feed. You may also start.
                    </p>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>

    <section class="bottom-footer py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <p class="mb-0 text-center text-muted">©
                        <script>document.write(new Date().getFullYear())</script> PrecisePresence
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- end footer -->


    <!-- Style switcher -->
    <div class="style-switcher" id="style-switcher" onclick="toggleSwitcher()" style="left: -189px;">
        <div>
            <h6>Select your color</h6>
            <ul class="pattern list-unstyled mb-0">
                <li>
                    <a class="color1" href="javascript: void(0);" onclick="setColor('default')"></a>
                </li>
                <li>
                    <a class="color2" href="javascript: void(0);" onclick="setColor('blue')"></a>
                </li>
                <li>
                    <a class="color3" href="javascript: void(0);" onclick="setColor('warning')"></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end switcher-->



    <!--Bootstrap Js-->
    <script src="{{ asset('landing/js//bootstrap.bundle.min.js') }}"></script>

    <!-- Slider Js -->
    <script src="{{ asset('landing/js//tiny-slider.js') }}"></script>
    <script src="{{ asset('landing/js//swiper.min.js') }}"></script>



    <!-- App Js -->
    <script src="{{ asset('landing/js//app.js') }}"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    </script>

</body>

</html>
