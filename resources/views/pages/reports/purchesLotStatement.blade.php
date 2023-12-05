@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 bold">Lot Purchase Statement Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3 ">
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="display table  table-hover table-nowrap align-middle mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Lot</th>
                                    <th>Supplier </th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Category</th>
                                    <th>Category</th>
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
       
    });


    function getAll() {
        var selectedFilter = $('#filter').val();
        var category = $('#category').val() ;



        var supplier = $('#supplier').val();

        $.ajax({
            method: 'get',
            url: '{{ route("report.purchaseLotStatement") }}',
          
            success: function(response) {
                console.log(response);
           
                $('#myTable').DataTable().destroy();
                $('#myTable').DataTable({
                    autoFill: true,
                    data: response,
                    columns: [
                        {
                            data: 'lot'
                        },
                        {
                            data: 'Supplier'
                        },{
                            data:'quantity',
                        },{
                            data:'amount',
                        },{
                            data:'create_at',
                        },{
                            data:'category'
                        }
                    ]
                });
            }
        });
    };





  
</Script>
@endsection