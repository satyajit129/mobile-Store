@extends('admin.global.master')

@section('title', 'Admin Profile')
@section('heading', 'Admin Profile')


@section('backend_custom_style')
@endsection


@section('backend_content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">
                @if (session('success'))
                    <div class="alert alert-success alert-icon" role="alert">
                        <i class="mdi mdi-checkbox-marked-outline"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-icon" role="alert">
                        <i class="mdi mdi-alert-outline"></i> {{ session('error') }}
                    </div>
                @endif
                
                <div class="card-header">
                    <h2 class="mb-5">Profile Settings</h2>

                </div>
                <div class="card-body">
                    <form action="{{ route('adminProfileUpdate', $admin_info->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="userName">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $admin_info->name }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="userName">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $admin_info->email }}" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="userName">Picture <span style="color:green;">(If you want to keep the old Picture
                                    then left
                                    this blank)</span></label>
                            <input type="file" class="form-control" name="picture" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="userName">Old Password
                                <span style="color:green;">(First you have to confirm your old password)</span>
                            </label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="userName">New Password </label>
                            <input type="password" class="form-control" name="new_password">
                        </div>
                        <div class="d-flex justify-content-end mt-6">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('backend_custom_js')
@endsection
