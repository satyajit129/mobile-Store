@extends('admin.global.master')
@section('title', 'Brand List')
@section('heading', 'Brand')

@section('backend_custom_style')
    <style>
        .brand_row:hover {
            background-color: #9e6de0;
            color: black;
        }

        .brand_row:hover a>span {
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
                    <h2>Brand</h2>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-brand">
                        Add Brand
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Subcategory</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brand_lists as $brand_list)
                                <tr class="brand_row" style="height: 55px;">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand_list->category->category_name }}</td>
                                    <td>{{ $brand_list->subcategory->subcategory_name }}</td>
                                    <td>{{ $brand_list->brand_name }}</td>
                                    <td>
                                        <a class="edit-brand" data-toggle="modal" data-bs-target="#myModal"
                                            data-brand-id ="{{ $brand_list->id }}"
                                            style="border:1px solid black; padding:5px; cursor:pointer;">
                                            <span class="mdi mdi-pencil"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="delete-brand" data-toggle="modal" data-target="#modal-delete-brand"
                                            data-brand-id="{{ $brand_list->id }}"
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
        <!-- add Brand Modal -->
        <div class="modal fade" id="modal-add-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('adminBrandStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create New Brand</h5>
                        </div>

                        <div class="modal-body px-4">
                            <div class="row mb-2">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="categorySelect">Category Name</label>
                                        <select class="form-control" id="categorySelect" name="category_id" required>
                                            <option value="" selected disabled> Select Category </option>
                                            @foreach ($category_lists as $category_list)
                                                <option value="{{ $category_list->id }}">
                                                    {{ $category_list->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="subcategorySelect">Subcategory Name</label>
                                        <select class="form-control" id="subcategorySelect" name="subcategory_id" required>
                                            <option value="" selected disabled> Select Subcategory </option>
                                            @foreach ($subcategory_lists as $subcategory_list)
                                                <option value="{{ $subcategory_list->id }}"
                                                    data-category-id="{{ $subcategory_list->category_id }}">
                                                    {{ $subcategory_list->subcategory_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Brand Name</label>
                                        <input type="text" class="form-control" name="brand_name">
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
                                        <textarea class="form-control" name="meta_description" cols="30" rows="5" style="width: 100%"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-pill">Save Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add Brand Modal -->

        <!-- Brand Update modal  -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Brand</h5>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <!-- Modal content will be loaded here dynamically -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Brand Update modal  -->

        <!-- Delete Brand Modal -->
        <div class="modal fade" id="modal-delete-brand" tabindex="-1" role="dialog"
            aria-labelledby="modalDeleteBrandTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="modalDeleteBrandTitle">Delete Brand</h5>
                    </div>
                    <div class="modal-body px-4">
                        <p>Are you sure you want to delete this Brand?</p>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-pill" id="confirm-delete">Delete
                            Brand</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Brand Modal -->

    </div>
@endsection

@section('backend_custom_js')
    {{-- Drop Down Content --}}
    <script>
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                var categoryId = $(this).val();
                $('#subcategorySelect option').each(function() {
                    if ($(this).data('category-id') == categoryId || categoryId === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#subcategorySelect').val('').prop('disabled',
                    false); // Reset and enable the subcategory select
            });
        });
    </script>

    {{-- Edit Brand --}}
    <script>
        $(document).ready(function() {
            $('.edit-brand').on('click', function(e) {
                e.preventDefault();

                var brandId = $(this).data('brand-id');
                console.log('Brand:', brandId);

                $.ajax({
                    url: '{{ route('brandContent', ['id' => ':id']) }}'.replace(':id',
                        brandId),
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

    {{--  delete Sub category --}}
    <script>
        $(document).ready(function() {
            $('.delete-brand').click(function() {
                var brandId = $(this).data('brand-id');
                console.log(brandId);
                $('#modal-delete-brand').modal('show');
                $('#confirm-delete').data('brand-id', brandId);
            });

            $('#confirm-delete').click(function() {
                var brandId = $(this).data('brand-id');
                var $tr = $('.brand_row').has('[data-brand-id="' + brandId + '"]');

                $.ajax({
                    url: '{{ route('adminBrandDelete') }}',
                    method: 'GET',
                    data: {
                        brandId: brandId
                    },
                    success: function(response) {
                        $('#modal-delete-brand').modal('hide');
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
