<div class="iq-top-navbar" style="background-color: #333">
    <div class="iq-navbar-custom">
        <div class="iq-sidebar-logo">
            <div class="top-logo">
                <a href="index.html" class="logo">
                    <!-- <img src="image/header/logo-iot.png" class="img-fluid" alt=""> -->
                    <span>GulaBalap</span>
                </a>
            </div>
        </div>
        @isset($breadcrumbs)
        <div class="navbar-breadcrumb">
            <h5 class="mb-0" style="color:red">{{ $title ?? 'Dashboard' }}</h5>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    @foreach ($breadcrumbs as $i => $breadcrumb)
                    @if ($i == count($breadcrumbs) - 1)
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                    @else
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] }}"> {{ $breadcrumb['title'] }} </a>
                    </li>
                    @endif
                    @endforeach
                    {{-- <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li> --}}
                </ul>
            </nav>
        </div>
        @endisset

        <nav class="navbar navbar-expand-lg navbar-light p-0">
            {{-- <div class="iq-menu-bt align-self-left d-flex">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="wrapper-menu ml-2">
                    <div class="line-menu half start"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu half end"></div>
                </div>
            </div> --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item iq-full-screen"><a href="#" class="iq-waves-effect" id="btnFullscreen"><i class="ri-fullscreen-line"></i></a></li>
                </ul>
            </div>
            <ul class="navbar-list">
                <li>
                    <a href="#" class="search-toggle iq-waves-effect bg-primary text-white"><img src="images/user/01.jpg" class="img-fluid rounded" alt="user"></a>
                    <div class="iq-sub-dropdown iq-user-dropdown">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height shadow-none m-0">
                            <div class="iq-card-body p-0 ">
                                <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello {{ auth()->user()->name }}</h5>
                                    <span class="text-white font-size-12">Have a nice day 😍</span>
                                </div>

                                <div class="d-inline-block w-100 text-center p-3">
                                    <a class="iq-bg-danger iq-sign-btn" href="{{ route('logout') }}" role="button">Sign
                                        out<i class="ri-login-box-line ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<style>
    /* Style untuk navbar-list */
    .navbar-list .iq-user-dropdown {
        background-color: #000; /* Latar belakang hitam */
    }

    .navbar-list .iq-sub-card:hover {
        background-color: #FFA500; /* Warna oranye pada hover */
    }

    /* Style untuk iq-sub-dropdown */
    .iq-sub-dropdown {
        background-color: #000; /* Latar belakang hitam */
    }

    /* Style untuk iq-sub-card pada hover */
    .iq-sub-card:hover {
        background-color: #FFA500 !important; /* Warna oranye pada hover dengan !important untuk prioritas */
    }

    /* Style untuk iq-card-body */
    .iq-card-body {
        background-color: #000; /* Latar belakang hitam */
        color: white; /* Warna teks putih */
    }

    /* Style untuk text dalam card-body */
    .iq-card-body .text-white {
        color: white !important; /* Warna teks putih */
    }

    .iq-card-body .font-size-12 {
        color: white !important; /* Warna teks putih */
    }

    .iq-card-body h5 {
        color: white !important; /* Warna teks putih */
    }
</style>
