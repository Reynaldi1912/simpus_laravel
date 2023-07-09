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
            <!-- END Row #1 -->
        </div>
        <div class="row invisible" data-toggle="appear">
            <!-- Row #2 -->
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header">
                        <div class="block-title">
                            <h5>Grafik Kegiatan Kunjungan Pasien</h5>
                        </div>
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
                            <canvas class="js-chartjs-dashboard-lines" id="myChart"></canvas>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-12">
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
            <!-- END Row #2 -->
        </div>
        <!-- old -->
    </div>
    <!-- END Page Content -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch('/get-all-desa')
            .then(response => response.json())
            .then(data => {
            const labels = [];
            const datas = [];
            const targets = [];
            const this_month = data[0].date;
            for (let i = 0; i < data.length; i++) {
                labels.push(data[i].nama_desa);
                datas.push(data[i].total_kunjungan);
                targets.push(data[i].target_kunjungan);
            }

            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                labels: labels,
                datasets: [{
                    label: 'Kunjungan Bulan '+this_month,
                    data: datas,
                    borderWidth: 1
                }, {
                    label: 'Target Kunjungan '+this_month,
                    data: targets,
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
        });
    </script>



@endsection
