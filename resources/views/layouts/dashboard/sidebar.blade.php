<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <img src="images/g.png" class="img-fluid" alt="">
            <span style="margin:0cm; color: #FF4500; font-weight: bold;">GulaBalap</span>
        </a>
        {{-- <div class="iq-menu-bt align-self-center">
            <div class="wrapper-menu">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </div> --}}
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="@if (request()->url() == route('dashboard')) active @endif">
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect">
                        <i class="ri-dashboard-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="@if (request()->url() == route('sensor.all')) active @endif">
                    <a href="{{ route('sensor.all') }}" class="iq-waves-effect">
                        <i class="ri-sensor-fill"></i>
                        <span>Sensor</span>
                    </a>
                </li>
                <li class="@if (request()->url() == route('leds.index')) active @endif">
                    <a href="{{ route('leds.index') }}" class="iq-waves-effect">
                        <i class="ri-lightbulb-fill"></i>
                        <span>LED Control</span>
                    </a>
                </li>
                <li class="@if (request()->url() == route('users.index')) active @endif">
                    <a href="{{ route('users.index') }}" class="iq-waves-effect">
                        <i class="ri-user-5-fill"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>

<style>
    .iq-sidebar {
        background-color: #343a40;
        color: #ffffff;
        transition: background-color 0.3s ease;
    }

    .iq-sidebar-logo a {
        color: #ffffff;
        font-size: 24px;
    }

    .iq-sidebar-logo img {
        max-width: 40px;
    }

    .iq-menu-bt .wrapper-menu .line-menu {
        background-color: #ffffff;
    }

    .iq-sidebar-menu ul.iq-menu {
        padding: 0;
    }

    .iq-sidebar-menu ul.iq-menu li {
        list-style: none;
    }

    .iq-sidebar-menu ul.iq-menu li a {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        color: #ffffff;
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .iq-sidebar-menu ul.iq-menu li a:hover,
    .iq-sidebar-menu ul.iq-menu li.active a {
        background-color: #FF4500;
        color: #ffffff;
        border-radius: 4px;
    }

    .iq-sidebar-menu ul.iq-menu li a i {
        margin-right: 10px;
        font-size: 18px;
    }

    .iq-sidebar-menu ul.iq-menu li.active a i {
        color: #ffffff;
    }
</style>
