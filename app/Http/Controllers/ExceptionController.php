<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Exception;
use App\Models\Jadwal;
use App\Models\History_Exception;


class ExceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = DB::table('vw_detail_exception')->where('status_appr','0')->where('status_kunjungan','0')->get();
        $history = DB::table('vw_detail_history_exception')->get();
        return view('exception.index' , ['data'=>$data , 'history'=>$history]);
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
        $status = $request->status; 
        $dateString = $request->tanggal_kegiatan;
        $date = date_create($dateString);
        $formattedDate = date_format($date, 'Y-m-d');
        
        $penjadwalan = Jadwal::where('tanggal_mulai', $formattedDate)
                        ->where('id_desa', $request->id_desa)
                        ->first();
        if($status == 0){
            //approve
            if($penjadwalan->status != 1){
                $penjadwalan->update([
                    'tanggal_mulai' => $request->tanggal
                ]);

                $exception = Exception::all()->where('id',$request->id_exception)->first();
                $exception->delete();

                $history = new History_Exception();
                $history->create([
                   'status_appr' => 1,
                   'id_user' => $exception->id_user,
                   'old_date' => $penjadwalan->tanggal_mulai,
                   'new_date' => $request->tanggal,
                   'kegiatan' => $penjadwalan->kegiatan
                ]);
                return back()->with('warning','Berhasil , Exception Berhasil Di Approve');
            }
            return back()->with('error','Tidak Bisa Update Tanggal , Kunjungan Telah Selesai Dilakukan');
        }elseif($status == 1){
            if($penjadwalan->status != 1){
                $exception = Exception::all()->where('id',$request->id_exception)->first();
                $exception->delete();

                $history = new History_Exception();
                $history->create([
                   'status_appr' => 2,
                   'id_user' => $exception->id_user,
                   'old_date' => $penjadwalan->tanggal_mulai,
                   'keterangan' => $request->keterangan,
                   'kegiatan' => $penjadwalan->kegiatan
                ]);
                return back()->with('warning','Exception Berhasil Ditolak');
            }
            return back()->with('error','Tidak Bisa Update Tanggal , Kunjungan Telah Selesai Dilakukan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
