@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 h2">Investment</h4>
                        <button class="btn btn-primary addPayment-modal ms-2" data-bs-toggle="modal"
                    data-bs-target="#addInvestmentModal"><i class="las la-plus me-1"></i> Add Investment </button>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Investment</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

    <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myTable" class="display table  table-hover table-nowrap align-middle mb-0"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th> Name </th>
                                    <th> Mobile</th>
                                    <th> Email </th>
                                    <th> Amount </th>
                                    <th>Date</th>
                                    <th>Action</th>
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
</div>
<!-- New Supplier Modal -->
<div class="modal fade" id="addInvestmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel">Add Investment  </h5> <span class="success text-success m-2 bold "></span>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
    <form  id="InvesterCreate" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="row p-0">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotSupplierName" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierPhone" class="form-label"> Phone</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierEmail" class="form-label"> Email</label>
                            <input type="text" class="form-control" id="email" name="email" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotCompanyName" class="form-label">Amount</label> 
                            <input type="text" class="form-control" id="amount" name="amount" >
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Invest Date </label>
                            <input type="date" class="form-control" id="invest_date" name="invest_date">
                        </div>
                    </div>
                </div>
                <div class="hstack gap-2 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-success InvesterSubmitButton" > Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div><!--end modal-->

<div class="modal fade" id="viewInvestmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel"> Supplier Info </h5> <span class="success text-success m-2 bold "></span>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
    <form  id="InvesterView" enctype="multipart/form-data">
        @csrf
         <input type="hidden" name="invester_id" id="invester_id" required>
        <div class="row">
            <div class="col-lg-12">
                <div class="row p-0">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotSupplierName" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="Name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierPhone" class="form-label"> Phone</label>
                            <input type="text" class="form-control" id="Phone" name="mobile" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierEmail" class="form-label"> Email</label>
                            <input type="text" class="form-control" id="Email" name="email" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotCompanyName" class="form-label">Amount</label> 
                            <input type="text" class="form-control" id="Amount" name="amount" >
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Invested Date</label>
                            <input type="date" class="form-control" id="Invest_date" name="invest_date">
                        </div>
                       
                      
                      
                    </div>
                </div>
                <div class="hstack gap-2 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-success InvesterSubmitButton" > Update </button>
                </div>
            </div>
        </div>
    </form>
</div>

        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div><!--end modal-->


<script>
$(document).ready(function () {
    // Load initial data
    var url = "{{ route('investment.create') }}";
    $.ajax({
        method: "GET",
        url: url,
        success: function (response) {
            // console.log(response);
            initializeDataTable(response);
        }
    });

    $('#InvesterCreate , #InvesterView').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: '{{ route("investment.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('.InvesterSubmitButton').html('<i class="fas fa-spinner"></i> Please wait ...');
            },
            success: function (response) {
                form.reset(); 
                $('.InvesterSubmitButton').html('Submit');
                $('#addInvestmentModal').modal('hide');
                $('#viewInvestmentModal').modal('hide');

                // Reload DataTable with updated data
                reloadDataTable();
            },
            error: function (error) {
                console.error(error);
                $('.InvesterSubmitButton').html('Submit');
            }
        });
    });

    function initializeDataTable(data) {
        $('#myTable').DataTable({
            autoFill: true,
            data: data,
            columns: [
                { data: 'sno' },
                { data: 'name' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'amount' },
                { data: 'invest_date' },
                { data: 'options' }
            ]
        });
    }

    function reloadDataTable() {
        var url = "{{ route('investment.create') }}";
        $.ajax({
            method: "GET",
            url: url,
            success: function (response) {
                console.log(response);
                var dataTable = $('#myTable').DataTable();
                dataTable.clear();
                dataTable.rows.add(response);
                dataTable.draw();
            }
        });
    }


    $(document).on('click', '.InvesterView', function() {
        var investerData = $(this).data('invester');
        console.log(investerData);
        $('#invester_id').val(investerData.id);
        $('#Name').val(investerData.name);
        $('#Phone').val(investerData.mobile);
        $('#Email').val(investerData.email);
        $('#Amount').val(investerData.amount);
        $('#Invest_date').val(investerData.invest_date);
        $('#viewInvestmentModal').modal('show');
        // console.log(supplierData);
    });


    $(document).on('click', '.investerDelete', function() {
    var confirmation = confirm('Are you sure you want to delete this Investor?');
    if (confirmation) {
        var investerId = $(this).data('invester');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
       
        $.ajax({
            method: 'DELETE',
            url: '{{ route("investment.destroy", ["investment" => "__investerId__"]) }}'.replace('__investerId__', investerId),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                console.log(response);
                reloadDataTable();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                reloadDataTable();
            }
        });
    } else {
        console.log('Delete canceled');
    }
});



// $(document).on('click', '.suppplierStatus', function() {
//     var supplierId = $(this).data('supplier');
//     var csrfToken = $('meta[name="csrf-token"]').attr('content');

//     $.ajax({
//             method: 'GET',
//             url: '{{ route("supplier.show", ["supplier" => "__supplierId__"]) }}'.replace('__supplierId__', supplierId),
//             headers: {
//                 'X-CSRF-TOKEN': csrfToken
//             },
//             success: function(response) {
            
//                 reloadDataTable();
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//                 reloadDataTable();
//             }
//         });

// });

});

</script>


@endsection