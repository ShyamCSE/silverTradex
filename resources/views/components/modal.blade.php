<!-- Modal -->
@extends('../layouts.app')
@section('models')

<div class="modal fade" id="addcategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add Category</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                            <div class="mb-3">
                                <label for="Name" class="form-label">Date</label>
                                <input type="date" class="form-control" id="Name" placeholder="" >
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12"> 
                            <div class="mb-3">
                                <label for="Name" class="form-label">Category</label>
                                <input type="text" class="form-control" id="Name" placeholder="" >
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">                  
                            <div class="hstack gap-2 justify-content-end mt-2">
                                <button type="submit" class="btn btn-success" id="addNewMember">Submit</button>
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


@endsection