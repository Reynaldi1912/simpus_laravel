@extends('layouts.app')

@section('content')
<div class="container m-3">
    <div class="main-container">
        <div class="content">
            <div class="block">
            <div class="p-3 block-header-default">
                <div class="row">
                    <div class="col-6">
                        <h3 class="block-title">Master Petugas</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{route('petugas.create')}}" class="btn btn-success">Tambahkan Petugas</a>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">username</th>
                            <th class="text-center">Email</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">nama lengkap</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">nama desa</th>
                            <th class="text-center" style="width: 15%;">Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                    @foreach($listUser as $key)
                        <tr>
                            <td class="text-center">{{($i++)}}</td>
                            <td class="font-w600 text-center">{{$key->id}}</td>
                            <td class="text-center">{{$key->email}}</td>
                            <td class="d-none d-sm-table-cell text-center">
                                {{$key->nama_lengkap}}
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                {{$key->nama_desa}}
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="View Customer">
                                    <i class="fa fa-user"></i>
                                </button>
                                <a href="{{route('petugas.edit' , $key->id)}}" type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="View Customer">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form method="post" action="{{route('petugas.destroy',$key->id)}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger show_confirm_delete" data-toggle="tooltip" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>                                    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection