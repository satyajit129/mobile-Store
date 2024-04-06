@extends('admin.global.master')
@section('title', 'Category List')
@section('heading', 'Category')

@section('backend_custom_style')
    <style>
        .category_row:hover {
            background-color: #9e6de0;
            color: black;
        }

        .category_row:hover a>span {
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

        /* .table tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            } */
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
                    <h2>Category</h2>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-category">
                        Add Category
                    </button>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Images</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_lists as $category_list)
                                <tr class="category_row">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('admin/category/' . $category_list->category_image) }}"alt="Category Images"
                                            style="width: 40px; height:40px; border-radius:50%;">
                                    </td>
                                    <td>{{ $category_list->category_name }}</td>
                                    <td>
                                        <a class="edit-category" data-toggle="modal" data-bs-target="#myModal"
                                            data-category-id ="{{ $category_list->id }}"
                                            style="border:1px solid black; padding:5px; cursor:pointer;">
                                            <span class="mdi mdi-pencil"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="delete-category" data-toggle="modal" data-target="#modal-delete-category"
                                            data-category-id="{{ $category_list->id }}"
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
        <!-- add Category Modal -->
        <div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('adminCategoryStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create New Category</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="form-group row mb-2">
                                <div class="col-12">
                                    <label class="col-form-label">Image</label>
                                    <div class="custom-file mb-1">
                                        <input type="file" class="custom-file-input" name="category_image" required>
                                        <label class="custom-file-label" for="coverImage">Category Images...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Category Name</label>
                                        <input type="text" class="form-control" name="category_name">
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
                            <button type="submit" class="btn btn-primary btn-pill">Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add Category Modal -->

        <!-- Category Update modal  -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
                    </div>
                    <div class="modal-body" id="modalContent">
                        <!-- Modal content will be loaded here dynamically -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Category Update modal  -->

        <!-- Delete Category Modal -->
        <div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog"
            aria-labelledby="modalDeleteCategoryTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header px-4">
                        <h5 class="modal-title" id="modalDeleteCategoryTitle">Delete Category</h5>
                    </div>
                    <div class="modal-body px-4">
                        <p>Are you sure you want to delete this category?</p>
                    </div>
                    <div class="modal-footer px-4">
                        <button type="button" class="btn btn-smoke btn-pill" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary btn-pill" id="confirm-delete">Delete
                            Category</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Category Modal -->

    </div>
@endsection

@section('backend_custom_js')
    {{-- edit Category --}}
    <script>
        $(document).ready(function() {
            $('.edit-category').on('click', function(e) {
                e.preventDefault(); // Prevent default link behavior

                var categoryId = $(this).data('category-id');
                console.log('category:', categoryId);

                $.ajax({
                    url: '{{ route('categoryContent', ['id' => ':id']) }}'.replace(':id',
                        categoryId),
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

    {{--  delete category --}}
    <script>
        $(document).ready(function() {
            $('.delete-category').click(function() {
                var categoryId = $(this).data('category-id');
                console.log(categoryId);
                $('#modal-delete-category').modal('show');
                $('#confirm-delete').data('category-id', categoryId);
            });

            $('#confirm-delete').click(function() {
                var categoryId = $(this).data('category-id');
                var $tr = $('.category_row').has('[data-category-id="' + categoryId + '"]');

                $.ajax({
                    url: '{{ route('adminCategoryDelete') }}',
                    method: 'GET',
                    data: {
                        categoryId: categoryId
                    },
                    success: function(response) {
                        $('#modal-delete-category').modal('hide');
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
