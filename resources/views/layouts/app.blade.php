<!doctype html>
<html >
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Silver Tradex</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Silver Tradex" name="description" />
    <meta content="Aspire Innovations" name="author" />
    <link rel="shortcut icon" href="{{asset('build/assets/images/favicon.ico')}}">
    {{-- <link href="{{asset('build/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('build/assets/js/layout.js')}}"></script> --}}
    <link href="{{asset('build/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('build/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('build/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('build/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{asset('build/assets/js/custom1.js')}}" type="text/javascript" ></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  {{-- data table css  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body>
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <!-- <div class="navbar-brand-box horizontal-logo">
                            <a href="{{route('dashboard')}}" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{asset('build/assets/images/logo-dark.png')}}" alt="" height="32">
                                </span>
                            </a>
                        </div> -->

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                  

                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown ms-1 topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="{{asset('build/assets/images/flags/us.svg')}}" title="USD" alt="Header Language"
                                    height="20" class="rounded">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language py-2"
                                    data-lang="en" title="USD">
                                    <img src="{{asset('build/assets/images/flags/us.svg')}}" title="USD" alt="user-image" class="me-2 rounded"
                                        height="18">
                                    <span class="align-middle">USD</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp"
                                    title="IDR">
                                    <img src="{{asset('build/assets/images/flags/indo.svg')}}" title="IDR" alt="user-image" class="me-2 rounded"
                                        height="18">
                                    <span class="align-middle">IDR</span>
                                </a>

                            </div>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-primary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='las la-expand fs-24'></i>
                            </button>
                        </div>

                        <div class="dropdown header-item">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ Auth::user()->profile_photo_path ?? asset('files/profile.jpg') }}"
                                        alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block fw-medium user-name-text fs-16">{{ Auth::user()->name }}
                                            <i class="las la-angle-down fs-12 ms-1"></i></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('profile.show')}}"><i class="bx bx-user fs-15 align-middle me-1"></i>
                                    <span key="t-profile">Profile</span></a>
                           
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                <button class="dropdown-item text-danger" type="submit"><i
                                        class="bx bx-power-off fs-15 align-middle me-1 text-danger"></i> <span
                                        key="t-logout">Logout</span></button>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('build/assets/images/logo-sm.png')}}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('build/assets/images/logo-dark.png')}}" alt="" height="35">
                    </span>
                </a>
                <!-- Light Logo-->
                <!-- <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('build/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('build/assets/images/logo-light.png')}}" alt="" height="21">
                    </span>
                </a> -->
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link " href="{{route('dashboard')}}">
                                <i class="las la-house-damage"></i> <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('investment.index')}}">
                                <i class="las la-wallet"></i> <span data-key="t-Investment">Invested By</span>
                            </a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('category')}}">
                                <i  class="las la-layer-group"></i> <span data-key="t-Category">Category</span>
                            </a>
                        </li>     
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('supplier.index')}}">
                                <i  class="las la-users"></i> <span data-key="t-Supplier">Supplier</span>
                            </a>
                        </li>                       


                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('purchasing.index')}}" role="button" aria-controls="sidebarInvoice">
                                <i class="las la-file-invoice"></i> <span data-key="t-invoices">Purchase</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('lot')}}">
                                <i class="las la-shipping-fast"></i> <span data-key="t-payments">Dispatch Lot</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('report')}}">
                                <i class="las la-paste"></i> <span data-key="t-payments">Report</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarReport" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarReport">
                                <i class="las la-paste"></i> <span data-key="t-report">Report</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarReport">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="balance-statement.html" class="nav-link" data-key="t-payment-summary">Balance Statment </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="finance-statement.html" class="nav-link" data-key="t-payment-summary">Finance Statment </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="trading-account-statement.html" class="nav-link" data-key="t-sale-report">Lot Account
                                            Statment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="international-pricing.html" class="nav-link" data-key="t-expenses-report"> International Pricing
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="expense-in-percentage.html" class="nav-link" data-key="t-expenses-report"> Expense In Percentage
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="profit-statement.html" class="nav-link" data-key="t-expenses-report"> Profit </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <div class="help-box text-center">
                            <img src="{{asset('build/assets/images/create-invoice.png')}}" class="img-fluid" alt="">
                            <div class="mt-3">
                                <a href="profit-change.html" class="btn btn-primary">Change Profit Percentage</a>
                            </div>
                        </div>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
          @yield('container')
        </div>
        <footer class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Silver Tradex.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Duco Consultancy Private Limited
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->
  @yield('models')
 
    <!-- JAVASCRIPT -->
    <script src="{{asset('build/assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('build/assets/js/apexchart.js')}}"></script>
    <script src="{{asset('build/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('build/assets/js/app.js')}}"></script>
    <script src="{{asset('build/assets/js/custom.js')}}" ></script>


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    

</body>


</html>