@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <div class="p-3 block-header-default">
                <div class="row">
                    <div class="col-12">
                        <h3 class="block-title">Form Tambah Petugas</h3>
                    </div>
                </div>
            </div>
            <form action="{{route('petugas.update' , $key->id)}}" class="block p-5" method="post">
                @csrf
                @method('PUT')
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-12 pb-3">
                            <label for="">Role</label>
                            <input type="text" name="txtRole" value="petugas" class="form-control" readonly required>
                        </div>
                        <div class="col-12 pb-3">
                            <label for="">Username</label>
                            <input type="text" name="txtUsername" class="form-control" value="{{$key->id}}" required>
                        </div>
                        <div class="col-12 pb-3">
                            <label for="">Email</label>
                            <input type="text" name="txtEmail" class="form-control" value="{{$key->email}}" required>
                        </div>
                        <div class="col-12 pb-3">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="txtNamaLengkap" class="form-control" value="{{$key->nama_lengkap}}" required>
                        </div>
                        <div class="col-12 pb-3">
                            <label for="">Desa Penugasan</label>
                            <select class="form-control" name="slctDesa"  required>
                                @foreach($desa as $key)
                                    <option value="{{$key->id}}">{{$key->nama_desa}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 pb-3">
                            <button type="submit" class="btn btn-success btn-block show_confirm_simpan" data-toggle="tooltip">Simpan</button>
                        </div>
                    </div>     
                </div>
            </form>
        </div>
    </div>
</div>
@endsection