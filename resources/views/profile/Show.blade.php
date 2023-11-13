@extends('layouts.app')

@section('container')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
                <!-- Profile Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Profile Image -->
                        <div class="text-center mb-4">
                            <img src="{{ Auth::user()->profile_photo_path ?? asset('files/profile.jpg') }}" alt="profile" style="max-width: 150px" class="img-fluid rounded-circle">
                        </div>

                        <!-- Profile Information Fields -->
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{Auth::user()->email }}" readonly>
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Change Password -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                            <div class="form-group my-2">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Image -->
       
    </div>
</div>
@endsection
