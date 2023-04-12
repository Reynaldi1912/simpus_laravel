<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Exception;
use App\Models\Jadwal;


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
        $history = DB::table('history_exception')->get();
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
        if($status == 0){
            //approve
            $penjadwalan = Jadwal::all()->where('id',$request->id_jadwal)->first();
            if($penjadwalan->status != 1){
                $penjadwalan->update([
                    'tanggal_mulai' => $request->tanggal
                ]);

                $exception = Exception::all()->where('id',$request->id_exception)->first();
                $exception->update([
                    'status_appr' => 1
                ]);
                return back()->with('warning','Berhasil , Exception Berhasil Di Approve');
            }else{
                return back()->with('error','Tidak Bisa Update Tanggal , Kunjungan Telah Selesai Dilakukan');
            }
        }elseif($status == 1){
            return back()->with('warning','Exception Berhasil Ditolak');
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
