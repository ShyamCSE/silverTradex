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
                                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
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
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        data: $form.serialize(),
        success: function(response) {
            if (response.status == 200) {
                moveToNextStep();
 
               
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

var currentStep = 1; // Initialize the current step to 1

function moveToNextStep() {
    console.log("currentStep", currentStep);

    if (currentStep < $('fieldset').length) {
        $('fieldset').eq(currentStep - 1).hide();
        $('fieldset').eq(currentStep).show();
        currentStep++;
        updateProgressBar(currentStep);
    }
}

function moveToPreviousStep() {
    if (currentStep > 1) {
        $('fieldset').eq(currentStep - 1).hide();
        $('fieldset').eq(currentStep - 2).show();
        currentStep--;
        updateProgressBar(currentStep);
    }
}

function updateProgressBar(step) {
    // Assuming you have a progress bar element with a class 'progress-bar'
    var progressBar = $('.progress-bar');
    var totalSteps = $('fieldset').length;
    var progress = (step / totalSteps) * 100;
    progressBar.css('width', progress + '%');
}

// Initialize the progress bar
updateProgressBar(currentStep);


        </script>
        
@endsection
