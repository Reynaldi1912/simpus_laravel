<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Desa;
use App\Models\Jadwal;
use App\Models\Pasien;
use DB;

use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getUserByIdDesa($id){
        $user = User::all()->where('id_desa',$id);
        echo json_encode($user);
    }
    public function getUserByNamaDesa($id){
        $desa = Desa::all()->where('nama_desa',$id)->first();
        $user = [];
        if($desa){
            $user = User::all()->where('id_desa',$desa->id);
        }
        echo json_encode($user);
    }
    public function getJadwalByDesa(){
        $data = DB::table('vw_jadwal')->get();

        $events = [];

        foreach ($data as $data) {
            $events[] = [
                'id' => $data->id,
                'title' => $data->upaya_kesehatan,
                'start' => $data->tanggal_mulai,
                'kegiatan' => $data->kegiatan,
                'rincian_pelaksanaan' => $data->rincian_pelaksanaan,
                'id_desa' => $data->id_desa,
                'nama_desa' => $data->nama_desa,
                'nama_pelaksana1' => $data->nama_pelaksana1,
                'nama_pelaksana2' => $data->nama_pelaksana2,
                'color' => $data->color,
            ];
        }
        // echo json_encode($events);
        return response()->json(['data' => $events]);
    }
    public function getDetailException($id){
        echo json_encode(DB::table('vw_detail_exception')->where('id',$id)->first());
    }
    public function getDetailHistoryException($id){
        echo json_encode(DB::table('vw_detail_history_exception')->where('id',$id)->first());
    }
    public function getDetailPasien($nik){
        echo json_encode(Pasien::all()->where('nik',$nik)->first());
    }
    public function getDetailHasilKunjungan($id){
        echo json_encode(DB::table('vw_detail_hasil_kunjungan')->where('id',$id)->first());
    }
}
