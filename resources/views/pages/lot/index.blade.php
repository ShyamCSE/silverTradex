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
                                    <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <p>Fill all form field to go to next step</p>
                                </div>
                                <form id="msform">
                                    <!-- progressbar -->
                                  
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <fieldset class="fieldset-step mn-2" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Making Charges:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 1 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Category
                                                        </label>
                                                        <select class="form-control" class="category">
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Item Name
                                                        </label>
                                                        <input type="text" class="form-control"  value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Photo
                                                        </label>
                                                        <input type="file" class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Name" class="form-label  d-flex  align-items-center">Quantity (Kg) <span class="ms-3 d-none text-primary quantity-status">356 Kg</span> </label>
                                                        <input type="text" class="form-control"  value="" name="Quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Rate
                                                        </label>
                                                        <input type="text" class="form-control"  value="" name="rate" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label for="paymentdetails" class="form-label d-flex align-items-center">Amount <span class="ms-3 text-primary quantity-status d-flex align-items-center">$<p class="m-0 p-0">2,914</p></span> </label>
                                                        <input type="text"  class="form-control" value="" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Made By
                                                        </label>
                                                        <input type="text" class="form-control" value="ABC Company" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Making Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>
                                    <fieldset class="fieldset-step" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Packaging & Local Dispatch:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 2 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Agent Name
                                                        </label>
                                                        <input type="text" class="form-control d-none" value="" name="Item" value="" />
                                                        <select class="form-control " >
                                                            <option value="">Select Agent</option>
                                                            <option value="Abhishek">Abhishek</option>
                                                            <option value="Shyam" >Shyam</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Mobile
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="Item" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Packed By
                                                        </label>
                                                        <input type="text"  class="form-control" value="" name="Item" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            No. Of Packages
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="Item" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Net Weight (Kg)
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="Quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Gross Weight (Kg)
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="rate" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Dimension
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Courier Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Additional Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Preliminary Document
                                                        </label>
                                                        <input type="file" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Remarks
                                                        </label>
                                                        <textarea cols="3" rows="3" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>

                                    <fieldset class="fieldset-step" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Shipping Charges:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 3 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            No. Of Packages
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="Item" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Net Weight (Kg)
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="Quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Gross Weight (Kg)
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="rate" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Dimension
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Date Of Shipping
                                                        </label>
                                                        <input type="date" class="form-control" value="" name="Item" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Port Of Loading
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Port Of Discharge
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Shipping Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Insurance Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Additional Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Remarks
                                                        </label>
                                                        <textarea cols="3" rows="3" class="form-control"> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                        </fieldset>

                                    <fieldset class="fieldset-step" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Shippment Received:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 4 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Received Date
                                                        </label>
                                                        <input type="date" class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Receipt No.
                                                        </label>
                                                        <input type="text"  class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            No. Of Packages
                                                        </label>
                                                        <input type="text"  disabled class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Gross Weight (Kg)
                                                        </label>
                                                        <input type="text" disabled class="form-control" value="" name="Quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Status
                                                        </label>
                                                        <select class="form-control">
                                                            <option value="pending" selected="">Pending</option>
                                                            <option value="Received">Received</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Clearance Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Additional Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Receipt of Shipment
                                                        </label>
                                                        <input type="file" class="form-control" value="" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Remarks
                                                        </label>
                                                        <textarea rows="3" cols="3" type="text" class="form-control" name="remarks"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset class="fieldset-step" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Refinery:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 5 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Quantity After Refinery
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Loss (%)
                                                        </label>
                                                        <input type="text" class="form-control" value="" disabled name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Refinary Charges
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Refinary Report
                                                        </label>
                                                        <input type="file" class="form-control" value="" name="Quantity" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Remarks
                                                        </label>
                                                        <textarea rows="3" cols="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset class="fieldset-step" >
                                        <div class="form-card mt-md-5">
                                            <div class="row bb-1">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Sell:</h2>
                                                </div>
                                                <div class="col-5">
                                                    <h2 class="steps">Step 6 - 6</h2>
                                                </div>
                                            </div>
                                            <div class="row mt-md-3">
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Quantity
                                                        </label>
                                                        <input type="text" class="form-control" disabled value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Rate
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="Item" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Amount
                                                        </label>
                                                        <input type="text" class="form-control" value="" name="amount" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Status
                                                        </label>
                                                        <select class="form-control">
                                                            <option value="pending" selected="">Pending</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label class="item">
                                                            Remarks
                                                        </label>
                                                        <textarea rows="3" cols="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" name="submit" data-bs-dismiss="modal" class="action-button" value="Submit" />
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end lot -->
            </div>
        </div>
    </div>
</div>

<script src="{{asset('build/assets/js/lot.js')}}"></script>
<script>

    $(document).ready(function () {
    getAll();
    });
    
   // get by id 
    $(document).on('click', '.lot-action', function() {
     const url = "{{route('lot.getById')}}";
     $.ajax({
        url: url,
        method: 'POST',
        data:{ 'id' : $(this).data('id'),
               '_token':'{{ csrf_token() }}'},
        success: function(response) {
            $('#manage_lot').modal('show');
          console.log(response);
    }})});

   // get all lot data 
    function getAll(){
    var dataUrl = "{{ route('lot.getAll') }}";
    $.ajax({
    url: dataUrl,
    method: 'GET',
    success: function (response) {
        console.log(response);
        $('#myTable').DataTable({
            autoFill: true,
            data: response, 
            columns: [
                { data: 'sno' },
                { data: 'photo'},
                { data: 'category'},
                { data: 'quantity'},
                { data: 'amount'},
                { data: 'status'},
                { data : 'options'}
            ]
        });
    }
});
};



</script>
@endsection