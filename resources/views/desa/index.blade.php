@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <div class="block">
            <div class="p-3 block-header-default">
                <div class="row">
                    <div class="col-6">
                        <h3 class="block-title">Master Desa</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('desa.create')}}" class="btn btn-success">Tambahkan Desa</a>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th>Nama Desa</th>
                            <th class="d-none d-sm-table-cell">Latitude</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Longitude</th>
                            <th class="text-center" style="width: 15%;">Radius (KM)</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                            foreach ($listDesa as $key) {
                        ?>
                            <tr>
                                <td class="text-center">{{($i++)}}</td>
                                <td class="font-w600">{{$key->nama_desa}}</td>
                                <td class="d-none d-sm-table-cell">{{$key->latitude}}</td>
                                <td class="d-none d-sm-table-cell">{{$key->longitude}}</td>
                                <td class="text-center">{{$key->radius}}</td>
                                <td class="text-center">
                                    <a href="{{route('desa.edit' , $key->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form method="post" action="{{route('desa.destroy',$key->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger show_confirm_delete" data-toggle="tooltip" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>                                    
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection