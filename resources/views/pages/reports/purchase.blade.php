@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 bold">Purchase Statement Report</h4>



                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3 ">

            <div class="row">
                <div class="col-sm-auto ms-auto d-flex">
                    <div class="mx-3">
                        <h6>Total Credit</h6>
                        <span id="credit">0</span>
                    </div>

                    <div class="mx-3">
                        <h6>Total Debit</h6>
                        <span id="debit">0</span>
                    </div>

                    <div class="mx-3">
                        <h6>Current</h6>
                        <span id="current">0</span>
                    </div>
                    <div class="mx-3">
                        <Button class="btn btn-outline-primary export">Export in Excel </Button>
                        <div></div>
                    </div>

                </div>

                <div class="col-sm-auto ms-auto d-flex">
                    <div class="gap-3">
                        <select name="category" id="category" class="form-control">
                            <option> Select Category</option>
                        </select>
                    </div>
                    <div class="gap-3">
                        <select name="supplier" id="supplier" class="form-control">
                            <option> Select Supplier</option>
                        </select>
                    </div>
                    <div class="gap-3">
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
                                    <th>Supplier </th>
                                    <th>Quantity</th>
                                    <th>Current Quantity</th>
                                    <th>Rate</th>
                                    <th>Total price</th>
                                    <th>Purchese date</th>
                                    <th>Create date</th>
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
        getSuppliers();
        $('#filter, #category, #supplier').change(function() {
            getAll();
        });

        $('.export').on('click', function() {
            exportAll();
        });
    });


    function getAll() {
        var selectedFilter = $('#filter').val();
        var category = $('#category').val() ;



        var supplier = $('#supplier').val();

        $.ajax({
            method: 'get',
            url: '{{ route("report.purchaseStatement") }}',
            data: {
                filter: selectedFilter,
                category: category,
                supplier: supplier,
            },
            success: function(response) {
                console.log(response);
                $('#credit').html(response.overall.credit);
                $('#debit').html(response.overall.debit);
                $('#current').html(response.overall.current);
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
                            data: 'supplier'
                        },
                        {
                            data: 'quantity'
                        },
                        {
                            data: 'current_quantity'
                        },
                        {
                            data: 'rate'
                        },
                        {
                            data: 'total_price'
                        },
                        {
                            data: 'date'
                        },
                        {
                            data: 'created_at'
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
              
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });
    }

    function getSuppliers() {
        $.ajax({
            url: '{{ route("supplier.create") }}',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var supplierDropdown = $('#supplier');
                supplierDropdown.empty();
                supplierDropdown.append('<option value="" selected  >Select Supplier</option>');
                $.each(data, function(index, supplier) {
                    supplierDropdown.append('<option value="' + supplier.id + '">' + supplier.name + '</option>');
                });
                getAll();
            },
            error: function(error) {
                console.error('Error fetching suppliers:', error);
            }
        });
    }

    function exportAll() {
        let url = '{{ route("report.purchaseStatement.export") }}';
        var link = document.createElement('a');
        link.href = url;
        link.download = 'purchaseStatement.xlsx';
        link.click();
    }
</Script>
@endsection