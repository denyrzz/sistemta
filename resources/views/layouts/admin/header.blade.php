<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin6">
            <!-- Logo -->
            <a class="navbar-brand" href="index.html">
                <b class="logo-icon">
                    <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                    <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                    <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                </span>
            </a>
            <!-- Toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- toggle and nav items -->
            <ul class="navbar-nav float-start me-auto">
                <!-- Search -->
                <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-magnify font-20 me-1"></i>
                            <div class="ms-1 d-none d-sm-block">
                                <span>Search</span>
                            </div>
                        </div>
                    </a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter">
                        <a class="srh-btn">
                            <i class="ti-close"></i>
                        </a>
                    </form>
                </li>
            </ul>
            <!-- Right side toggle and nav items -->
            <ul class="navbar-nav float-end">
                <!-- User profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/users/profile.png" alt="user" class="rounded-circle" width="31">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i> My Profile</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet me-1 ms-1"></i> My Balance</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email me-1 ms-1"></i> Inbox</a>
                    </ul>
                </li>
                <!-- User profile and search -->
            </ul>
        </div>
    </nav>
</header>