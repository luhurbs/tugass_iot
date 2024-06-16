<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Create a stylish landing page for your business startup and get leads for the offered services with this free HTML landing page template.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>GulaBalap</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
    <link href="css/magnific-popup.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="images/g.png">
    <style>
        .copyright {
            background-color: #333;
            /* Warna latar belakang */
            color: crimson;
            /* Warna teks */
            padding: 20px 0;
            /* Padding atas dan bawah */
            text-align: center;
            /* Pusatkan teks */
            font-weight: bold;
            /* Teks tebal */
            font-size: 12px;
            /* Ukuran teks */
        }

        .copyright a {
            color: crimson;
            /* Warna teks link */
            text-decoration: none;
            /* Hapus dekorasi garis bawah */
            font-weight: bold;
            /* Teks tebal */
        }

        .copyright a:hover {
            text-decoration: underline;
            /* Tambahkan garis bawah pada hover */
        }
        .p-small {
            font-size: 15px;
            /* Ukuran teks */
        }
    </style>
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Evolo</a> -->

        <!-- Image Logo -->
        {{-- untuk mengganti logo kanan kiri --}}
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="images/g.svg" alt="alternative" class="logo-image" style="height: 40px; margin-right: 10px;">
            <span class="logo-text" style="color: rgb(10, 10, 10)">GulaBalap</span>
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-awesome fas fa-bars"></span>
            <span class="navbar-toggler-awesome fas fa-times"></span>
        </button>
        <!-- end of mobile menu toggle button -->

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="#header">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="https://github.com/luhurbs">Contact</a>

                </li>


                {{-- cek apakah sudah login --}}
                @if (Auth::check())
                {{-- jika sudah tampilkan menu dashbord dan logout --}}
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('logout') }}">Logout</a>
                </li>
                @else
                {{-- Jika belum tampilkan register dan login --}}
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('login') }}">Login</a>
                </li>
                <span class="nav-item social-icons">
                    <span class="fa-stack">
                        <a href="https://www.instagram.com/luhurbs/">
                            <i class="fas fa-circle fa-stack-2x instagram"></i>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    @endif

            </ul>
            {{-- <span class="nav-item social-icons">
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x facebook"></i>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                </span>
                <span class="fa-stack">
                    <a href="#your-link">
                        <i class="fas fa-circle fa-stack-2x twitter"></i>
                        <i class="fab fa-twitter fa-stack-1x"></i>
                    </a>
                </span>
            </span> --}}
        </div>
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h1><span class="turquoise">GulaBalap</span><span style="color:yellow"> Internet Of Things</span></h1>
                            <p class="p-large">Use GulaBalap Internet Of Things to Control and Monitor Electronics in
                                Your Dream Home</p>
                            {{-- <p class="p-large">Use Evolo free landing page template to promote your business startup and generate leads for the offered services</p> --}}

                            @if (Auth::check())
                            <a class="btn-solid-lg page-scroll" href="{{ route('dashboard') }}">Dashboard</a>
                            @else
                            <a class="btn-solid-lg page-scroll" href="{{ route('login') }}">Login</a>
                            @endif
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6">
                        <div class="image-container">
                            <img class="img-fluid" src="images/dashboardd.svg" alt="alternative">
                        </div> <!-- end of image-container/gambar besar -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->

    <!-- Services -->
    <div id="services" class="cards-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>What is GulaBalap Internet of Things?</h2>
                    <p class="p-heading p-large">GulaBalap Internet of Things provides smart solutions that unite everyday devices in a seamless network, putting control and convenience at your fingertips.</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="cards-1">
                        <div class="card">
                            <img class="card-image" src="images/iot1.svg" alt="alternative">
                            <div class="card-body">
                                <h4 class="card-title">Unlimited Connectivity with GulaBalap IoT</h4>
                                <p>Enjoy the convenience of connecting all your devices in one ecosystem with GulaBalap IoT technology, from smart homes to smart offices.</p>
                            </div>
                        </div>

                        <!-- Card -->
                        <div class="card">
                            <img class="card-image" src="images/iot2.svg" alt="alternative">
                            <div class="card-body">
                                <h4 class="card-title">Why Choose GulaBalap IoT?</h4>
                                <p>GulaBalap IoT offers a secure, easy-to-use and reliable system, helping you manage and control devices from anywhere and at any time</p>
                            </div>
                        </div>
                        <!-- end of card -->

                        <!-- Card -->
                        <div class="card">
                            <img class="card-image" src="images/services-icon-3.svg" alt="alternative">
                            <div class="card-body">
                                <h4 class="card-title">Action Plan</h4>
                                <p>With all the information in place you will be presented with an action plan that your company needs to follow</p>
                            </div>
                        </div>
                        <!-- end of card -->
                    </div>

                    <!-- end of card -->


                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of services -->

    <!-- About -->
    <div id="about" class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>About Me</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">


                    <!-- Team Member -->
                    <div class="team-member">
                        <div class="image-wrapper">
                            <img class="img-fluid" src="images/team-member-2.svg" alt="alternative">
                        </div> <!-- end of image wrapper -->
                        <p class="p-large"><strong>Luhur Budi Santoso</strong></p>
                        <p class="job-title">Electrical Engineering</p>
                        <!-- end of social-icons -->
                    </div> <!-- end of team-member -->
                    <!-- end of team member -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-4 -->
    <!-- end of about -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">
                        Copyright © <a href="#">IoT Panel</a> by
                        <a href="https://www.instagram.com/luhurbs/">LuhurBs</a>
                    </p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div>
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>

</html>