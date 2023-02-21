<?php

namespace App\Http\Controllers;

use App\Models\data_diri;
use Illuminate\Http\Request;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_diri = data_diri::all();
        return response()->json([
            'data'=> $data_diri
        ]);
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
        $data_diri = data_diri::create([
            'name' => $request->name,
            'job' => $request->job
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data_diri  $data_diri
     * @return \Illuminate\Http\Response
     */
    public function show(data_diri $data_diri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\data_diri  $data_diri
     * @return \Illuminate\Http\Response
     */
    public function edit(data_diri $data_diri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data_diri  $data_diri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, data_diri $data_diri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data_diri  $data_diri
     * @return \Illuminate\Http\Response
     */
    public function destroy(data_diri $data_diri)
    {
        //
    }
}
