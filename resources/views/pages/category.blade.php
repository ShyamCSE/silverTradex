
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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
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
                                                     
                                                        <th scope="col">Category Name</th>
                                                        <th scope="col">Total Quantity </th>
                                                        <th scope="col">Current Available </th>
                                                         <th scope="col" style="width: 12%;">Action</th>
                                                    </tr>
                                                </thead>
            
                                                <tbody>
                                               
                                                    @foreach ($category as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                       
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->purchase->sum('quantity') }}</td>
                                                        <td>{{ $item->purchase->sum('current_quantity') }}</td>
                                                        <td>
                                                        <button  data-bs-toggle="modal" data-bs-target="#editcategoryModal" class=" btn btn-success btn-sm edit-category" data-category-id="{{ $item }}">
                                                        <i class="las la-pen fs-18 align-middle me-2 text-muted"></i> Edit
                                                            </button>
                                                        
                                                            <a class="btn btn-danger btn-sm delete-category"  data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                                                <i class="las la-trash-alt fs-18 align-middle me-2 text-muted"></i> Delete
                                                            </a>
                                                            </ul>
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
                <form id="addcategory" method="post" action="{{ route('addCategory') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="mb-3">
                                <label for="Name" class="form-label">Category</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Here ...">
                                <span class="text-danger" id="name-error"></span>
                                <span class="text-success" id="name-success"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="hstack gap-2 justify-content-end mt-2">
                                <button type="submit"  class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editcategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Edit Category</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <form id="editcategory" method="post" action="{{ route('editCategory') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <input type="hidden" name="id" value="" id="editid">
                            <div class="mb-3">
                                <label for="Name" class="form-label">Category</label>
                                <input type="text" class="form-control" id="editname" name="name" placeholder="Enter Category Here ...">
                                <span class="text-danger" id="name-error"></span>
                                <span class="text-success" id="name-success"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="hstack gap-2 justify-content-end mt-2">
                                <button type="submit"  class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal for Confirmation -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteCategoryModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this category?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" id="confirmDeleteButton" href="{{ route('category.delete', ['id' => $item->id ?? 0]) }}" >Delete</a>
        </div>
      </div>
    </div>
  </div>
  
  


<script>
 $(document).ready(function () {
    $('#addcategory').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission
  
  
        // Clear any previous error messages
        $('#name-error').text('');
        $('#name-success').text('');
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
              
                $('#name-success').html(response.message)
                setTimeout( location.reload(), 5000);
              console.log(response.message);
            },
            error: function (response) {
                $('#name-error').html(response.responseJSON.message);
            },
        });
    });
});

</script>
<script>
    $(document).ready(function () {
        // Edit category click event
        $('.edit-category').on('click', function () {
            var category = $(this).data('category-id');
          $('#editname').val(category.name);
          $('#editid').val(category.id);
          $('#editcategoryModal').show();
          
        });
    
     
    });

    $(document).ready(function () {
    $('#editCategory').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Clear any previous error messages
        $('#name-error').text('');
        $('#name-success').text('');
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                $('#name-success').html(response.message);
                // Reload the page after 5000 milliseconds (5 seconds)
                // setTimeout(function() {
                //     location.reload();
                // }, 5000);
                // console.log(response.message);
            },
            error: function (response) {
                $('#name-error').html(response.responseJSON.message);
            },
        });
    });
});


 

    </script>
    
    <script>
        document.getElementById("confirmDeleteButton").addEventListener("click", function () {
          // You can add code here to confirm the deletion and make an AJAX request to the server using the specified route.
          // Once the deletion is successful, you can close the modal if needed.
          // You can use the Bootstrap JavaScript library to manage the modal. For example, to close the modal:
          
          var modal = new bootstrap.Modal(document.getElementById("deleteCategoryModal"));
          modal.hide();
        });
      </script>
      



@endsection