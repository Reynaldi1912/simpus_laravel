<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\hasil_Kunjungan;
use App\Models\Pasien;

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
        $image = $request->file('image');

        // Menyimpan gambar ke direktori yang diinginkan
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);

        Pasien::create([
            'nik' => $request->nik ,
            'nama' =>$request->nama ,
            'jml_anggota_keluarga' => $request->jml_anggota_keluarga ,
            'tgl_lahir' => $request->tanggal_lahir ,
            'umur' => $request->umur ,
            'alamat' => $request->alamat ,
            'no_hp' => $request->no_hp ,
            'bpjs' => $request->bpjs ,
            'created_by' =>$request->created_by
        ]);

        Hasil_Kunjungan::create([
            'nik' => $request->nik ,
            'berat_badan' => (float) $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'tekanan_darah' => $request->tekanan_darah,
            'penyuluhan' => $request->penyuluhan,
            'diagnosa' => $request->diagnosa,
            'dokumentasi' => $imageName,
            'created_by' => $request->created_by
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = DB::table('hasil_kunjungan as a')
            ->leftJoin('pasien as b', 'a.nik', '=', 'b.nik')
            ->leftJoin('jadwal as c', DB::raw('DATE(a.created_at)'), '=', DB::raw('DATE(c.tanggal_mulai)'))
            ->select('a.*', 'b.nama', 'b.jml_anggota_keluarga', 'b.alamat', 'b.bpjs', 'b.no_hp', 'b.tgl_lahir', 'b.umur', 'c.upaya_kesehatan', 'c.tanggal_mulai')
            ->where('a.created_by', $id)
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
        //
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
