@extends('admin.global.master')
@section('title', 'Settings')
@section('heading', 'Settings')

@section('backend_custom_style')
@endsection


@section('backend_content')
    <div class="row">
        <div class="col-xl-12">
            <!-- Account Settings -->
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
                    <h2 class="mb-5">Account Settings</h2>

                </div>

                <div class="card-body">

                    <form action="{{ route('updateSettings', $settings->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="firstName">WebSite Name</label>
                                    <input type="text" class="form-control" name="website_name"
                                        value="{{ $settings->website_name }}">
                                    <div class="text-success small mt-1" style="display: none;">
                                        Looks good!
                                    </div>
                                    <div class="text-danger small mt-1" style="display: none;">
                                        This Word Length is Too short,
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="lastName">WebSite Email</label>
                                    <input type="email" class="form-control" name="website_email"
                                        value="{{ $settings->website_email }}">
                                    <div class="text-success small mt-1" style="display: none;">
                                        Looks good!
                                    </div>
                                    <div class="text-danger small mt-1" style="display: none;">
                                        This is not a email formet.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="userName">CopyRight Text</label>
                            <input type="text" class="form-control" name="website_copy_right_text"
                                value="{{ $settings->website_copy_right_text }}">
                            <div class="text-success small mt-1" style="display: none;">
                                Looks good!
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="userName">Website Logo</label>
                            <input type="file" class="form-control" name="website_logo">
                            <div class="text-danger small mt-1" style="display: none;">
                                Please upload a valid image (jpeg, png, jpg, gif, svg) with a maximum size of 2MB.
                            </div>
                            <div class="text-success small mt-1" style="display: none;">
                                Looks good!
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">About Us</label>
                            <textarea class="form-control" name="about_us" cols="30" rows="6">{{ $settings->about_us }}</textarea>
                            <div class="text-success small mt-1" style="display: none;">
                                Looks good!
                            </div>
                            <div class="text-danger small mt-1" style="display: none;">
                                This Word Length is Too short
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Terms and Condition</label>
                            <textarea class="form-control" name="terms_condition" cols="30" rows="6">{{ $settings->terms_condition }}</textarea>
                            <div class="text-success small mt-1" style="display: none;">
                                Looks good!
                            </div>
                            <div class="text-danger small mt-1" style="display: none;">
                                This Word Length is Too short
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Privacy Policy</label>
                            <textarea class="form-control" name="privacy_policy" cols="30" rows="6">{{ $settings->privacy_policy }}</textarea>
                            <div class="text-success small mt-1" style="display: none;">
                                Looks good!
                            </div>
                            <div class="text-danger small mt-1" style="display: none;">
                                This Word Length is Too short
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-6">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">Update Settings</button>
                        </div>

                    </form>

                </div>

            </div>




        </div>

    </div>
@endsection

