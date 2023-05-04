<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = DB::table('vw_petugas')->get()->count();
        $desa = DB::table('desa')->get()->count();
        $kunjungan = DB::table('hasil_kunjungan')->get()->count();
        $pasien = DB::table('pasien')->get()->count();
        return view('home' , ['totalUser'=> $user , 'totalDesa'=>$desa , 'totalKunjungan'=>$kunjungan ,'totalPasien'=>$pasien]);
    }
}
