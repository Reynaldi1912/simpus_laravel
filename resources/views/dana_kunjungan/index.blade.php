@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <div class="block">
                <div class="p-3 block-header-default">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="block-title">Dana Kunjungan</h3>
                        </div>
                        <div class="col-6">
                            <input type="number" class="form-control" id="dana_kunjungan" value="0" placeholder="Dana Kunjungan">
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Petugas</th>
                                <th class="text-center">Nama Desa</th>
                                <th class="text-center">Bulan</th>
                                <th class="text-center">Kunjungan</th>
                                <th class="text-center">Tidak Kunjungan</th>
                                <th class="text-center">Total Kunjungan</th>
                                <th class="text-center">Total Dana Kunjungan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($data as $key)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$key->nama_pelaksana}}</td>
                                    <td>{{$key->nama_desa}}</td>
                                    <td>Juli</td>
                                    <td class="text-center kunjungan" data-value="{{ (int)$key->kunjungan }}">{{ $key->kunjungan }} Kunjungan</td>
                                    <td>{{$key->total_kunjungan - $key->kunjungan}} Kunjungan</td>
                                    <td>{{$key->total_kunjungan}} Kunjungan</td>
                                    <td class="total-dana-kunjungan">Rp 0,00</td>
                                    <td><a href="{{ route('kunjungan.kuitansi', ['id' => $key->nomor_urut, 'total' => 0]) }}"  target="_blank" class="btn btn-success btn-print" data-id="{{ $key->nomor_urut }}">Print</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($message = Session::get('error'))
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-danger animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif


<script>
$(document).ready(function() {
    $("#dana_kunjungan").on("input", function() {
        var valueDanaKunjungan = $(this).val();
        $(".btn-print").each(function() {
            var id = $(this).data("id");
            var newHref = "/print-kuitansi/" + id + "/" + valueDanaKunjungan;
            $(this).attr("href", newHref);
        });
    });
});
</script>

<script>
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            pageLength: 25,
            lengthMenu: [[25, 40, 50, -1], [25, 40, 50, 'Todos']]
        });

        
        document.getElementById('dana_kunjungan').addEventListener('input', function () {
            var danaKunjungan = parseFloat(this.value);
            var totalDanaKunjunganCells = document.getElementsByClassName('total-dana-kunjungan');

            Array.from(totalDanaKunjunganCells).forEach(function (cell) {
                var kunjunganText = cell.parentNode.querySelector('.kunjungan').getAttribute('data-value');
                var kunjungan = parseInt(kunjunganText);

                if (!isNaN(kunjungan)) {
                    var totalDanaKunjungan = kunjungan * danaKunjungan;
                    var formattedDanaKunjungan = totalDanaKunjungan.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                    cell.textContent = formattedDanaKunjungan;
                } else {
                    cell.textContent = "-";
                }
            });
        });
    });
</script>

@endsection
