
@extends('layouts.app')
@section('container')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Category</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row pb-4 gy-3">
            <div class="col-sm-4">
                <button class="btn btn-primary addPayment-modal" data-bs-toggle="modal" data-bs-target="#addcategoryModal"><i class="las la-plus me-1"></i> Add Category</button>
            </div>

            <div class="col-sm-auto ms-auto">
               <div class="d-flex gap-3">
                <div class="search-box">
                    <input type="text" class="form-control" id="searchMemberList" placeholder="Search for Result">
                    <i class="las la-search search-icon"></i>
                </div>
               </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content text-muted pt-2">
                            <div class="tab-pane active" id="nav-border-top-all" role="tabpanel">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-hover table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-muted text-uppercase">
                                                        <th scope="col">Sr. No.</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Category Name</th>
                                                         <th scope="col" style="width: 12%;">Action</th>
                                                    </tr>
                                                </thead>
            
                                                <tbody>
                                                    @foreach ($category as $item)
                                                    <tr>
                                                        <td> {{$loop }}</td>
                                                        <td>{{ $loop->create_at}}</td>
                                                        <td>{{ $loop->name }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn btn-soft-secondary btn-sm dropdown"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i
                                                                        class="las la-ellipsis-h align-middle fs-18"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <button class="dropdown-item" data-bs-toggle="modal"   data-bs-target="#updatepaymentModal"
                                                                            href="javascript:void(0);"><i
                                                                                class="las la-pen fs-18 align-middle me-2 text-muted"></i>
                                                                            Edit</button>
                                                                    </li>
                                                                    <li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li>
                                                                        <a class="dropdown-item remove-item-btn"
                                                                            href="#">
                                                                            <i
                                                                                class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i>
                                                                            Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                  
                                                    
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div><!-- end table responsive -->
                                    </div>
                                </div>
                            </div>

                           

                        </div>

                        <div class="row align-items-center mb-2 gy-3">
                           
                        </div>


                    </div><!-- end card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>

<div class="modal fade" id="addcategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add Category</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="addcategory" method="post" action="{{route('addCategory')}}" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
                            <div class="mb-3">
                                <label for="Name" class="form-label" >Category</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Category Here ..." >
                                <span class="text-danger" id="name-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">                  
                            <div class="hstack gap-2 justify-content-end mt-2">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
      $('#addcategory').on('submit', function(e) {
        e.preventDefault();
        console.log(this);
      })
    })
</script>

@endsection