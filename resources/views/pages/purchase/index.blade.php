@extends('layouts.app')
@section('container')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Purchase</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3">
            <div class="col-sm-4">
                <button class="btn btn-primary addPayment-modal" data-bs-toggle="modal"
                    data-bs-target="#addpaymentModal"><i class="las la-plus me-1"></i> Add Purchase</button>
                    <button class="btn btn-primary addPayment-modal ms-2" data-bs-toggle="modal"
                    data-bs-target="#addlotModal"><i class="las la-plus me-1"></i> Add Lot</button>
            </div>

            <div class="col-sm-auto ms-auto">
                <div class="d-flex gap-3">
                    <select name="filter" id="filter" class="form-control">
                        <option  >All</option>
                        <option value="week">Last Week</option>
                        <option value="month">Last Month</option>
                        <option value="year">Last Year</option>
                      

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
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Current Quantity</th>
                                    <th>Rate</th>
                                    <th>Date</th>
                                    <th>Photo</th>
                                    <th>Receipt</th>
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
    <!-- container-fluid -->
</div>   


<div class="modal fade" id="addpaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel">Add Purchase</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <span class="error text-danger"></span>
                <span class="success text-primary text-bold m-2"></span>
                <form method="Post" id="purchasingStore" action="{{route('purchasing.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row p-0">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Purchase Category</label>
                                        <select class="form-control"  name="category" id="category" >
                                            <option  selected disabled >Select</option>
                                            @foreach ($category as $item)
                                            <option value="{{$item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Supplier Name</label>
                                        <select class="form-control" name="supplier" id="supplier" >
                                            <option  selected disabled >Select</option>
                                            @foreach ($supplier as $item)
                                            <option value="{{$item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Phone </label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label  d-flex align-items-center">Quantity (Kg) <span class="text-success bg-primary" id="remain_quantity"></span> </label>
                                        <input type="number" step="0.01" class="form-control" name="quantity" id="quantity" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Rate </label>
                                        <input type="number" step="0.01" class="form-control" name="rate" id="rate" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="paymentdetails" class="form-label d-flex align-items-center">Amount </label>
                                        <input type="text" readonly class="form-control" name="amount" id="amount" />
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="paymentdetails" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" />
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Photo</label>
                                        <input type="file" class="form-control"  placeholder="" name="photo" id="photo">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Receipt</label>
                                        <input type="file" class="form-control" id="receipt" placeholder="" name="receipt">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hstack gap-2 mt-3 justify-content-end">
                                <button type="submit" class="btn btn-success" id="addNewMember">  <span class="icon"></span>  Submit</button>
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

<div class="modal fade" id="addlotModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel">Add Lot</h5> <span class="success text-success m-2 bold "></span>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{route('lot.create')}}" id="lotCreate" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row p-0">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Item Category</label>
                                        <select class="form-control" onchange="getQuantity(this.value);"
                                              name="lotCategory" id="lotCategory" >
                                            <option  selected disabled >Select</option>
                                            @foreach ($category as $item)
                                            <option value="{{$item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label  d-flex align-items-center">Quantity (Kg) <span class="ms-3  text-primary quantity-avalable" ></span> </label>
                                        <input type="number" class="form-control" name="lotQuantity" id="lotQuantity" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                              
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="paymentdetails" class="form-label d-flex align-items-center">Average Rate in $</label>
                                        <input type="text" value="" readonly class="form-control" name="lotAmount" id="lotAmount" />
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Photo</label>
                                        <input type="file" class="form-control" id="lotPhoto" name="lotPhoto" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hstack gap-2 mt-3 justify-content-end">
                                <button type="submit" class="btn btn-success" id="addNewLot"><i class="icon"></i> Submit</button>
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


