@extends('admin.global.master')
@section('title', 'Operating System List')
@section('heading', 'Operating System')

@section('backend_custom_style')
    <style>
        .operating_system_row:hover {
            background-color: #9e6de0;
            color: black;
        }

        .operating_system_row:hover a>span {
            color: black;
        }
    </style>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
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
                <div class="card-header align-items-center px-3 px-md-5">
                    <h2>Operating System</h2>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-operating_system">
                        Add Operating System
                    </button>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Operating System Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operating_system_lists as $operating_system_list)
                                <tr class="operating_system_row" style="height: 55px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $operating_system_list->category->category_name }}</td>
                                    <td>{{ $operating_system_list->operating_system_name }}</td>
                                    <td>
                                        <a class="edit-operating_system" data-toggle="modal" data-bs-target="#myModal"
                                            data-operating-system ="{{ $operating_system_list->id }}"
                                            style="border:1px solid black; padding:5px; cursor:pointer;">
                                            <span class="mdi mdi-pencil"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="delete-operating_system" data-toggle="modal"
                                            data-target="#modal-delete-operating_system"
                                            data-operating-system ="{{ $operating_system_list->id }}"
                                            style="border:1px solid black; padding:5px; cursor:pointer;">
                                            <span class="mdi mdi-trash-can"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- add Operating System Modal -->
        <div class="modal fade" id="modal-add-operating_system" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('adminOperatingSystemStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create New Operating System</h5>
                        </div>
                        <div class="modal-body px-4">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Category Name</label>
                                        <select class="form-control" id="exampleFormControlSelect12" name="category_id"
                                            required>
                                            <option value="" selected disabled> Select Category </option>
                                            @foreach ($category_lists as $category_list)
                                                <option value="{{ $category_list->id }}">{{ $category_list->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Operating System Name</label>
                                        <input type="text" class="form-control" name="operating_system_name">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="lastName">Meta Tag</label>
                                        <input type="text" class="form-control" name="meta_tag">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="userName">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" id="" cols="30" rows="5" style="width: 100%"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-pill">Save Operating System</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add Operating System Modal -->

        <!-- Operating System Update modal  -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Operating System</h5>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <!-- Modal content will be loaded here dynamically -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Operating System Update modal  -->

        <!-- Delete Operating System Modal -->
        <div class="modal fade" id="modal-delete-operating_system" tabindex="-1" role="dialog"
            aria-labelledby="modalDeleteSubategoryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="modalDeleteSubcategoryTitle">Delete Operating System</h5>
                    </div>
                    <div class="modal-body px-4">
                        <p>Are you sure you want to delete this Operating System?</p>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-pill" id="confirm-delete">Delete Operating System</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Operating System Modal -->

    </div>
@endsection

@section('backend_custom_js')
        {{-- Edit Operating System --}}
        <script>
            $(document).ready(function() {
                $('.edit-operating_system').on('click', function(e) {
                    e.preventDefault();
    
                    var operatingSystemID = $(this).data('operating-system');
                    console.log('Operating System:', operatingSystemID);
    
                    $.ajax({
                        url: '{{ route('operatingSystemContent', ['id' => ':id']) }}'.replace(':id',
                            operatingSystemID),
                        type: 'GET',
                        success: function(data) {
                            $('#modalContent').html(data);
                            $('#myModal').modal('show');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
    
                // Move the close button binding outside of the success callback
                $('.modal_close_btn').on('click', function() {
                    $('#myModal').modal('hide');
                });
            });
        </script>
            {{--  delete Operating System --}}
    <script>
        $(document).ready(function() {
            $('.delete-operating_system').click(function() {
                var operatingSystemID = $(this).data('operating-system');
                console.log(operatingSystemID);
                $('#modal-delete-operating_system').modal('show');
                $('#confirm-delete').data('operating-system', operatingSystemID);
            });

            $('#confirm-delete').click(function() {
                var operatingSystemID = $(this).data('operating-system');
                var $tr = $('.operating_system_row').has('[data-operating-system="' + operatingSystemID + '"]');

                $.ajax({
                    url: '{{ route('adminOperatingSystemDelete') }}',
                    method: 'GET',
                    data: {
                        operatingSystemID: operatingSystemID
                    },
                    success: function(response) {
                        $('#modal-delete-operating_system').modal('hide');
                        // Show Success Toaster 
                        toastr.success(response.message);
                        $tr.remove();
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error here
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
