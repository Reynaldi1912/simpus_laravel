<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HASIL KUNJUNGAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container-sm">
        <div class="header text-center mb-5">
            <h5 class="pb-3"><u>LAPORAN HASIL</u></h5>
            <h6>Kegiatan {{$data->upaya_kesehatan}}</h6>
        </div>
        <table class="table-borderless">
            <tbody>
                <tr class="pb-2">
                    <td width="150px" style="vertical-align: top;">I. DASAR</td>
                    <td>: DPA Puskesmas Kedungjajang TA. 2023</td>
                </tr>
                <tr class="pb-2">
                    <td colspan="1" style="vertical-align: top;">II. MAKSUD</td>
                    <td>: {{$data->kegiatan}}</td>
                </tr>
                <tr class="pb-2">
                    <td colspan="1" style="vertical-align: top;">III. TANGGAL</td>
                    <td>: {{$tanggal_mulai}}</td>
                </tr>
                <tr class="pb-2">
                    <td colspan="1" style="vertical-align: top;">IV. PETUGAS</td>
                    <td>: {{$data->nama_pelaksana1}} , {{$data->nama_pelaksana2}}</td>
                </tr>
                <tr>
                    <td colspan="1" style="vertical-align: top;">V. TUJUAN</td>
                    <td>: {{$data->nama_desa}}</td>
                </tr>
                <tr>
                    <td colspan="1" style="vertical-align: top;">VI. HASIL</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <ol>
                            <li class="pb-3">Nama : {{$data->nama}}</li>
                            <li class="pb-3">JML ANGGOTA KELUARGA : {{$data->jml_anggota_keluarga}} Orang</li>
                            <li class="pb-3">NIK : {{$data->nik}}</li>
                            <li class="pb-3">BPJS : {{$data->bpjs == 1 ? "punya" : "tidak punya"}}</li>
                            <li class="pb-3">TGL LAHIR / UMUR : {{$data->tgl_lahir}} / {{$data->umur}} Tahun</li>
                            <li class="pb-3">ALAMAT : {{$data->alamat}}</li>
                            <li class="pb-3">NO HP : {{$data->no_hp}}</li>
                            <li class="pb-3">BB/TB : {{$data->berat_badan}} kg/ {{$data->tinggi_badan}} cm</li>
                            <li class="pb-3">TD : {{$data->tekanan_darah}}</li>
                            <li class="pb-3">DX : {{$data->diagnosa}}</li>
                            <li class="pb-3">KONSELING : {{$data->penyuluhan}}</li>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <p class="text-end">Lumajang , {{$tanggal_mulai}}</p>
    <table class="table-borderless">
        <tbody>
            <tr>
                <td width="300px">Mengetahui</td>
                <td width="250px">Pelapor</td>
                <td>TTD</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Kepala Puskesmas Kedungjajang</td>
                <td style="vertical-align: top;">
                    <ol>
                        <li class="pb-2">{{$data->nama_pelaksana1}}</li>
                        <li class="pb-2">{{$data->nama_pelaksana2}}</li>
                    </ol>
                </td>
                <td>
                    <ol>
                        <li class="pb-2">......</li>
                        <li class="pb-2">......</li>
                        <li>......</li>
                    </ol>
                </td>
            </tr>

            <tr>
                <td>
                    <h6><b><u>dr. ZAHROTUL ILMIYAH</u></b></h6>
                    <span>NIP. 19720217 200212 2 003</span>
                </td>
            </tr>
        </tbody>
    </table>   
        <div class="container text-center pt-1">
            <img src="/images/{{$data->dokumentasi}}" width="300px" alt="">
        </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.print(); 
        });
    </script>
</html>