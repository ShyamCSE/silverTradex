@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Charges Statement Report</h4>



                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3 ">

            <div class="row">
                <div class="col-sm-auto ms-auto d-flex">
                    <div class="mx-3">
                        <h4>Total Credit</h4>
                        <span id="credit">0</span>
                    </div>

                    <div class="mx-3">
                        <h4>Total Debit</h4>
                        <span id="debit">0</span>
                    </div>

                    <div class="mx-3">
                        <h4>Current</h4>
                        <span id="current">0</span>
                    </div>
                    <div class="mx-3">
                        <Button class="btn btn-outline-primary export">Export in Excel </Button>
                        <div></div>
                    </div>

                </div>

                <div class="col-sm-auto ms-auto">

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
                                    <th>Lot Name </th>
                                    <th>Quantity </th>
                                    <th>Buying Charges</th>
                                    <th>Making Charges</th>
                                    <th>Courier Charges</th>
                                    <th>Packaging Additional Charges</th>
                                    <th>Shipping Charges</th>
                                    <th>Insurance Charges</th>
                                    <th>Additional Charges</th>
                                    <th>Clearance Charges</th>
                                    <th>Shipment Additional Charges</th>
                                    <th>Refinary Charges</th>
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
        getAll();

        $('#filter').change(function() {
            getAll();
        });

        $('.export').on('click', function() {
           exportAll();
       });
    });

    function getAll() {
        var selectedFilter = $('#filter').val();

        $.ajax({
            method: 'get',
            url: '{{ route("report.chargesstatement") }}',
            data: {
                filter: selectedFilter
            },
            success: function(response) {
                console.log(response);
               
                $('#myTable').DataTable().destroy();
                $('#myTable').DataTable({
                    autoFill: true,
                    data: response.data,
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name'},
                        {data: 'quantity'},
                        {data: 'buying_charges'},
                        {data: 'making_charges'},
                        {data: 'courier_charges'},
                        {data: 'packaging_additional_charges'},
                        {data: 'shipping_charges'},
                        {data: 'insurance_charges'},
                        {data: 'additional_charges'},
                        {data: 'clearance_charges'},
                        {data: 'shippment_additional_charges'},
                        {data: 'refinary_charges'},
                    ]
                });
            }
        });
    };
    
    function exportAll() {
        let url = '{{ route("report.balanceStatement.export") }}?';
        var link = document.createElement('a');
        link.href = url;
        link.download = 'balanceStatement.xlsx';
        link.click();
        
        }

</Script>
@endsection