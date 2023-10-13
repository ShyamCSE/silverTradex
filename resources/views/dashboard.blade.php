@extends('layouts.app')
@section('container')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-mini">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">This Month's Overview</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-14">Sort by: </span><span
                                            class="text-muted">Current Month<i
                                                class="las la-angle-down fs-12 ms-2"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">This Month</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Last 6 Months</a>
                                        <a class="dropdown-item" href="#">Current Year</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="counter-value"
                                                    data-target="256">54</span><span class="ms-1">kg</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Silver In Stock</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart1" data-colors='["--in-primary", "--in-light"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 mini-widget py-3 py-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="counter-value"
                                                    data-target="3864">124</span><span class="ms-1">USD</span>
                                            </h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Balance Amount</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart2" data-colors='["--in-primary", "--in-light"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 mini-widget pt-3 pt-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="counter-value"
                                                    data-target="12">1</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Dispatched Lot</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart3" data-colors='["--in-primary", "--in-light"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 mini-widget pt-3 pt-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="counter-value"
                                                    data-target="142">1</span><span class="ms-1">USD</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Net Profit</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart4" data-colors='["--in-primary", "--in-light"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Payment Activity</h4>
                            <div>
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    6M
                                </button>
                                <button type="button" class="btn btn-info btn-sm">
                                    1Y
                                </button>
                            </div>
                        </div>
                        <div class="card-body py-1">
                            <div class="row gy-2">
                                <div class="col-md-4">
                                    <h4 class="fs-22 mb-0">$23,590.00</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex main-chart justify-content-end">
                                        <div class="px-4 border-end">
                                            <h4 class="text-primary fs-22 mb-0">$584k <span
                                                    class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">Incomes</span>
                                            </h4>
                                        </div>
                                        <div class="ps-4">
                                            <h4 class="text-primary fs-22 mb-0">$324k <span
                                                    class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">Expenses</span>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="stacked-column-chart" class="apex-charts"
                                data-colors='["--in-primary", "--in-light"]' dir="ltr"></div>
                        </div>
                    </div>
                       
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-2">
                            <h4 class="card-title mb-0 flex-grow-1">Payment Overview</h4>
                            <div>
                                <div class="dropdown">
                                    <a class="text-reset" href="#" id="dropdownMenuYear"
                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-14">Sort By: </span>
                                        <span class="text-muted">Yearly<i
                                                class="las la-angle-down fs-12 ms-2"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="dropdownMenuYear">
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Yearly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="payment-overview" data-colors='["--in-primary", "--in-light"]'
                                class="apex-charts" dir="ltr"></div>
                            <div class="row mt-3 text-center">
                                <div class="col-6 border-end">
                                    <div class="my-1">
                                        <p class="text-muted text-truncate mb-2">Amount Received From Investor</p>
                                        <h4 class="mt-2 mb-0 fs-20">$10,070.00</h4>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="my-1">
                                        <p class="text-muted text-truncate mb-2">Current Amount</p>
                                        <h4 class="mt-2 mb-0 fs-20">$3,864.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="card-title mb-2 text-truncate">Expense Structure</h5>
                                </div>
                                <div class="flex-shrink-0 ms-2">
                                    <div class="dropdown">
                                        <a class="text-reset" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold text-uppercase fs-14">Sort By:</span> <span
                                                class="text-muted">Monthly<i
                                                    class="las la-angle-down fs-12 ms-2"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="structure-widget"
                                data-colors='["--in-primary", "--in-primary-rgb, 0.7", "--in-light"]'
                                class="apex-charts" dir="ltr"></div>


                            <div class="px-2">
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Silver Buying</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$56,236</span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Refinery Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$12,596</span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between  border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Shipping/ Courier</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,568</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Insurance Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$7,261</span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Clearance Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Refinery Loss</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Commission Agent</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>

                                
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Add Mistake Charge</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>

                                
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Add Insurance+Shipping</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>
                                
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Other Custom Charge</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$5,142</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between pb-0">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Other Additional</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5">$23,568</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- end row -->
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    


@endsection