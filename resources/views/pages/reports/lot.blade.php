@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 bold">Lot Statement Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3 ">

            <div class="row">
                <div class="col-sm-auto ms-auto d-flex">
                    <div class="mx-3">
                        <h6>Total Lot</h6>
                        <span id="total_lot">0</span>
                    </div>

                    <div class="mx-3">
                        <h6>Complete lot</h6>
                        <span id="complete_lot">0</span>
                    </div>


                    <div class="mx-3">
                        <Button class="btn btn-outline-primary export">Export in Excel </Button>
                        <div></div>
                    </div>

                </div>

                <div class="col-sm-auto ms-auto d-flex form-group">
                    <div class="gap-2">
                        <select name="category" id="category" class="form-control">
                            <option> Select Category</option>
                        </select>
                    </div>
                    <div class="gap-2">
                        <select name="lot_status" id="lot_status" class="form-control">
                            <option selected disabled value="0"> Select Status</option>
                            <option value="1"> Created</option>
                            <option value="2"> Maked</option>
                            <option value="3"> Packed </option>
                            <option value="4">Shiped </option>
                            <option value="5"> Shippments</option>
                            <option value="6"> Refinery</option>
                            <option value="7"> Completed </option>
                        </select>
                    </div>

                    <div class="gap-2">
                        <select name="filter" id="filter" class="form-control">
                            <option value="all">All</option>
                            <option value="daily">Daily</option>
                            <option value="week"> Week</option>
                            <option value="month"> Month</option>
                            <option value="year"> Year</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="display table  table-hover table-nowrap align-middle mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Category</th>
                                    <th>Quantity </th>
                                    <th>Amount</th>
                                    <th>Net Weight</th>
                                    <!-- <th>No Of Packages</th> -->
                                    <th> Loss Quantity % </th>
                                    <th> Total Charges </th>
                                    <th> Sell </th>
                                    <th>Cash Flow</th>
                                    <th>Create date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

<Script>
    $(document).ready(function() {
        getCategories();

        $('#filter, #category').change(function() {
            getAll();
        });
        $('#lot_status').change(function() {
            getAll();
        });

        $('.export').on('click', function() {
            exportAll();
        });
    });


    function getAll() {
        var selectedFilter = $('#filter').val();
        var category = $('#category').val();
        var lot_status = $('#lot_status').val() ?? null;
        $.ajax({
            method: 'get',
            url: '{{ route("report.lotStatement") }}',
            data: {
                filter: selectedFilter,
                category: category,
                status: lot_status

            },
            success: function(response) {
                console.log(response);
                $('#total_lot').html(response.overall.total_lot);
                $('#complete_lot').html(response.overall.complete_lot);
                // $('#current').html(response.overall.current);
                $('#myTable').DataTable().destroy();
                $('#myTable').DataTable({
                    autoFill: true,
                    data: response.all,
                    columns: [{
                            data: 'sno'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'quantity'
                        },
                        {
                            data: 'amount'
                        },
                        {
                            data: 'net_weight'
                        },
                        // {
                        //     data: 'no_of_packages'
                        // },
                        {
                            data: 'loss'
                        },
                        {
                            data: 'total_charges'
                        },
                        {
                            data: 'sell'
                        },
                        {
                            data: 'cash_flow'
                        },
                        {
                            data: 'created_at'
                        },
                        {
                            data: 'status'
                        }
                    ]
                });
            }
        });
    };

    function getCategories() {
        $.ajax({
            url: '{{route("category.getall")}}',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var categoryDropdown = $('#category');
                categoryDropdown.empty();
                categoryDropdown.append('<option value="" selected  >Select Category</option>');
                $.each(data, function(index, category) {
                    categoryDropdown.append('<option value="' + category.id + '">' + category.name + '</option>');
                });
                getAll();
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });
    }



    function exportAll() {
        let url = '{{ route("report.lotStatement.export") }}';
        var link = document.createElement('a');
        link.href = url;
        link.download = 'lotStatement.xlsx';
        link.click();
    }
</Script>
@endsection