<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;

class DesaController extends Controller
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
        $listDesa = Desa::all();
        return view('desa.index' , ['listDesa'=> $listDesa ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desa.create');
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
            'txtNamaDesa'     => 'required',
            'txtLatitude'     => 'required',
            'txtLongitude'   => 'required',
            'txtRadius'   => 'required'
        ]);

        //create post
        Desa::create([
            'nama_desa'     => $request->txtNamaDesa,
            'latitude'     => $request->txtLatitude,
            'longitude'   => $request->txtLongitude,
            'radius'   => $request->txtRadius
        ]);

        //redirect to index
        return redirect()->route('desa.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
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
        $desa = desa::all()->where('id',$id)->first();
        // echo json_encode($desa);
        return view('desa.edit' , ['key'=>$desa]);
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
        $this->validate($request, [
            'txtNamaDesa'     => 'required',
            'txtLatitude'     => 'required',
            'txtLongitude'   => 'required',
            'txtRadius'   => 'required'
        ]);

        $desa = Desa::all()->where('id',$id)->first();
        $desa->update([
            'nama_desa'     => $request->txtNamaDesa,
            'latitude'     => $request->txtLatitude,
            'longitude'   => $request->txtLongitude,
            'radius'   => $request->txtRadius
        ]);
        return redirect()->route('desa.index')->with(['success' => 'Data Berhasil Dirubah!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo json_encode(User::all()->where('id_desa',$id)->count() > 0 ? "ada" : "tidak ada");die();
        if(User::all()->where('id_desa',$id)->count() <= 0){
            //delete
            Desa::where('id', $id)->delete();

            //redirect to index
            return redirect()->route('desa.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            return redirect()->route('desa.index')->with(['error' => 'Gagal , Desa masih digunakan oleh petugas!']);
        }
    }
}
