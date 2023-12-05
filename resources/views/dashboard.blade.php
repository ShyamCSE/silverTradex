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
                            <h4 class="card-title mb-0 flex-grow-1">Overview</h4>
                            <!-- <div class="flex-shrink-0">
                                <div class="card-header-dropdown">
                                   <select name="orverviewFilter" id="orverviewFilter" class="form-control">
                                    <option value="daily">Daily</option>
                                    <option value="week">Week</option>
                                    <option value="month" selected>Month</option>
                                    <option value="year">Year</option>
                                     <option value="all">All</option>
                                   </select>
                                </div>
                            </div> -->
                        </div><!-- end card header -->

                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="col-lg-3 mini-widget pb-3 pb-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="counter_value">54</span><span class="ms-1">kg</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Total In Stock</h5>
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
                                            <h2 class="mb-0 fs-24"><span class="balanceAmount"
                                                    >0</span>
                                            </h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Balance Amount</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart2" data-colors='["--in-primary"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 mini-widget pt-3 pt-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="lot"
                                                    >1</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Dispatched Lot</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart3" data-colors='["--in-primary"]'
                                                class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 mini-widget pt-3 pt-lg-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h2 class="mb-0 fs-24"><span class="net_profit"
                                                    >1</span><span class="ms-1">USD</span></h2>
                                            <h5 class="text-muted fs-16 mt-2 mb-0">Net Profit</h5>
                                        </div>
                                        <div class="flex-shrink-0 text-end dash-widget">
                                            <div id="mini-chart4" data-colors='["--in-primary",'
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
                            <!-- <div>
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
                            </div> -->
                        </div>
                        <div class="card-body py-1">
                            <div class="row gy-2">
                                <div class="col-md-4">
                                    <h4 class="fs-22 mb-0 payment_activity_current" > </h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex main-chart justify-content-end">
                                        <div class="px-4 border-end">
                                            <h4 class="text-primary fs-22 mb-0"> <span class=" payment_activity_credit "></span> <span
                                                    class="text-muted d-inline-block fs-17 align-middle ms-0 ms-sm-2">Investment</span>
                                            </h4>
                                        </div>
                                        <div class="ps-4">
                                            <h4 class="text-primary fs-22 mb-0 "> <span class="payment_activity_debit"></span> <span
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
                       
                    <!-- <div class="card">
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
                            <div id="payment_overview_data" data-colors='["--in-primary"]'
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
                    </div> -->
                
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
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Making Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 making_charges"></span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Courier Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 courier_charges"></span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between  border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Packaging Additional Charge </p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 packaging_additional_charges ">$5,568</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Shiping Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 shipping_charges ">$7,261</span>
                                    </div>
                                </div>
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Insurance Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 insurance_charges ">$5,142</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Additinal Charge</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 additional_charges ">$5,142</span>
                                    </div>
                                </div>

                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Clearance Charges</p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 clearance_charges ">$5,142</span>
                                    </div>
                                </div>

                                
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Shippment Additional Charge </p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 shippment_additional_charges ">$5,142</span>
                                    </div>
                                </div>

                                
                                <div class="structure-list d-flex justify-content-between border-bottom">
                                    <p class="mb-0"><i
                                            class="las la-dot-circle fs-18 text-primary me-2"></i>Refinary Charges </p>
                                    <div>
                                        <span class="pe-2 pe-sm-5 refinary_charges ">$5,142</span>
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

    
<script>
    $(document).ready( function(){
        overView();
    });

    function overView() {
    $.ajax({
        method: 'get',
        url: '{{ route("dashboard") }}',
        success: function (response) {
            // Extract data from the response
            var categories = response.stock.map(function (item) {
                return item.name;
            });

            var quantities = response.stock.map(function (item) {
                return item.quantity;
            });
            var sum_stock = response.stock.map(function (item) {
                return +item.quantity;
            }).reduce(function (accumulator, currentValue) {
                return accumulator + currentValue;
            }, 0);
           
           $('.counter_value').html(sum_stock);
           
            var vectorMapWorldLineColors = getChartColorsArray("mini-chart1");

        
            var options = {
                series: quantities,
                chart: {
                    type: "donut",
                    height: 110
                },
                colors: vectorMapWorldLineColors,
                labels: categories,
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                }
            };

      
            var chart = new ApexCharts(document.querySelector("#mini-chart1"), options);
            chart.render();

            $('.balanceAmount').html(response.balanceAmount);

var vectorMapWorldLineColors = getChartColorsArray("mini-chart2");

var options = {
    series: [response.balanceAmount], 
    chart: {
        type: "donut",
        height: 110
    },
    colors: vectorMapWorldLineColors,
    labels:['USD'],
    legend: {
        show: false
    },
    dataLabels: {
        enabled: false
    }
};

var chart = new ApexCharts(document.querySelector("#mini-chart2"), options);
chart.render();

 $('.lot').html(response.lot);


 var vectorMapWorldLineColors = getChartColorsArray("mini-chart3");

var options = {
    series: [response.lot], 
    chart: {
        type: "donut",
        height: 110
    },
    colors: vectorMapWorldLineColors,
    labels:['Dispatched LOT'], 
    legend: {
        show: false
    },
    dataLabels: {
        enabled: false
    }
};

// Render ApexCharts
var chart = new ApexCharts(document.querySelector("#mini-chart3"), options);
chart.render();

$('.net_profit').html(response.net_profit);
var vectorMapWorldLineColors = getChartColorsArray("mini-chart4");

// Set up ApexCharts options
var options = {
    series: [response.net_profit],
    chart: {
        type: "donut",
        height: 110
    },
    colors: vectorMapWorldLineColors,
    labels:['Profit'],
    legend: {
        show: false
    },
    dataLabels: {
        enabled: false
    }
};

// Render ApexCharts
var chart = new ApexCharts(document.querySelector("#mini-chart4"), options);
chart.render();

 $('.payment_activity_current').html(response.payment_activity.current);
 $('.payment_activity_credit').html(response.payment_activity.credit);
 $('.payment_activity_debit').html(response.payment_activity.debit);

 $('.making_charges').html('$' +  + response.expense[0].making_charges);
 $('.courier_charges').html('$' +  + response.expense[0].courier_charges);

  $('.packaging_additional_charges').html('$' +  + response.expense[0].packaging_additional_charges);
  $('.shipping_charges').html('$' +  + response.expense[0].shipping_charges);
  $('.insurance_charges').html('$' +  + response.expense[0].insurance_charges);
  $('.additional_charges').html('$' +  + response.expense[0].additional_charges);
  $('.clearance_charges').html('$' +  + response.expense[0].clearance_charges);
  $('.shippment_additional_charges').html('$' +  + response.expense[0].shippment_additional_charges);
  $('.refinary_charges').html('$' +  + response.expense[0].refinary_charges);


const months = Object.keys(response.expense);
const creditData = months.map((month) => response.expense[month].credit);
const debitData = months.map((month) => response.expense[month].debit);

const barchartColors = getChartColorsArray("payment_overview_data");

const options1 = {
    chart: {
        type: "area",
        height: 341,
        toolbar: {
            show: !1,
        },
    },
    series: [
        {
            name: "Credit",
            data: creditData,
        },
        {
            name: "Debit",
            data: debitData,
        },
    ],
    stroke: {
        curve: "smooth",
        width: ["3.5", "3.5"],
    },
    grid: {
        xaxis: {
            lines: {
                show: !0,
            },
        },
        yaxis: {
            lines: {
                show: !0,
            },
        },
    },
    colors: barchartColors,
    xaxis: {
        categories: months,
    },
    legend: {
        show: !0,
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: 0.4,
            opacityTo: 0.1,
            stops: [30, 100, 100, 100],
        },
    },
    dataLabels: {
        enabled: !1,
    },
    tooltip: {
        fixed: {
            enabled: !1,
        },
        x: {
            show: !1,
        },
        y: {
            title: {
                formatter: function (e) {
                    return "";
                },
            },
        },
        marker: {
            show: !1,
        },
    },
};

// Render the chart
new ApexCharts(document.querySelector("#payment_overview_data"), options1).render();


        }
    });
}


</script>

@endsection