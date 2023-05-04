@extends('layouts.app')

@section('content')
<!-- Page Content -->
    <div class="content">
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-12 col-xl-12">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-bag fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{$totalKunjungan}}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Kunjungan</div>
                    </div>
                </a>
            </div>
            <!-- <div class="col-6 col-xl-6">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-envelope-open fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="{{$totalPasien}}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Pasien Terdata</div>
                    </div>
                </a>
            </div> -->
            <!-- <div class="col-4 col-xl-4">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-users fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="4252">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Kegiatan</div>
                    </div>
                </a>
            </div> -->
            <!-- END Row #1 -->
        </div>
        <div class="row invisible" data-toggle="appear">
            <!-- Row #2 -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Kunjungan Minggu Ini
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <!-- Lines Chart Container functionality is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _es6/pages/be_pages_dashboard.js -->
                            <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                            <canvas class="js-chartjs-dashboard-lines"></canvas>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row items-push">
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                <div class="font-size-h4 font-w600">720</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +16%
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                <div class="font-size-h4 font-w600">160</div>
                                <div class="font-w600 text-danger">
                                    <i class="fa fa-caret-down"></i> -3%
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Average</div>
                                <div class="font-size-h4 font-w600">24.3</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +9%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row invisible" data-toggle="appear">
                <!-- Row #4 -->
                    <div class="col-md-12">
                        <a class="block block-transparent bg-gd-dusk" href="javascript:void(0)">
                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="p-20">
                                    <i class="fa fa-2x fa-map-marker text-black-op"></i>
                                </div>
                                <div class="ml-5 text-right">
                                    <p class="font-size-lg font-w600 text-white mb-0">
                                        {{$totalDesa}}
                                    </p>
                                    <p class="font-size-sm text-uppercase font-w600 text-white-op mb-0">
                                        Desa
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="block block-transparent bg-gd-sun" href="javascript:void(0)">
                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="p-20">
                                    <i class="fa fa-2x fa-users text-black-op"></i>
                                </div>
                                <div class="ml-5 text-right">
                                    <p class="font-size-lg font-w600 text-white mb-0">
                                        {{$totalUser}}
                                    </p>
                                    <p class="font-size-sm text-uppercase font-w600 text-white-op mb-0">
                                        Petugas
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="block block-transparent bg-gd-lake" href="javascript:void(0)">
                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div class="p-20">
                                    <i class="fa fa-2x fa-heartbeat text-black-op"></i>
                                </div>
                                <div class="ml-5 text-right">
                                    <p class="font-size-lg font-w600 text-white mb-0">
                                        {{$totalPasien}}
                                    </p>
                                    <p class="font-size-sm text-uppercase font-w600 text-white-op mb-0">
                                        Data Pasien
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- END Row #4 -->
                </div>
            </div>
            <!-- <div class="col-md-6">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">
                            Kegiatan Minggu Ini
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="pull-all">
                            <canvas class="js-chartjs-dashboard-lines2"></canvas>
                        </div>
                    </div>
                    <div class="block-content bg-white">
                        <div class="row items-push">
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                <div class="font-size-h4 font-w600">$ 6,540</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +4%
                                </div>
                            </div>
                            <div class="col-6 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                <div class="font-size-h4 font-w600">$ 1,525</div>
                                <div class="font-w600 text-danger">
                                    <i class="fa fa-caret-down"></i> -7%
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-left">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Balance</div>
                                <div class="font-size-h4 font-w600">$ 9,352</div>
                                <div class="font-w600 text-success">
                                    <i class="fa fa-caret-up"></i> +35%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- END Row #2 -->
        </div>
        <!-- old -->
    </div>
    <!-- END Page Content -->
@endsection
