<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exception;
use App\Models\Jadwal;
use App\Models\User;
use DB;
class ExceptionMobileController extends Controller
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
        $getJadwal = Jadwal::all()->where('tanggal_mulai',$request->tanggal)->where('id_desa',$request->id_desa)->first();

        if($getJadwal != null){
            $cekException = Exception::all()->where('id_jadwal',$getJadwal->id)->where('id_user',$request->id);
            if($cekException->isNotEmpty()){
                return response()->json([
                    'message' => 'Exception Tanggal '.$request->tanggal.' Anda Sudah Diajukan',
                ], 200);
            }else{
                Exception::create([
                    'id_jadwal' => $getJadwal->id,
                    'id_user' => $request->id,
                    'exception_status' => $request->status,
                    'alasan' => $request->alasan,
                    'status_appr' => 0,
                ]);
                return response()->json([
                    'message' => 'Data berhasil disimpan',
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'Anda Tidak Ada Jadwal Pada Tanggal '.$request->tanggal,
            ], 200);
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
