@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 h2">Supplier</h4>
                        <button class="btn btn-primary addPayment-modal ms-2" data-bs-toggle="modal"
                    data-bs-target="#addSupplierModal"><i class="las la-plus me-1"></i> Add Suppier </button>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Supplier</li>
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
                                    <th>Company Name</th>
                                    <th> Status </th>
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
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel">Add Supplier </h5> <span class="success text-success m-2 bold "></span>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
    <form  id="supplierCreate" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="row p-0">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotSupplierName" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="lotSupplierName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierPhone" class="form-label"> Phone</label>
                            <input type="text" class="form-control" id="lotSupplierPhone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierEmail" class="form-label"> Email</label>
                            <input type="text" class="form-control" id="lotSupplierEmail" name="email" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotCompanyName" class="form-label">Company Name</label> 
                            <input type="text" class="form-control" id="lotCompanyName" name="company_name" >
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Address</label>
                            <input type="text" class="form-control" id="lotSupplierAddress" name="supplier_address">
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Display Order </label>
                            <input type="number" class="form-control" id="lotSupplierAddress" name="order">
                        </div>
                      
                      
                    </div>
                </div>
                <div class="hstack gap-2 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-success" id="addNewSuppier"> Submit</button>
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

<div class="modal fade" id="viewSupplierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel"> Supplier Info </h5> <span class="success text-success m-2 bold "></span>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
    <form  id="supplierView" enctype="multipart/form-data">
        @csrf
         <input type="hidden" name="supplier_id" id="supplier_id" required>
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
                            <input type="text" class="form-control" id="Phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierEmail" class="form-label"> Email</label>
                            <input type="text" class="form-control" id="Email" name="email" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="lotCompanyName" class="form-label">Company Name</label> 
                            <input type="text" class="form-control" id="company_name" name="company_name" >
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Address</label>
                            <input type="text" class="form-control" id="supplier_address" name="supplier_address">
                        </div>
                        <div class="mb-3">
                            <label for="lotSupplierAddress" class="form-label"> Display Order </label>
                            <input type="number" class="form-control" id="order" name="order">
                        </div>
                      
                      
                    </div>
                </div>
                <div class="hstack gap-2 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-success" id="addNewSuppier"> Update </button>
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
    var url = "{{ route('supplier.create') }}";
    $.ajax({
        method: "GET",
        url: url,
        success: function (response) {
            // console.log(response);
            initializeDataTable(response);
        }
    });

    $('#supplierCreate , #supplierView').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: '{{ route("supplier.store") }}',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#addNewSuppier').html('<i class="fas fa-spinner"></i> Please wait ...');
            },
            success: function (response) {
                form.reset(); 
                $('#addNewSuppier').html('Submit');
                $('#addSupplierModal').modal('hide');
                $('#viewSupplierModal').modal('hide');

                // Reload DataTable with updated data
                reloadDataTable();
            },
            error: function (error) {
                console.error(error);
                $('#addNewSuppier').html('Submit');
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
                { data: 'company_name' },
                { data: 'status' },
                { data: 'options' }
            ]
        });
    }

    function reloadDataTable() {
        var url = "{{ route('supplier.create') }}";
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


    $(document).on('click', '.supplierView', function() {
        var supplierData = $(this).data('supplier');
        $('#supplier_id').val(supplierData.id);
        $('#Name').val(supplierData.name);
        $('#Phone').val(supplierData.phone);
        $('#Email').val(supplierData.email);
        $('#company_name').val(supplierData.componey_name);
        $('#supplier_address').val(supplierData.address);
        $('#order').val(supplierData.order);
        $('#viewSupplierModal').modal('show');
        // console.log(supplierData);
    });


    $(document).on('click', '.supplierDelete', function() {
    var confirmation = confirm('Are you sure you want to delete this supplier?');
    if (confirmation) {
        var supplierId = $(this).data('supplier');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
       
        $.ajax({
            method: 'DELETE',
            url: '{{ route("supplier.destroy", ["supplier" => "__supplierId__"]) }}'.replace('__supplierId__', supplierId),
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

$(document).on('click', '.suppplierStatus', function() {
    var supplierId = $(this).data('supplier');
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
            method: 'GET',
            url: '{{ route("supplier.show", ["supplier" => "__supplierId__"]) }}'.replace('__supplierId__', supplierId),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
            
                reloadDataTable();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                reloadDataTable();
            }
        });

});

});

</script>


@endsection