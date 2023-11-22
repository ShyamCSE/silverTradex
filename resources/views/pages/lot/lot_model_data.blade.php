
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated"
            role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
   
      
    <fieldset class="fieldset-step"  style=" @if($lot->status == 1) display:block @endif "  >
        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="2">
            <input type="hidden" name="id" value="{{ $lot->id }}">
        <div class="container m-4">
            <div class="row">
                <div class="col-md-7">
                    <h2 class="fs-title">Making Charges</h2>
                </div>
                <div class="col-md-5">
                    <h2 class="steps">Step 1 - 6</h2>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control category">
                            <option disabled selected value="{{ $lot->category->id }}">{{ $lot->category->name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="itemName">Lot Name</label>
                        <input type="text" class="form-control" name="lot_name" value="{{ $lot->lot_name }}" id="lot_name" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <img src="{{ asset($lot->photo)}}" alt="Purchase Image" class="lotImg "  />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity" class="d-flex align-items-center">
                            Quantity (Kg)
                        </label>
                        <input type="text" class="form-control disabled " id="quantity" disabled name="quantity"  value="{{ $lot->quantity }}"/>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control" id="rate" name="rate" disabled value="{{ $lot->amount }}" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="madeBy">Made By</label>
                        <input type="text" class="form-control"  id="made_by" name="made_by" value="{{ $lot->made_by ?? ''}}" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="makingCharges">Making Charges</label>
                        <input type="text" class="form-control" id="making_charges"  name="making_charges" value="{{ $lot->making_charges }}" />
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
        <input type="button" name="next" class="btn btn-primary next action-button" value="Save & Next" />
        </form>
    </fieldset>

    <fieldset class="fieldset-step " style=" @if($lot->status == 2) display:block @endif " >
        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="3">
            <input type="hidden" name="id" value="{{ $lot->id }}">
            <div class="container md-4">
        <div class="form-card mt-md-5 container-fluid">
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
                        <input type="text" class="form-control"
                            value="{{ $lot->agent_name ?? ''}}" name="agent_name" id="agent_name" />
                            <span class="text-danger"></span>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                           Agent Mobile
                        </label>
                        <input type="text" class="form-control"
                           name="agent_mobile" value="{{ $lot->agent_mobile }}" id="agent_mobile" />
                           <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Packed By
                        </label>
                        <input type="text" class="form-control" id="packed_by" value="{{ $lot->packed_by ?? '' }}"
                            name="packed_by" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            No. Of Packages
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->no_of_packages ?? ''}}"
                            name="no_of_packages" id="no_of_packages" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Net Weight (Kg)
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->net_weight ?? ''}}"
                            name="net_weight" id="net_weight"/>
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Gross Weight (Kg)
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->gross_weight ?? ''}}"
                            name="gross_weight"  id="gross_weight"/>
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Dimension
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->dimension ?? ''}}"
                            name="dimension" id="dimension" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Courier Charges
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->courier_charges ?? '' }}" name="courier_charges" id="courier_charges" />
                        <span class="text-danger"></span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Additional Charges
                        </label>
                        <input type="text" class="form-control" name="packaging_additional_charges" value="{{ $lot->packaging_additional_charges ?? ''}}" id="packaging_additional_charges" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Preliminary Document
                        </label>
                        <input type="file" class="form-control" name="preliminary_document" id="preliminary_document"  />
                        @if($lot->preliminary_document != null && isset($lot->preliminary_document))
                           <span class="text-success">  <a href="{{asset( $lot->preliminary_document )}}"> Uploded </a></span>
                           @endif
                           <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="item">
                            Remarks
                        </label>
                        <textarea cols="3" rows="3" class="form-control" name="packaging_remarks" id="packaging_remarks">{{ $lot->packaging_remarks ?? ''}} </textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
</div>
        <input type="button" name="next" class="next action-button btn btn-primary "
            value="Save & Next" /> <input type="button" name="previous"
            class="previous action-button-previous btn btn-success " value="Previous" />
        </form>
    </fieldset>

    <fieldset class="fieldset-step " style=" @if($lot->status == 3) display:block @endif " >
        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="4">
            <input type="hidden" name="id" value="{{ $lot->id }}">
            <div class="container md-4">
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
                        <input type="text" disabled class="form-control"
                             value="{{ $lot->no_of_packages ?? ''}}" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Net Weight (Kg)
                        </label>
                        <input type="text" disabled class="form-control"
                            value="{{ $lot->net_weight ?? ''}}" id="net_weight" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Gross Weight (Kg)
                        </label>
                        <input type="text" disabled class="form-control"
                            value="{{ $lot->gross_weight ?? ''}}"  />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Dimension
                        </label>
                        <input type="text" disabled class="form-control"
                            value="{{ $lot->dimension ?? ''}}" name="dimension" id="dimension" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Date Of Shipping
                        </label>
                        <input type="date" class="form-control" value="{{ $lot->date_of_shipping ?? ''}}"
                            name="date_of_shipping"  id="date_of_shipping" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Port Of Loading
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->port_of_loading ?? ''}}" name="port_of_loading" id="port_of_loading" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Port Of Discharge
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->port_of_discharge ?? ''}}" id="port_of_discharge" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Shipping Charges
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->shipping_charges ?? ''}}" name="shipping_charges" id="shipping_charges" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Insurance Charges
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->insurance_charges ?? ''}}" name="insurance_charges"  id="insurance_charges"/>
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Additional Charges
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->additional_charges ?? ''}}" name="additional_charges" id="additional_charges" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="item">
                            Remarks
                        </label>
                        <textarea cols="3" rows="3" class="form-control" id="shipping_remarks" name="shipping_remarks"> {{ $lot->shipping_remarks ?? ''}} </textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
