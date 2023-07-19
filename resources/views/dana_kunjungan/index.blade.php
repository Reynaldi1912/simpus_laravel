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
                        <input type="number" class="form-control" id="dana_kunjungan" placeholder="Dana Kunjungan">
                    </div>
                    <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Desa</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Kunjungan</th>
                            <th class="text-center">Tidak Kunjungan</th>
                            <th class="text-center">Total Kunjungan</th>
                            <th class="text-center">Total Dana Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                            @endphp
                        @foreach($data as $key)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$key->nama_desa}}</td>
                                <td>{{$key->nama_bulan}}</td>
                                <td class="text-center kunjungan" data-value="{{ (int)$key->kunjungan }}">{{ $key->kunjungan }} Kunjungan</td>
                                <td>{{$key->total_kunjungan - $key->kunjungan}} Kunjungan</td>
                                <td>{{$key->total_kunjungan}} Kunjungan</td>
                                <td class="total-dana-kunjungan">Rp 0,00</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('dana_kunjungan').addEventListener('input', function() {
    var danaKunjungan = this.value;
    var totalDanaKunjunganCells = document.getElementsByClassName('total-dana-kunjungan');

    Array.from(totalDanaKunjunganCells).forEach(function(cell) {
        var kunjunganText = cell.parentNode.querySelector('.kunjungan').getAttribute('data-value');
        var kunjungan = parseInt(kunjunganText);

        console.log(kunjungan);
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

</script>

@endsection