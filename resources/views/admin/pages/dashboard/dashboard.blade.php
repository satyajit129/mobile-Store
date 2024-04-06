@extends('admin.global.master')

@section('title', 'Admin DashBoard')
@section('heading', 'DashBoard')


@section('backend_custom_style')
@endsection


@section('backend_content')
    <div class="row">
        <div class="col-xl-4">

            <!-- User -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Users</h2>
                </div>
                <div class="card-body">
                    <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                        <div class="d-flex flex-column">
                            <span class="h3 text-white">325,980</span>
                            <span>vs 275,900 (prev)</span>
                        </div>
                        <div>
                            <span>45%</span>
                            <i class="mdi mdi-arrow-up-bold"></i>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-xl-4">

            <!-- Session -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Sessions</h2>
                </div>
                <div class="card-body">
                    <div class="bg-success d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                        <div class="d-flex flex-column">
                            <span class="h3 text-white">7,833</span>
                            <span>vs 7,012 (prev)</span>
                        </div>
                        <div>
                            <span>55%</span>
                            <i class="mdi mdi-arrow-up-bold"></i>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="col-xl-4">

            <!-- Bounce Rate -->
            <div class="card card-default">
                <div class="card-header">
                    <h2>Bounce Rate</h2>
                </div>
                <div class="card-body">
                    <div class="bg-danger d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                        <div class="d-flex flex-column">
                            <span class="h3 text-white">67.0%</span>
                            <span>vs 65.21% (prev)</span>
                        </div>
                        <div>
                            <span>7%</span>
                            <i class="mdi mdi-arrow-down-bold"></i>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection

@section('backend_custom_js')
@endsection