@section('backend_custom_js')
    <script>
        $(document).ready(function() {
            var isNameValid = false;
            var isEmailValid = false;
            var isCopyRightValid = false;
            var isLogoValid = true;
            var isAboutUsValid = false;
            var isTermsValid = false;
            var isPrivacyValid = false;

            // Disable the submit button by default
            $('button[type="submit"]').prop('disabled', true);

            // Call the checkInitialValues function on page load
            checkInitialValues();

            // Keyup event listener for website name input
            $('input[name="website_name"]').keyup(function() {
                var inputValue = $(this).val();
                if (inputValue.length >= 5) {
                    $(this).siblings('.text-success').show();
                    $(this).siblings('.text-danger').hide();
                    isNameValid = true;
                } else {
                    $(this).siblings('.text-success').hide();
                    $(this).siblings('.text-danger').show();
                    isNameValid = false;
                }
                updateSubmitButtonState();
            });

            // Keyup event listener for website email input
            $('input[name="website_email"]').keyup(function() {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailPattern.test($(this).val())) {
                    $(this).siblings('.text-success').show();
                    $(this).siblings('.text-danger').hide();
                    isEmailValid = true;
                } else {
                    $(this).siblings('.text-success').hide();
                    $(this).siblings('.text-danger').show();
                    isEmailValid = false;
                }
                updateSubmitButtonState();
            });

            // Keyup event listener for copy right text input
            $('input[name="website_copy_right_text"]').keyup(function() {
                if ($(this).val().length >= 10 && $(this).val().startsWith('@')) {
                    $(this).next('.text-success').show();
                    isCopyRightValid = true;
                } else {
                    $(this).next('.text-success').hide();
                    isCopyRightValid = false;
                }
                updateSubmitButtonState();
            });

            // Change event listener for website logo input
            $('input[name="website_logo"]').change(function() {
                var file = this.files[0];
                if (file) {
                    var allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
                    var fileExtension = file.name.split('.').pop().toLowerCase();
                    if ($.inArray(fileExtension, allowedExtensions) == -1) {
                        $(this).nextAll('.text-danger').text(
                            'Invalid file type. Please upload an image file.').show();
                        $(this).nextAll('.text-success').hide();
                        isLogoValid = false;
                    } else {
                        $(this).nextAll('.text-danger').hide();
                        $(this).nextAll('.text-success').show();
                        isLogoValid = true;
                    }
                } else {
                    $(this).nextAll('.text-success').hide();
                    $(this).nextAll('.text-danger').hide();
                    isLogoValid = false;
                }
                updateSubmitButtonState();
            });

            // Keyup event listener for textarea inputs
            $('textarea[name="about_us"], textarea[name="terms_condition"], textarea[name="privacy_policy"]').keyup(
                function() {
                    var textContent = $(this).val();
                    if (textContent.length < 50) {
                        $(this).siblings('.text-danger').show();
                        $(this).siblings('.text-success').hide();
                        if ($(this).attr('name') === 'about_us') {
                            isAboutUsValid = false;
                        } else if ($(this).attr('name') === 'terms_condition') {
                            isTermsValid = false;
                        } else if ($(this).attr('name') === 'privacy_policy') {
                            isPrivacyValid = false;
                        }
                    } else {
                        $(this).siblings('.text-danger').hide();
                        $(this).siblings('.text-success').show();
                        if ($(this).attr('name') === 'about_us') {
                            isAboutUsValid = true;
                        } else if ($(this).attr('name') === 'terms_condition') {
                            isTermsValid = true;
                        } else if ($(this).attr('name') === 'privacy_policy') {
                            isPrivacyValid = true;
                        }
                    }
                    updateSubmitButtonState();
                });

            // Function to check initial values
            function checkInitialValues() {
                // Check website name
                if ($('input[name="website_name"]').val().length >= 5) {
                    isNameValid = true;
                }

                // Check email
                if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('input[name="website_email"]').val())) {
                    isEmailValid = true;
                }

                // Check copy right text
                if ($('input[name="website_copy_right_text"]').val().length >= 10 && $(
                        'input[name="website_copy_right_text"]').val().startsWith('@')) {
                    isCopyRightValid = true;
                }

                // Check textarea inputs
                $('textarea[name="about_us"], textarea[name="terms_condition"], textarea[name="privacy_policy"]')
                    .each(function() {
                        if ($(this).val().length >= 50) {
                            if ($(this).attr('name') === 'about_us') {
                                isAboutUsValid = true;
                            } else if ($(this).attr('name') === 'terms_condition') {
                                isTermsValid = true;
                            } else if ($(this).attr('name') === 'privacy_policy') {
                                isPrivacyValid = true;
                            }
                        }
                    });

                // Update submit button state
                updateSubmitButtonState();
            }


            // Function to update submit button state
            function updateSubmitButtonState() {
                if (isNameValid && isEmailValid && isCopyRightValid && isLogoValid && isAboutUsValid &&
                    isTermsValid && isPrivacyValid) {
                    $('button[type="submit"]').prop('disabled', false);
                } else {
                    $('button[type="submit"]').prop('disabled', true);
                }
            }
        });
    </script>


@endsection
