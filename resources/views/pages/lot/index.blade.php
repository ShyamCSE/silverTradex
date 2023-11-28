@extends('layouts.app')
@section('container')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 h2">Lots</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Lots</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row pb-4 gy-3">


                <div class="col-sm-auto ms-auto">
                    <div class="d-flex gap-3">
                        <select name="filter" id="filter" class="form-control">
                            <option>All</option>
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
                        <table id="myTable" class="display table  table-hover table-nowrap align-middle mb-0"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th> Photo</th>
                                    <th>Category</th>
                                    <th> Quantity</th>
                                    <th> Amount</th>
                                  
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
    <!-- container-fluid -->
    </div>

    <div class="modal fade lot-div-modal " id="manage_lot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-bottom">
                <div class="modal-body p-0">
                    <!-- start lot -->
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center p-0">
                                <div class="card px-0 mb-0">
                                    <div class="modal-div-heading position-relative">
                                        <h2 id="heading" class=""> Lot Details</h2>
                                        <button type="button" class="btn-close" id="createMemberBtn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                        <p>Fill all form field to go to next step</p>
                                    </div>
                                     <div class="model_data">

                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end lot -->
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('build/assets/js/lot.js') }}"></script>
    <script>
        $(document).ready(function() {
            getAll();
        });

        // get by id 
        $(document).on('click', '.lot-action', function() {
            const url = "{{ route('lot.getById') }}";
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    'id': $(this).data('id'),
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#manage_lot').modal('show');
                    $('.model_data').empty();
                    $('.model_data').append(response);
                }
            })
        });

        // get all lot data 
        function getAll() {
            var dataUrl = "{{ route('lot.getAll') }}";
            $.ajax({
                url: dataUrl,
                method: 'GET',
                success: function(response) {
                    $('#myTable').DataTable().destroy();
                    $('#myTable').DataTable({
                        autoFill: true,
                        data: response,
                        columns: [{
                                data: 'sno'
                            },
                            {
                                data: 'photo'
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
                                data: 'status'
                            },
                            {
                                data: 'options'
                            }
                        ]
                    });
                }
            });
        };


$(document).on('click', '.next', function(e) {
    e.preventDefault();
    $('.text-danger').html('');
    var $form = $(this).closest('form.lotform_process');
     
    var closestFieldset = $(this).closest('fieldset');

   var currentStep = $('fieldset').index(closestFieldset);

   var formData = new FormData($form[0]);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status == 200) {
                moveToNextStep(currentStep);
             if(currentStep == 5){
                
                $('#manage_lot').modal('hide');
                Swal.fire({
                position: "top-end",
                icon: "success",
                title: " Lot Completed Successfully",
                showConfirmButton: false,
                timer: 1500
                });

             }
               
            } else if (response.status === 422) {
                for (const key in response.message) {
                    if (response.message.hasOwnProperty(key)) {
                        $(document).find('#' + key).next('.text-danger').html(response.message[key]);
                    }
                }
            }
        }
    });
});


function moveToNextStep(currentStep) {
    console.log("currentStep", currentStep);
  
    if (currentStep < $('fieldset').length &&  currentStep != 5 ) {
        $('fieldset').eq(currentStep).hide();
        $('fieldset').eq(currentStep + 1).show();
        currentStep++;
        updateProgressBar(currentStep);
    }
}

$(document).on('click' , '.previous' , function(){
    var $form = $(this).closest('form.lotform_process');
    var closestFieldset = $(this).closest('fieldset');

var currentStep = $('fieldset').index(closestFieldset);
   
    var currentStep = $('fieldset').index(closestFieldset);
    if (currentStep > 1) {
        $('fieldset').eq(currentStep ).hide();
        $('fieldset').eq(currentStep - 1).show();
        currentStep--;
        updateProgressBar(currentStep);
    }

})


function updateProgressBar(step) {
    var progressBar = $('.progress-bar');
    var totalSteps = $('fieldset').length;
    var progress = (step / totalSteps) * 100;
    progressBar.css('width', progress + '%');
}

$(document).on('click', '.lot_delete', function () {
    var lotId = $(this).data('delete');
    
    if (confirm('Are you sure you want to delete this lot?')) {

        $.ajax({
            type: 'GET',
            url: 'lot/delete/' + lotId,
            success: function (response) {
                getAll();
            },
            error: function (error) {
                alert('Error deleting the lot.');
            }
        });
    }
});


$(document).on('input', '#quantity_after_refinery', function() {
    let qty = parseFloat($('#quantity').val()) || 0; 
    let qar = parseFloat($('#quantity_after_refinery').val()) || 0; 
        if (qar > qty) {
            $('#quantity_after_refinery').closest('.form-group').find('.text-danger').html('Quantity after refinery cannot be more than quantity');
        } else {
            $('#quantity_after_refinery').closest('.form-group').find('.text-danger').html(''); 
            let percentageLoss = ((qty - qar) / qty) * 100;
            $('#loss').val(percentageLoss.toFixed(2) + '%');
        }

});


$(document).on('input' , '#sell_rate' , function(){
     let sell_rate = $('#sell_rate').val();
     let qut_a_r = $('#quantity_after_refinery').val();

     $('#sell_amount').val( qut_a_r * sell_rate);
})

        </script>
        
@endsection
