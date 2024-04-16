@extends('admin.global.master')
@section('title', 'Product Create')
@section('heading', 'Product')

@section('backend_custom_style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">


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
    <style>
        .dropzone-section {
            width: 100%;
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .dropzone-section .plus-icon {
            font-size: 48px;
            color: #999;
            margin-bottom: 10px;
        }
    </style>
@endsection


@section('backend_content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-default">

                <div class="card-header align-items-center px-3 px-md-5">
                    <h2>Product</h2>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="CategorySelect">Category Name</label>
                                    <select class="form-control" id="categorySelect" name="category_id" required>
                                        <option value="" selected disabled> Select Category </option>
                                        @foreach ($category_lists as $category_list)
                                            <option value="{{ $category_list->id }}">{{ $category_list->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="BrandSelect">Brand Name</label>
                                    <select class="form-control" id="BrandSelect" name="brand_id" required>
                                        <option value="" selected disabled> Select Brand </option>
                                        @foreach ($brand_lists as $brand_list)
                                            <option value="{{ $brand_list->id }}"
                                                data-subcategory-id="{{ $brand_list->subcategory_id }}">
                                                {{ $brand_list->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ProductName">Product Name</label>
                                    <input type="text" class="form-control" placeholder="Product Name">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-dark font-weight-medium" for="datepicker">Release Date</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mdi mdi-calendar" id="basic-addon1"></span>
                                        </div>
                                        <input type="text" class="form-control" id="datepicker" data-mask="00/00/0000">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ProductModel">Product Model</label>
                                    <input type="text" class="form-control" placeholder="Product Model">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ProductDimension">Product Dimension</label>
                                    <input type="text" class="form-control" placeholder="Product Dimension">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ProductWeight">Product Weight</label>
                                    <input type="text" class="form-control" placeholder="Product Weight">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="SimStatus">Sim Status</label>
                                    <input type="text" class="form-control" placeholder="Sim Status">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="DisplayType">Display Type</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Select Display Type</option>
                                        <option value="amoled">AMOLED</option>
                                        <option value="lcd">LCD</option>
                                        <option value="oled">OLED</option>
                                        <option value="ips">IPS LCD</option>
                                        <option value="tft">TFT LCD</option>
                                        <option value="retina">Retina Display</option>
                                        <option value="plasma">Plasma</option>
                                        <option value="microled">MicroLED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="DisplaySize">Display Size</label>
                                    <input type="text" class="form-control" placeholder="Display Size">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="DisplayResulation">Display Resulation</label>
                                    <input type="text" class="form-control" placeholder="Display Resulation">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="OperatingSystem">Operating system</label>
                                    <select class="form-control" id="OperatingSystem">
                                        <option value="" selected disabled>Select Operating System</option>
                                        @foreach ($operating_system_lists as $operating_system_list)
                                            <option value="{{ $operating_system_list->id }}"
                                                data-category-id="{{ $operating_system_list->category_id }}">
                                                {{ $operating_system_list->operating_system_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Chipset">Chipset </label>
                                    <input type="text" class="form-control" placeholder="Chipset">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="CPU">CPU</label>
                                    <input type="text" class="form-control" placeholder="CPU">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="GPU">GPU</label>
                                    <input type="text" class="form-control" placeholder="GPU">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="CameraType">Camera Type</label>
                                    <input type="text" class="form-control" placeholder="Camera Type">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="CameraType">Main Camera</label>
                                    <input type="text" class="form-control" placeholder="Main Camera">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="MainCameraFeature">Main Camera Feature</label>
                                    <input type="text" class="form-control" placeholder="Main Camera Feature">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="SelfieCameraType">Selfie Camera Type</label>
                                    <input type="text" class="form-control" placeholder="Selfie Camera Type">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="SelfieCameraFeature">Selfie Camera Feature</label>
                                    <input type="text" class="form-control" placeholder="Selfie Camera Feature">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="SelfieCameraFeature">Speaker</label>
                                    <input type="text" class="form-control" placeholder="Speaker">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="SelfieCameraFeature">3.5mm Yearphone jack</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Selected One</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="WLAN">WLAN</label>
                                    <input type="text" class="form-control" placeholder="WLAN">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Bluetooth">Bluetooth</label>
                                    <input type="text" class="form-control" placeholder="Bluetooth">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="GPS">GPS</label>
                                    <input type="text" class="form-control" placeholder="GPS">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="NFC">NFC</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Selected One</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="FmRadio">Fm Radio</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Selected One</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="USBTYPE">USB TYPE</label>
                                    <input type="text" class="form-control" placeholder="USB TYPE">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Infraredport">Infrared port</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Selected One</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="Sensors">Sensors</label>
                                    <input type="text" class="form-control" placeholder="Sensors">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="BatteryType">Battery Type</label>
                                    <input type="text" class="form-control" placeholder="Battery Type">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="BatteryCapacity">Battery Capacity</label>
                                    <input type="text" class="form-control" placeholder="Battery Capacity">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="ChargingType">Charging Type</label>
                                    <input type="text" class="form-control" placeholder="Charging Type">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="MadeIn">Made In</label>
                                    <input type="text" class="form-control" placeholder="Made In">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="DeviceColor">Device Color</label>
                                    <input type="text" class="form-control" placeholder="Device Color">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="DeviceHighlights">Device Highlights</label>
                                    <input type="text" class="form-control" placeholder="Device highlights">
                                </div>
                            </div>



                        </div>
                        <!-- Dropzone Section -->
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="DeviceHighlights">Product Images</label>
                                <div class="dropzone-section dropzone" id="myDropzone">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('backend_custom_js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <!-- Date picker -->
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'dd/mm/yy'
            });
        });
    </script>
    {{-- Drop Down Content --}}
    <script>
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                var categoryId = $(this).val();
                console.log(categoryId);

                $('#subcategorySelect option').each(function() {
                    if ($(this).data('category-id') == categoryId || categoryId === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#subcategorySelect').val('').prop('disabled', false);

            });

            $('#subcategorySelect').change(function() {
                var selectedSubcategoryId = $(this).val();
                $('#BrandSelect option').each(function() {
                    var optionSubcategoryId = $(this).attr('data-subcategory-id');
                    if (optionSubcategoryId === selectedSubcategoryId || selectedSubcategoryId ===
                        '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#BrandSelect').val('');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#categorySelect').change(function() {
                var categoryId = $(this).val();

                $('#OperatingSystem option').each(function() {
                    var optionOperatingSystemId = $(this).attr('data-category-id');
                    if (optionOperatingSystemId === categoryId || categoryId === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#OperatingSystem').val('');
            });
        });
    </script>
    {{-- drop zone --}}
    <script>
        var myDropzone = new Dropzone("#myDropzone", {
            url: "/upload",
            autoProcessQueue: false,
            maxFilesize: 5,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {

                this.on("addedfile", function(file) {
                    file.previewElement.querySelector(".dz-remove").classList.add("btn", "btn-danger");
                });

                this.on("removedfile", function(file) {});
            }
        });
    </script>

@endsection
