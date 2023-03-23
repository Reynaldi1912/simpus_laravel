<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Desa;
use App\Models\Jadwal;
use DB;

class PenjadwalanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $desa = Desa::all();
        $user = user::all();
        
        return view('penjadwalan.index' , ['desa'=>$desa , 'user'=>$user]);
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
        $this->validate($request, [
            'txtUpayaKesehatan'     => 'required',
            'txtkegiatan'     => 'required',
            'txtTanggalPelaksanaan'   => 'required',
            'txtRincianPelaksanaan'   => 'required',
            'txtJumlahSasaran'   => 'required',
            'slctDesa' => 'required',
            'slctPelaksana1' => 'required',
            'slctPelaksana2' => 'required'
        ]);

        //create post
        Jadwal::create([
            'upaya_kesehatan'     => $request->txtUpayaKesehatan,
            'kegiatan'     => $request->txtkegiatan,
            'tanggal_mulai'   => $request->txtTanggalPelaksanaan,
            'rincian_pelaksanaan'   => $request->txtRincianPelaksanaan,
            'id_desa'   => $request->slctDesa,
            'nama_pelaksana1'   => $request->slctPelaksana1,
            'nama_pelaksana2'   => $request->slctPelaksana2,
            'status'   => 0,
        ]);

        return redirect()->route('penjadwalan.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
