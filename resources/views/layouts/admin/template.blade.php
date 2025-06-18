<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo1.png') }}">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        .navbar-text {
            font-size: 1.5rem;
            /* Adjust the font size as needed */
            font-weight: bold;
            /* Optional: make it bold */
            color: black;
            /* Set the color to black */
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="/dashboard">
                        <b class="logo-icon">
                            <img src="{{ asset('assets/images/logo1.png') }}" alt="homepage" class="dark-logo" />
                        </b>
                        <style>
                            .navbar-text {
                                font-size: 1.5rem;
                                font-weight: bold;
                                color: black;
                            }

                            /* Fixed Logo Styles */
                            .navbar-brand {
                                display: flex;
                                padding: 8px 16px;
                                text-decoration: none;
                            }

                            .navbar-brand img {
                                width: 80px;
                                /* Increased size */
                                height: 80px;
                                /* Increased size */
                                object-fit: contain;
                                transition: transform 0.3s ease;
                            }

                            .navbar-brand:hover img {
                                transform: scale(1.05);
                            }

                            /* Remove unnecessary spacing and divisions */
                            .navbar-header {
                                display: flex;
                                align-items: center;
                            }

                            @media (max-width: 768px) {
                                .navbar-brand img {
                                    width: 60px;
                                    height: 60px;
                                }
                            }

                            @media (max-width: 480px) {
                                .navbar-brand img {
                                    width: 50px;
                                    height: 50px;
                                }
                            }
                        </style>
                        <span class="logo-text">
                            <img src="{{ asset('assets/images/logo2.png') }}" alt="homepage" class="dark-logo" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item">
                            <span class="navbar-text">Welcome, {{ Auth::user()->name }}</span>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('assets/images/users/profile.png') }}" alt="user"
                                    class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i> My
                                    Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i>
                                    Inbox</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="ti-wallet me-1 ms-1"></i> Logout</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @include('layouts.admin.sidebar')

        <div class="page-wrapper">
            @yield('content')
            @include('layouts.admin.footer')
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-tooltip"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="path/to/chartist.js"></script>
    <script src="path/to/chartist-plugin-tooltip.js"></script>

</body>

</html>
