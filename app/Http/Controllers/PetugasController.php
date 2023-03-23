<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Desa;
use App\Models\User;

class PetugasController extends Controller
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
        $listUser = DB::table('vw_petugas')->get();
        return view('petugas.index' , ['listUser'=>$listUser]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $desa = Desa::all();
        return view('petugas.create' , ['desa'=>$desa]);
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
            'txtRole'     => 'required',
            'txtUsername'     => 'required',
            'txtEmail'   => 'required',
            'txtNamaLengkap'   => 'required',
            'slctDesa'   => 'required'
        ]);

        //create post
        User::create([
            'role'     => $request->txtRole,
            'id'     => $request->txtUsername,
            'email'   => $request->txtEmail,
            'nama_lengkap'   => $request->txtNamaLengkap,
            'id_desa'   => $request->slctDesa,
            'password' => Hash::make($request->txtUsername)
        ]);

        return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Ditambahkan!']);

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
        $desa = desa::all();
        $users = User::all()->where('id',$id)->first();
        return view('petugas.edit' , ['key'=>$users , 'desa'=>$desa]);
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
            'txtRole'     => 'required',
            'txtUsername'     => 'required',
            'txtEmail'   => 'required',
            'txtNamaLengkap'   => 'required',
            'slctDesa'   => 'required'
        ]);

        $user = User::all()->where('id',$id)->first();
        $user->update([
            'role'     => $request->txtRole,
            'id'     => $request->txtUsername,
            'email'   => $request->txtEmail,
            'nama_lengkap'   => $request->txtNamaLengkap,
            'id_desa'   => $request->slctDesa
        ]);
        return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Dirubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete
         User::where('id', $id)->delete();

         //redirect to index
         return redirect()->route('petugas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
