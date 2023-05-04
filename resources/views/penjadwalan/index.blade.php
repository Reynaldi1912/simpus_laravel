@extends('layouts.app')

@section('content')

<main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <!-- Calendar and Events functionality is initialized in js/pages/be_comp_calendar.min.js which was auto compiled from _es6/pages/be_comp_calendar.js -->
            <!-- For more info and examples you can check out https://fullcalendar.io/ -->
            <div class="block">
                <div class="block-content">
                    <div class="row items-push">
                        <div class="col-xl-9">
                            <!-- Calendar Container -->
                            <div id="calendar"></div>
                        </div>
                        <div class="col-xl-3 d-xl-block">
                            <!-- Add Event Form -->
                            <select class="form-control mb-3" name="txtUpayaKesehatan" onchange="filteredDesa();" id="filteredDesa" required>
                                @foreach($desa as $ex)
                                    <option value="{{$ex->nama_desa}}">{{$ex->nama_desa}}</option>
                                @endforeach
                            </select>                            
                            <br>
                            <h6>Tambah By Excel</h6>
                            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#importExcel">Import Excel</button>
                            <br><hr>
                            <h6>Tambah Jadwal</h6>
                            <form action="{{route('penjadwalan.store')}}" method="post">
                                @csrf
                                <textarea type="text" class="form-control mb-3" name="txtUpayaKesehatan" placeholder="Upaya Kesehatan" required></textarea>
                                <textarea type="text" class="form-control mb-3" name="txtkegiatan" placeholder="Kegiatan" required></textarea>
                                <input type="date" class="form-control mb-3" name="txtTanggalPelaksanaan" placeholder="Tanggal Pelaksanaan" required>
                                <textarea type="text" class="form-control mb-3" name="txtRincianPelaksanaan" placeholder="Rincian Pelaksanaan" required></textarea>
                                <input type="number" class="form-control mb-3" name="txtJumlahSasaran" placeholder="Jumlah Sasaran" required>
                                <label for="" class="mt-5">Penugasan</label>
                                <select class="form-control mb-3" name="slctDesa" onchange="userOption()" id="slctPenugasan" required>
                                    <option value="0">Pilih Desa</option>
                                    @foreach($desa as $key)
                                        <option value="{{$key->id}}">{{$key->nama_desa}}</option>
                                    @endforeach
                                </select>
                                <label for="" class="mt-5">Pelaksana 1</label>
                                <select class="form-control mb-3" name="slctPelaksana1" id="slctPelaksana1" required>
                                </select>
                                <label for="" class="mt-5">Pelaksana 2</label>
                                <select class="form-control mb-3" name="slctPelaksana2" id="slctPelaksana2" required>
                                </select>
                                <button type="submit" class="btn btn-success btn-block">Tambahkan Jadwal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Calendar -->
        </div>
        <!-- END Page Content -->
    </main>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="modal-fadein" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('uploadJadwal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Import Excel</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col">
                                    <span class="text-danger">*</span> import sesuai template
                                </div>
                                <div class="col-5 text-right">
                                    <a href="/formatImport.xlsx" class="btn btn-success">Template Import <i class="fa fa-file-excel-o"></i></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" name="excel" data-toggle="custom-file-input">
                                        <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block" id="uploadFile">Import Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pr-5" id="eventModalDesa"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body" id="modalBody">
                    <div class="row">
                        <div class="col">
                            <form method="post" id="formDelete">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger show_confirm_delete" data-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i> <span>Hapus Jadwal Ini </span>
                                </button>                                    
                            </form> 
                        </div>
                        <div class="col">
                            <div class="float-right">
                                <label class="css-control css-control-sm css-control-primary css-switch">
                                    <input type="checkbox" class="css-control-input" onchange="toggleTable()" id="detailChecklist">
                                    <span class="css-control-indicator"></span> Edit Jadwal
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    
                    <table class="table" id="tampilDetail">
                        <thead>
                            <tr>
                                <th scope="col">Label</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Upaya Kesehatan</th>
                                <td id="eventModalUpaya"></td>
                            </tr>
                            <tr>
                                <th scope="row">Kegiatan</th>
                                <td id="eventModalKegiatan"></td>
                            </tr>
                            <tr>
                                <th scope="row">Rincian Pelaksanaan</th>
                                <td id="eventModalRincian"></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Pelaksana 1</th>
                                <td id="eventModalPelaksana1"></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Pelaksana 2</th>
                                <td id="eventModalPelaksana2"></td>
                            </tr>
                        </tbody>
                    </table>
                    <form id="formEdit" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table" id="tampilEdit">
                            <thead>
                                <tr>
                                    <th scope="col">Label</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Upaya Kesehatan</th>
                                    <td>
                                        <input type="text" class="form-control" id="txtModalUpaya" name="txtModalUpaya">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Kegiatan</th>
                                    <td>
                                        <input type="text" class="form-control" id="txtModalKegiatan" name="txtModalKegiatan">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Pelaksanaan</th>
                                    <td>
                                    <input type="date" class="form-control" id="txtModalTanggal" name="txtModalTanggal">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Rincian Pelaksanaan</th>
                                    <td>
                                        <input type="text" class="form-control" id="txtModalRincian" name="txtModalRincian">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Pelaksana 1</th>
                                    <td>
                                        <select class="form-control mb-3" name="slctPelaksana1" id="slctPelaksanaDetail1" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama Pelaksana 2</th>
                                    <td>
                                        <select class="form-control mb-3" name="slctPelaksana2" id="slctPelaksanaDetail2" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                               
                        <button class="btn btn-warning btn-block" id="btn-update">Simpan Perubahan</button>
                    </form>            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $( document ).ready(function() {
            filteredDesa();
            document.getElementById("tampilEdit").style.display = "none";
            document.getElementById("btn-update").style.display = "none";
        });

        function userOption(){
            let id = document.getElementById("slctPenugasan").value;
            let option1 = document.getElementById("slctPelaksana1");
            let option2 = document.getElementById("slctPelaksana2");
            option1.innerHTML = '';
            option2.innerHTML = '';
            if (option1 !== null && option2 !== null) { // tambahkan kondisi ini untuk mengecek keberadaan elemen HTML
                option1.innerHTML = ''; // tambahkan baris ini untuk menghapus opsi-opsi sebelum menambahkan yang baru
                fetch('{{route('getUserByIdDesa','')}}'+'/'+id)
                    .then(res => res.json())
                    .then((out) => {
                        option2.innerHTML += "<option value='null'></option>";

                        for (const key in out) {
                            if (Object.hasOwnProperty.call(out, key)) {
                                const data = out[key];
                                option1.innerHTML += "<option value='"+data.nama_lengkap+"'>"+data.nama_lengkap+"</option>";
                                option2.innerHTML += "<option value='"+data.nama_lengkap+"'>"+data.nama_lengkap+"</option>";
                            }
                        }
                    })
                    .catch(err => console.error(err));
            }
        }

        function userOptionDetail(nama_desa){
            let option1 = document.getElementById("slctPelaksanaDetail1");
            let option2 = document.getElementById("slctPelaksanaDetail2");

            option1.innerHTML = '';
            option2.innerHTML = '';
            if (option1 !== null && option2 !== null) { // tambahkan kondisi ini untuk mengecek keberadaan elemen HTML
                option1.innerHTML = ''; // tambahkan baris ini untuk menghapus opsi-opsi sebelum menambahkan yang baru
                fetch('{{route('getUserByNamaDesa','')}}'+'/'+nama_desa)
                    .then(res => res.json())
                    .then((out) => {
                        option2.innerHTML += "<option value='null'></option>";
                        for (const key in out) {
                            if (Object.hasOwnProperty.call(out, key)) {
                                const data = out[key];
                                option1.innerHTML += "<option value='"+data.nama_lengkap+"'>"+data.nama_lengkap+"</option>";
                                option2.innerHTML += "<option value='"+data.nama_lengkap+"'>"+data.nama_lengkap+"</option>";
                            }
                        }
                    })
                    .catch(err => console.error(err));
            }
        }
        function toggleTable() {
            var checkbox = document.getElementById("detailChecklist");
            var detailTable = document.getElementById("tampilDetail");
            var editTable = document.getElementById("tampilEdit");
            var btnUpdate = document.getElementById("btn-update");
            if (checkbox.checked != true) {
                detailTable.style.display = "table";
                editTable.style.display = "none";
                btnUpdate.style.display = "none";
            } else {
                detailTable.style.display = "none";
                editTable.style.display = "table";
                btnUpdate.style.display = "block";
                userOptionDetail(document.getElementById('filteredDesa').value);
            }
        }

        function filteredDesa(){
            fetch('/get-jadwal-by-desa')
                .then(response => response.json())
                .then(data => {
                    var eventsData = data.data;
                    let filteredData = data.data.filter(event => event.nama_desa === document.getElementById('filteredDesa').value);
                    var calendarEl = document.getElementById('calendar');

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth'
                        },
                        events: eventsData,
                        eventTextColor: 'white',
                        eventClick: function(info) {
                            document.getElementById('eventModalUpaya').textContent = info.event.title;
                            document.getElementById('eventModalKegiatan').textContent = info.event.extendedProps.kegiatan;
                            document.getElementById('eventModalRincian').textContent = info.event.extendedProps.rincian_pelaksanaan;
                            document.getElementById('eventModalDesa').textContent = "Detail Jadwal "+info.event.extendedProps.nama_desa+" ("+moment(info.event.start).format('DD MMMM YYYY')+")";
                            document.getElementById('eventModalPelaksana1').textContent = info.event.extendedProps.nama_pelaksana1;
                            document.getElementById('eventModalPelaksana2').textContent = info.event.extendedProps.nama_pelaksana2;
                            const url = "{{route('penjadwalan.destroy',':id')}}".replace(':id',info.event.id);
                            document.getElementById("formDelete").setAttribute("action", url);

                            document.getElementById('txtModalUpaya').value = info.event.title;
                            document.getElementById('txtModalTanggal').value = moment(info.event.start).format('YYYY-MM-DD');
                            document.getElementById('txtModalKegiatan').value = info.event.extendedProps.kegiatan;
                            document.getElementById('txtModalRincian').value = info.event.extendedProps.rincian_pelaksanaan;
                            // document.getElementById('txtModalDesa').value = info.event.extendedProps.nama_desa;
                            // document.getElementById('txtModalPelaksana1').value = info.event.extendedProps.nama_pelaksana1;
                            // document.getElementById('txtModalPelaksana2').textContent = info.event.extendedProps.nama_pelaksana2;
                            const url2 = "{{route('penjadwalan.update',':id')}}".replace(':id',info.event.id);
                            document.getElementById("formEdit").setAttribute("action", url2);
                            $('#eventModal').modal('show');
                        }
                    });
                calendar.getEvents().forEach(event => event.remove());
                calendar.addEventSource(filteredData);
                calendar.render();
            })
        }

    </script>
@endsection