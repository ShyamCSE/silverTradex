@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Balance Statement Report</h4>



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
                                    <th>Transection Date</th>
                                    <th>Credit </th>
                                    <th>Debit</th>

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
            url: '{{ route("report.balanceStatement") }}',
            data: {
                filter: selectedFilter
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
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            data: 'transaction_date'
                        },
                        {
                            data: 'credit'
                        },
                        {
                            data: 'debit'
                        },
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