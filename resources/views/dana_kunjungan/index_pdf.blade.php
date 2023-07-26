<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="mt-3">
    <h4 class="text-center"><u>KUITANSI</u></h4>
</div>
<?php
function terbilang($number) {
    $angka = array(
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas'
    );

    if ($number < 12) {
        return $angka[$number];
    } elseif ($number < 20) {
        return $angka[$number - 10] . ' Belas';
    } elseif ($number < 100) {
        return $angka[$number / 10] . ' Puluh ' . terbilang($number % 10);
    } elseif ($number < 200) {
        return 'Seratus ' . terbilang($number - 100);
    } elseif ($number < 1000) {
        return $angka[$number / 100] . ' Ratus ' . terbilang($number % 100);
    } elseif ($number < 2000) {
        return 'Seribu ' . terbilang($number - 1000);
    } elseif ($number < 1000000) {
        return terbilang($number / 1000) . ' Ribu ' . terbilang($number % 1000);
    } elseif ($number < 1000000000) {
        return terbilang($number / 1000000) . ' Juta ' . terbilang($number % 1000000);
    } elseif ($number < 1000000000000) {
        return terbilang($number / 1000000000) . ' Milyar ' . terbilang(fmod($number, 1000000000));
    } elseif ($number < 1000000000000000) {
        return terbilang($number / 1000000000000) . ' Trilyun ' . terbilang(fmod($number, 1000000000000));
    } else {
        return 'Angka terlalu besar';
    }
}

$angka = $nominal;
$terbilang = terbilang($angka) . ' Rupiah';

$total = ($nominal * $data->kunjungan);
$formattedTotal = number_format($total, 0, ',', '.');
?>

<div class="container-sm mt-5">
    <table>
        <tbody>
            <tr>
                <td style="width:25%">
                    Sudah Diterima Dari
                </td>
                <td>
                    : Bendahara Pegeluaran Puskesmas Kedungjajang
                </td>
            </tr>
            <tr>
                <td>
                    Jumlah Uang
                </td>
                <td>
                    : <b>{{$terbilang}}</b>
                </td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>: Biaya Perjalanan Dinas Dalam Daerah Dalam Rangka Kegiatan Kunjungan</td>
            </tr>
            <tr>
                <td></td>
                <td class="row mt-4">
                    <div class="col-3">Ke</div>
                    <div class="col">: {{$data->nama_desa}}</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="row">
                    <div class="col-3">Kunjungan</div>
                    <div class="col">: {{$data->kunjungan}} Kunjungan</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="row">
                    <div class="col-3">Bulan</div>
                    <div class="col mb-3">: Juli 2023</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><span>Dengan Perincian</span></td>
            </tr>
            <tr>
                <td></td>
                <td class="row mt-2">
                    <div class="col-3">Transport Lokal</div>
                    <div class="col-5">1 ptgs x Rp.{{$nominal}} x {{$data->kunjungan}}</div>
                    <div class="col">Rp.{{$formattedTotal}}</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="row">
                    <div class="col-3">PPN</div>
                    <div class="col-5"></div>
                    <div class="col">-</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="row">
                    <div class="col-3"></div>
                    <div class="col-5"></div>
                    <div class="col border"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="row">
                    <div class="col-3"></div>
                    <div class="col-5"><b>Jumlah</b></div>
                    <div class="col mb-5"><b>Rp.{{$formattedTotal}}</b></div>
                </td>
            </tr>
            <tr>
                <td>Terbilang</td>
                <td class="row">
                    : Rp.{{$formattedTotal}}
                </td>
            </tr>
            <tr>
                <td>Lunas Dibayar Tanggal</td>
                <td class="row">
                    :
                </td>
            </tr>
        </tbody>
    </table>
    <?php
        setlocale(LC_TIME, 'id_ID'); // Atur locale menjadi bahasa Indonesia

        $bulan = strftime('%B'); // Mendapatkan nama bulan sekarang dalam bahasa Indonesia
    ?>

    <div class="row text-end mt-5">
        <div class="col-7"></div>
        <div class="col text-center">
            <span>Lumajang , ........ {{$bulan}} 2023</span><br>
            <span></span>
        </div>
    </div>
    <div class="row text-end mt-5">
        <div class="col-7"></div>
        <div class="col text-center">
            <span>Yang Menerimakan</span><br>
            <span></span>
        </div>
    </div>

    <div class="row text-end mt-5">
        <div class="col-7"></div>
        <div class="col text-center">
            <span><b><u>{{$data->nama_pelaksana}}</u></b></span><br>
            <span>NIP.{{$user->id}}</span>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-4 text-start">
            <div class="text-center">
                <span>Mengetahui</span><br>
                <span>PPTK</span>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-5 text-center">
            <span>Setuju Dibayar,</span><br>
            <span>Bendahara Pengeluaran Pembantu</span><br>
            <span>Puskesmas Kedungjajang</span><br>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-4 text-start">
            <div class="text-center">
                <span><b><u>Riza Pemi Priatna</u></b></span><br>
                <span>NIP. 19870531 200903 2 006</span>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-5 text-center">
            <span><b><u>Eny Setiowati</u></b></span><br>
            <span>NIP. 19730725 200501 2 009</span>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        window.print(); 
    });
</script>
