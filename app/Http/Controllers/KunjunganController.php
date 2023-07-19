<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hasil_Kunjungan;
use DB;
use PDF;
class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::table('desa')
                    ->select('desa.id','desa.nama_desa', DB::raw('MAX(users.nama_lengkap) AS petugas_1'), DB::raw('MIN(users.nama_lengkap) AS petugas_2'))
                    ->leftJoin('users', 'desa.id', '=', 'users.id_desa')
                    ->groupBy('desa.id')
                    ->get();

        return view('kunjungan.index',['result'=>$results]);
    }

    public function detail($id){
        $data = DB::table('vw_detail_hasil_kunjungan')->where('id_desa',$id)->get();

        return view('kunjungan.detail',['data'=>$data ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('vw_detail_hasil_kunjungan')->where('id',$id)->first();
        setlocale(LC_ALL, 'id_ID'); // Mengatur pengaturan lokal ke bahasa Indonesia
        $dateString = $data->created_at;
        $date = date("d", strtotime($dateString));
        $month = date("n", strtotime($dateString));
        $year = date("Y", strtotime($dateString));
        
        // Daftar bulan dalam bahasa Indonesia
        $bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );
        
        $monthName = $bulan[$month];
        
        $formattedDate = $date . ' ' . $monthName . ' ' . $year;
        return view('kunjungan.index_pdf',['data'=>$data , 'tanggal_mulai'=>$formattedDate]);
        $pdf = PDF::loadview('kunjungan.index_pdf',['data'=>$data , 'tanggal_mulai'=>$formattedDate]);
        $pdf->set_paper("a4", "portrait");
        $pdf->render();
        return $pdf->stream('hasil-kunjungan.pdf', ['Attachment' => false]);
        return view('kunjungan.index_pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
