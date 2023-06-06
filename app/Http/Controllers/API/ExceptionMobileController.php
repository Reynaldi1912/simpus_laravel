<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exception;
use App\Models\Jadwal;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ExceptionMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        Carbon::setLocale('id');
        $getJadwal = Jadwal::all()->where('tanggal_mulai',$request->tanggal)->where('id_desa',$request->id_desa)->first();

        $inputDate = Carbon::createFromFormat('Y-m-d', $request->tanggal);        
        // Mengubah format tanggal menjadi 'j F Y' (misalnya, '6 Oktober 2023')
        $outputDate = $inputDate->isoFormat('D MMMM');
        
        if($getJadwal != null){
            $cekException = Exception::all()->where('tanggal_jadwal',$request->tanggal)->where('id_user',$request->id);
            if($cekException->isNotEmpty()){
                return response()->json([
                    'message' => 'Exception Tanggal '.$outputDate.' Anda Sudah Diajukan',
                    'isError' => false,
                ], 200);
            }else{
                Exception::create([
                    'id_user' => $request->id,
                    'alasan' => $request->alasan,
                    'status_appr' => 0,
                    'tanggal_jadwal' => $request->tanggal
                ]);
                return response()->json([
                    'message' => 'Data berhasil disimpan',
                    'isError' => true,
                ], 200);
            }
        }else{
            return response()->json([
                'message' => 'Anda Tidak Ada Jadwal Pada Tanggal '.$outputDate,
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
        $exceptions = DB::table('exception')
            ->where('id_user', $id)
            ->select('exception.id','exception.id_user', 'exception.alasan','status_appr', DB::raw("DATE_FORMAT(tanggal_jadwal, '%d %M %Y') as tanggal_mulai"), DB::raw("DATE_FORMAT(exception.created_at, '%d %M %Y') as created_at"))
            ->get();
    
        return response()->json($exceptions);
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
        $data = Exception::find($id);
        $data->delete();
    }
}
