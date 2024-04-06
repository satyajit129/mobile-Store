<!DOCTYPE html>

<html lang="en">

<head>

    @include('admin.global.css_support')

</head>

<body class="bg-light-gray" id="body">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10">
                    <div class="card card-default mb-0">
                        <div class="card-header pb-0">
                        </div>
                        <div class="card-body px-5 pb-5 pt-0">
                            
                            <h4 class="text-dark mb-6 text-center">Sign in for free</h4>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('adminLoginRequest') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12 mb-4">
                                        <input type="email" class="form-control input-lg" id="email"
                                            name="email" aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="password" class="form-control input-lg" id="password"
                                            name="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('user/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="plugins/simplebar/simplebar.min.js"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="plugins/prism/prism.js"></script>
    <script src="plugins/ladda/spin.min.js"></script>
    <script src="plugins/ladda/ladda.min.js"></script>
    <script src="js/mono.js"></script>
    <script src="js/chart.js"></script>
    <script src="js/map.js"></script>
    <script src="js/custom.js"></script>

    <script src="{{ asset('user/js/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('user/js/ladda/ladda.min.js') }}"></script>
</body>

</html>