<div class="modal fade" id="viewPurchaseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header px-4 py-3  border-bottom">
                <h5 class="modal-title" id="createMemberLabel">View Purchase</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <span class="error text-danger"></span>
                <span class="success text-primary text-bold m-2"></span>
                <form method="Post" id="purchasingUpdate" action="{{route('purchasing.store')}}" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="perchasing_id"  id="perchasing_id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row p-0">
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Purchase Category</label>
                                        <select class="form-control"  name="category" id="Category" >
                                            <option  selected disabled >Select</option>
                                            @foreach ($category as $item)
                                            <option value="{{$item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                           
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Supplier Name</label>
                                        <select class="form-control" name="supplier" id="Supplier" >
                                            <option  selected disabled >Select</option>
                                            @foreach ($supplier as $item)
                                            <option value="{{$item->id }}"> {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Phone </label>
                                        <input type="text" class="form-control" id="Phone" name="phone" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label  d-flex align-items-center">Quantity (Kg) <span class="text-success bg-primary" id="remain_quantity"></span> </label>
                                        <input type="number" step="0.01" class="form-control" name="quantity" id="Quantity" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Rate </label>
                                        <input type="number" step="0.01" class="form-control" name="rate" id="Rate" placeholder="">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="paymentdetails" class="form-label d-flex align-items-center">Amount </label>
                                        <input type="text" readonly class="form-control" name="amount" id="Amount" />
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="paymentdetails" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" id="Date" />
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Photo</label>
                                        <input type="file" class="form-control"  placeholder="" name="photo" id="Photo">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-12">
                                    <div class="mb-3">
                                        <label for="Name" class="form-label">Receipt</label>
                                        <input type="file" class="form-control" id="Receipt" placeholder="" name="receipt">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="hstack gap-2 mt-3 justify-content-end">
                                <button type="submit" class="btn btn-success" id="addNewMember">  <span class="icon"></span>  Submit</button>
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
   getall();



function disableButton() {
  $('#addNewMember').prop('disabled', true);
  $('.icon').addClass('las la-sync').html('please wait...');
}

// Function to enable the button and stop rotation
function enableButton() {
  $('#addNewMember').prop('disabled', false);
  $('.icon').removeClass('las la-sync').html('');
}


    $(document).ready(function () {
        $('#purchasingStore , #purchasingUpdate').on('submit', function (e) {
            e.preventDefault();
            disableButton();
            $('.text-danger').html('');
            var formData = new FormData(this);
           var form = this;
            $.ajax({
                url: $(this).attr('action'), 
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                            enableButton();
                            if (response.status === 200) {
                                form.reset();
                                $('#viewPurchaseModal').modal('hide');
                                $('#addpaymentModal').modal('hide');
                                $('#myTable').DataTable().destroy();
                                getall();
                                // $('.success').html(response.message);
                            } else if (response.status === 422 && response.message) {
                                $('.text-danger').html('');
                                $.each(response.message, function (fieldName, errorMessages) {
                                    const errorHtml = errorMessages.join(', ');
                                    $(`#${fieldName}`).next('.text-danger').html(errorHtml);
                                });
                            } else {
                                console.log('else', response);
                                $('.error').html(response.message);
                            }
                            
                         if (dataTable) {
                    dataTable.destroy();
                     }
                dataTable = $('#myTable').DataTable({
                    autoFill: true,
                    data: response,
                columns: [
                    { data: 'sno' },
                    { data: 'category' },
                    { data: 'supplier' },
                    { data: 'quantity' },
                    { data: 'current_quantity'},
                    { data: 'rate' },
                    { data: 'date' },
                    { data: 'photo' },
                    { data: 'receipt' },
                    {data:'options'}
                ]
            });
                          
                        },
                        error: function (response, status, error) {
                            enableButton();
                            console.log( 'error' , response);
                            $('.error').html('Error: ' + response.message + ' ' + error);
                        }

            });
        });
    });

    $('#quantity, #rate').on('change', function(){
    $('#amount').val($('#quantity').val() *  $('#rate').val() );
    });

function getall(){
    var dataUrl = "{{ route('purchasing.create') }}";
    $.ajax({
        url: dataUrl,
        method: 'GET',
        success: function (response) {
            console.log(response);
            $('#myTable').DataTable({
                autoFill: true,
                data: response, // Use the response data
                columns: [
                    { data: 'sno' },
                    { data: 'category' },
                    { data: 'supplier' },
                    { data: 'quantity' },
                    { data: 'current_quantity'},
                    { data: 'rate' },
                    { data: 'date' },
                    { data: 'photo' },
                    { data: 'receipt' },
                    {data:'options'}
                ]
            });
        }
    });
};




    $('#lotQuantity, #lotCategory').on('change', function(){
    if ($('#lotQuantity').val() !== '' && $('#lotCategory').val() !== '') {
        $.ajax({
            method: 'post',
            url: "lot/getAmount",
            data: {
                'quantity': $('#lotQuantity').val(),
                'category': $('#lotCategory').val(),
                '_token': '{{ csrf_token() }}'
            }, 
            success: function(response) {
                $('#lotAmount').val(response);
                console.log(response);
            }
        });
    }
});


 $(document).on('click', '.purchase_view' , function(){
    var perchase = $(this).data('purchase');
    console.log(perchase);
     $('#Phone').val(perchase.phone);
     $('#Date').val(perchase.date);
     $('#Rate').val(perchase.rate);
     $('#Quantity').val(perchase.quantity);
     $('#Amount').val(perchase.quantity * perchase.rate);
    $('#perchasing_id').val(perchase.id);
    $('#Category').val(perchase.category_id);
    $('#Supplier').val(perchase.supplier_id);
    $('#viewPurchaseModal').modal('show');
 });



 $(document).on('click', '.purchase_delete', function() {
    var confirmation = confirm('Are you sure you want to delete this supplier?');
    if (confirmation) {
        var purchaseId = $(this).data('purchase');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            method: 'DELETE',
            url: '{{ route("purchasing.destroy", ["purchase" => ":purchaseId"]) }}'.replace(':purchaseId', purchaseId),
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#myTable').DataTable().destroy();
                                getall();
                console.log(response);
                if (dataTable) {
                    dataTable.destroy();
                     }
                dataTable = $('#myTable').DataTable({
                    autoFill: true,
                    data: response,
                columns: [
                    { data: 'sno' },
                    { data: 'category' },
                    { data: 'supplier' },
                    { data: 'quantity' },
                    { data: 'current_quantity'},
                    { data: 'rate' },
                    { data: 'date' },
                    { data: 'photo' },
                    { data: 'receipt' },
                    {data:'options'}
                ]
            });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        console.log('Delete canceled');
    }
});



});
function getQuantity(category) {
   
   dataset = {
          category_id: category, 
       //    quantity: $('#lotQuantity').val(),
         _token: '{{ csrf_token() }}'
   }
       $.ajax({
           url: "lot/getQuantity",
           method: 'post',
           data: dataset,
           success: function(response) {
              $('.quantity-avalable').html(response + ' KG');
              $('#lotQuantity').attr({
      "max" : response,
      "min" : 1 
   });
           }
       });
   }
    </script>
     <script src="{{asset('build/assets/js/lot.js')}}"></script>
@endsection