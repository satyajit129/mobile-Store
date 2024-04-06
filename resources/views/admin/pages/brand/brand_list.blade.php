@extends('admin.global.master')
@section('title', 'Brand List')
@section('heading', 'Brand')

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
                                <th scope="col">Brand Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- add Category Modal -->
        <div class="modal fade" id="modal-add-brand" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                <option value="{{ $category_list->id }}">{{ $category_list->category_name }}</option>
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
                                                <option value="{{ $subcategory_list->id }}" data-category-id="{{ $subcategory_list->category_id }}">{{ $subcategory_list->subcategory_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="firstName">Brand Name</label>
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
                            <button type="submit" class="btn btn-primary btn-pill">Save Brand</button>
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
<script>
    $(document).ready(function(){
        $('#categorySelect').change(function(){
            var categoryId = $(this).val();
            $('#subcategorySelect option').each(function(){
                if($(this).data('category-id') == categoryId || categoryId === '') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $('#subcategorySelect').val('').prop('disabled', false); // Reset and enable the subcategory select
        });
    });
</script>
@endsection
