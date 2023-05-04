@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <div class="block">
            <div class="p-3 block-header-default">
                <div class="row">
                    <div class="col-6">
                        <h3 class="block-title">Hasil Kunjungan</h3>
                    </div>
                    <!-- <div class="col-6 text-right">
                        <a href="{{route('petugas.create')}}" class="btn btn-success">Tambahkan Petugas</a>
                    </div> -->
                </div>
            </div>
            <div class="block-content block-content-full">
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">nik</th>
                            <th class="text-center">nama pasien</th>
                            <th class="text-center">tekanan darah</th>
                            <th class="text-center" style="width: 15%;">diagnosa</th>
                            <th class="text-center" style="width: 20%;">penyuluhan</th>
                            <th class="text-center" style="width: 15%;">tanggal input</th>
                            <th class="text-center">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                    @foreach($data as $key)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="font-w600 text-center">{{$key->nik}}</td>
                            <td class="font-w600 text-center">{{$key->nama}}</td>
                            <td class="text-center">{{$key->tekanan_darah}}</td>
                            <td class="d-none d-sm-table-cell text-center">{{$key->diagnosa}}</td>
                            <td class="d-none d-sm-table-cell text-center">{{$key->penyuluhan}}</td>
                            <td class="d-none d-sm-table-cell text-center">{{$key->created_at}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-secondary get-detail" data-toggle="modal" data-target="#modal-current-data" data-key="{{$key->id}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Extra Large Modal -->
<div class="modal" id="modal-current-data" tabindex="-1" role="dialog" aria-labelledby="modal-current-data" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Detail Hasil Kunjungan Pasien</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                <span class="text-muted">Nama Petugas : <span id="nama_petugas"></span></span>
                <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-black">NIK</td>
                                <td id="nik"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Nama Lengkap</td>
                                <td id="nama"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Tanggal Lahir</td>
                                <td id="tanggal_lahir"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Jumlah Anggota Keluarga</td>
                                <td id="jumlah_kk"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Alamat</td>
                                <td id="alamat"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Umur</td>
                                <td id="umur"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Nomor HP</td>
                                <td id="no_hp"></td>
                            </tr>
                            <tr>
                                <td class="text-black">BPJS</td>
                                <td id="bpjs"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <hr>
                    <h3 class="block-title mt-5 text-muted pb-5">Detail Hasil Kunjungan Pasien</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-black">Berat Badan</td>
                                <td id="berat_badan"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Tinggi Badan</td>
                                <td id="tinggi_badan"></td>
                            </tr>
                            <tr>
                                <td class="text-black">Tekanan Darah</td>
                                <td id="tekanan_darah"></td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-black">Diagnosa : </span><br>
                    <span id="diagnosa"></span>
                    <br>
                    <span class="text-black">Penyuluhan : </span><br>
                    <span id="penyuluhan"></span>
                    <br>
                    <span class="text-black">Dokumentasi : </span><br>
                    <span id="dokumentasi"></span><br><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Extra Large Modal -->


<script>
    const detail = document.querySelectorAll('.get-detail');

    // menambahkan event listener ke setiap elemen <li>
    detail.forEach(function(detail) {
        detail.addEventListener('click', function() {
            const key = detail.getAttribute('data-key');
            changeDetail(key);
        });
    });
    function changeDetail(id){
        fetch('/get-detail-hasil-kunjungan/'+id)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nik').textContent = " : "+data.nik;
                    document.getElementById('nama').textContent = " : "+data.nama;
                    document.getElementById('tanggal_lahir').textContent = " : "+data.tgl_lahir;
                    document.getElementById('jumlah_kk').textContent = " : "+data.jml_anggota_keluarga;
                    document.getElementById('alamat').textContent = " : "+data.alamat;
                    document.getElementById('umur').textContent = " : "+data.umur;
                    document.getElementById('no_hp').textContent = " : "+data.no_hp;
                    document.getElementById('bpjs').textContent = data.bpjs == "1" ? " : Punya":" : Tidak Punya";
                    document.getElementById('berat_badan').textContent = " : "+data.berat_badan;
                    document.getElementById('tinggi_badan').textContent = " : "+data.tinggi_badan;
                    document.getElementById('tekanan_darah').textContent = " : "+data.tekanan_darah;
                    document.getElementById('diagnosa').textContent = data.diagnosa;
                    document.getElementById('penyuluhan').textContent = data.penyuluhan;
                    document.getElementById('dokumentasi').textContent = data.dokumentasi;
                    document.getElementById('nama_petugas').textContent = data.nama_petugas;

                })
    }
</script>
@endsection
