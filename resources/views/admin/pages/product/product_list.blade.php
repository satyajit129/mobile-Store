@extends('admin.global.master')
@section('title', 'Product List')
@section('heading', 'Product')

@section('backend_custom_style')
    <style>
        .product_row:hover {
            background-color: #9e6de0;
            color: black;
        }

        .product_row:hover a>span {
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
                    <h2>Product</h2>

                    <button type="button" class="btn btn-primary" onclick="window.location.href = '{{ route('adminCreateproduct') }}'">
                        Add Product
                    </button>
                </div>
                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Images</th>
                                <th scope="col">product Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_lists as $product_list)
                                <tr class="product_row">
                                    
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('backend_custom_js')

@endsection