</div>
        <input type="button" name="next" class="next action-button btn btn-primary"
            value="Save & Next" /> <input type="button" name="previous"
            class="previous action-button-previous btn btn-success" value="Previous" />
        </form>
    </fieldset>

    <fieldset class="fieldset-step" style=" @if($lot->status == 4) display:block @endif " >
        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="5">
            <input type="hidden" name="id" value="{{ $lot->id }}">
            <div class="container md-4">
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
                        <input type="date" class="form-control" value="{{ $lot->received_date ?? ''}}"
                            name="received_date" id="received_date" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Receipt No.
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->receipt_no ?? '' }}" placeholder="Enter Receipt No Here .."
                            name="receipt_no" id="receipt_no" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            No. Of Packages
                        </label>
                        <input type="text" disabled class="form-control" 
                            value="{{ $lot->no_of_packages ?? ''}}"/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Gross Weight (Kg)
                        </label>
                        <input type="text" disabled class="form-control"
                            value="{{ $lot->gross_weight ?? '' }}" name="gross_weight" />
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
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Clearance Charges
                        </label>
                        <input type="text" class="form-control" id="clearance_charges" value=" {{ $lot->clearance_charges ?? ''}}" name="clearance_charges" />
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Additional Charges
                        </label>
                        <input type="text" id="shippment_additional_charges" class="form-control" value="{{ $lot->shippment_additional_charges ?? ''}}" name="shippment_additional_charges" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Receipt of Shipment
                        </label>
                        <input type="file" class="form-control"  name="receipt_of_shipment" id="receipt_of_shipment"/>
                        <span class="text-danger"></span>
                        @if(isset($lot->receipt_of_shipment) && $lot->receipt_of_shipment != null)
                        <span class="text-success">  <a href="{{ asset($lot->receipt_of_shipment)}}"> Uploaded </a></span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="item">
                            Remarks
                        </label>
                        <textarea rows="3" cols="3" type="text" class="form-control" id="shippment_remarks" name="shippment_remarks"> {{ $lot->shippment_remarks ?? '' }}</textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
</div>
        <input type="button" name="next" class="next action-button btn btn-primary"
            value="Save & Next" /> <input type="button" name="previous"
            class="previous action-button-previous btn btn-success" value="Previous" />
        </form>
    </fieldset>
    <fieldset class="fieldset-step " style=" @if($lot->status == 5) display:block @endif ">
        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="6">
            <input type="hidden" name="id" value="{{ $lot->id }}">
            <div class="container md-4">
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
                        <input type="text" class="form-control" value="{{ $lot->quantity_after_refinery ?? ''}}"
                            name="quantity_after_refinery" id="quantity_after_refinery" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Loss (%)
                        </label>
                        <input type="text" class="form-control" value="{{$lot->loss ?? ''}}"
                            disabled name="loss" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Refinary Charges
                        </label>
                        <input type="text" class="form-control" value="{{ $lot->refinary_charges ?? ''}}"
                            name="refinary_charges" id="refinary_charges" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Refinary Report
                        </label>
                        <input type="file" class="form-control" value=""
                            name="refinary_report" id="refinary_report" />
                            <span class="text-danger"></span>
                            @if(isset($lot->refinary_report ) && $lot->refinary_report != '')
                            <a href="{{ asset($lot->refinary_report)}}"> Uploaded</a>
                            @endif
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="item">
                            Remarks
                        </label>
                        <textarea rows="3" cols="3" class="form-control" id="refinery_report" name="refinery_report" >{{ $lot->refinery_report ?? '' }}</textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
</div>
        <input type="button" name="next" class="next action-button btn btn-primary "
            value="Save & Next" /> <input type="button" name="previous"
            class="previous action-button-previous btn btn-success" value="Previous" />
    </form>
    </fieldset>
    <fieldset class="fieldset-step mn-2" style="@if($lot->status == 6 || $lot->status == 7) display:block @endif">

        <form class="lotform_process" method="post" action="{{route('lot.process')}}">
            @csrf
            <input type="hidden" name="status" value="7">
            <input type="hidden" name="id" value="{{ $lot->id }}">
            <div class="container md-4">
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
                        <input type="text" class="form-control" disabled
                            value="" name="Item" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Rate
                        </label>
                        <input type="text" class="form-control" id="sell_rate" value="{{ $lot->sell_rate ?? '' }}" placeholder="Sell Rate "
                            name="sell_rate" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Amount
                        </label>
                        <input type="text" class="form-control" id="sell_amount" value="{{ $lot->sell_amount ?? ''}}"
                            name="sell_amount" />
                            <span class="text-danger"></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label class="item">
                            Status
                        </label>
                        <select class="form-control">
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="item">
                            Remarks
                        </label>
                        <textarea rows="3" cols="3" class="form-control" id="sell_remarks" name="sell_remarks">{{ $lot->sell_remarks ?? ''}}</textarea>
                        <span class="text-danger"></span>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <input type="button" name="next" class="next action-button btn btn-primary "
        value="Save" />
        <input type="button" name="previous" class="previous action-button-previous btn btn-success"
            value="Previous" />
        </form>
    </fieldset>
