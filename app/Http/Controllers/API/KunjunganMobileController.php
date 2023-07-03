<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Hasil_Kunjungan;
use App\Models\Pasien;
use App\Models\Jadwal;
use App\Models\Desa;
use App\Models\User;
use Intervention\Image\Facades\Image;

class KunjunganMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = date('Y-m-d');

        $image = $request->file('image');


        // Menyimpan gambar ke direktori yang diinginkan
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        Pasien::updateOrCreate(
            [
                'nik' => $request->nik,
            ],
            [
                'nik' => $request->nik ,
                'nama' =>$request->nama ,
                'jml_anggota_keluarga' => $request->jml_anggota_keluarga ,
                'tgl_lahir' => $request->tanggal_lahir ,
                'umur' => $request->umur ,
                'alamat' => $request->alamat ,
                'no_hp' => $request->no_hp ,
                'bpjs' => $request->bpjs ,
                'created_by' =>$request->created_by
            ]
        );

        Hasil_Kunjungan::updateOrCreate(
            [
                'nik' => $request->nik,
                'created_at' => $today
            ],
            [
                'nik' => $request->nik ,
                'berat_badan' => number_format($request->berat_badan, 1, '.', ''),
                'tinggi_badan' => $request->tinggi_badan,
                'tekanan_darah' => $request->tekanan_darah,
                'penyuluhan' => $request->penyuluhan,
                'diagnosa' => $request->diagnosa,
                'dokumentasi' => $imageName,
                'created_by' => $request->created_by
            ]
        );

        $jadwalKunjungan = Jadwal::where('id_desa', $request->id_desa)
        ->where('tanggal_mulai', $today)
        ->first();
    
        if ($jadwalKunjungan) {
            $jadwalKunjungan->status = 1;
            $jadwalKunjungan->save();
        }
    

        return response()->json([
            'message' => 'Kunjungan Berhasil Di Inputkan',
            'isSuccess' => true,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id_desa = User::where('id',$id)->first()->id_desa;
        $result = DB::table('hasil_kunjungan AS a')
            ->select(DB::raw('DISTINCT a.*, b.nama, b.jml_anggota_keluarga, b.alamat, b.bpjs, b.no_hp, b.tgl_lahir, b.umur, c.upaya_kesehatan, c.tanggal_mulai, d.id_desa'))
            ->leftJoin('pasien AS b', 'a.nik', '=', 'b.nik')
            ->leftJoin('jadwal AS c', DB::raw('DATE(a.created_at)'), '=', DB::raw('DATE(c.tanggal_mulai)'))
            ->leftJoin('users AS d', 'a.created_by', '=', 'd.id')
            ->leftJoin('desa AS e', 'd.id_desa', '=', 'd.id')
            ->where('d.id_desa', $user_id_desa)
            ->get();

    

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = DB::table('hasil_kunjungan as a')
                    ->leftJoin('pasien as b', 'a.nik', '=', 'b.nik')
                    ->leftJoin('users as c', 'a.created_by', '=', 'c.id')
                    ->leftJoin('desa as d', 'c.id_desa', '=', 'd.id')
                    ->select('b.nama', 'b.jml_anggota_keluarga', 'b.tgl_lahir', 'b.umur', 'b.alamat', 'b.no_hp', 'b.bpjs', 'a.*', 'd.nama_desa', 'c.id_desa')
                    ->whereDate('a.created_at', date('Y-m-d'))
                    ->where('id_desa',$id)
                    ->first();
        return response()->json($results);

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
