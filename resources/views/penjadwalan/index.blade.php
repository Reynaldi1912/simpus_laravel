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
                                <option value="Krasak">Krasak</option>
                                <option value="Pandansari">Pandansari</option>
                            </select>                            
                            <br>
                            <h6>Tambah By Excel</h6>
                            <button class="btn btn-success btn-block">Import Excel</button>
                            <br><hr>
                            <h6>Tambah Jadwal</h6>
                            <form action="{{route('penjadwalan.store')}}" method="post">
                                @csrf
                                <input type="text" class="form-control mb-3" name="txtUpayaKesehatan" placeholder="Upaya Kesehatan" required>
                                <textarea type="text" class="form-control mb-3" name="txtkegiatan" placeholder="Kegiatan" required></textarea>
                                <input type="date" class="form-control mb-3" name="txtTanggalPelaksanaan" placeholder="Tanggal Pelaksanaan" required>
                                <input type="text" class="form-control mb-3" name="txtRincianPelaksanaan" placeholder="Rincian Pelaksanaan" required>
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


    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Detail Jadwal </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody">
                    <table class="table">
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
                                <th scope="row">Tanggal Pelaksanaan</th>
                                <td id="eventModalTanggal"></td>
                            </tr>
                            <tr>
                                <th scope="row">Rincian Pelaksanaan</th>
                                <td id="eventModalRincian"></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Desa</th>
                                <td id="eventModalDesa"></td>
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
                    <button class="btn btn-warning btn-block">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $( document ).ready(function() {
            filteredDesa();
        });

        function userOption(){
            let id = document.getElementById("slctPenugasan").value;
            let option1 = document.getElementById("slctPelaksana1");
            let option2 = document.getElementById("slctPelaksana2");
            option1.forEach(o => o.remove());
            option2.forEach(o => o.remove());
            if (option1 !== null && option2 !== null) { // tambahkan kondisi ini untuk mengecek keberadaan elemen HTML
                option1.innerHTML = ''; // tambahkan baris ini untuk menghapus opsi-opsi sebelum menambahkan yang baru
                fetch('{{route('getUserByIdDesa','')}}'+'/'+id)
                    .then(res => res.json())
                    .then((out) => {
                        out.forEach((data)=>{
                            option1.innerHTML += "<option value="+data.nama_lengkap+">"+data.nama_lengkap+"</option>";
                            option2.innerHTML += "<option value="+data.nama_lengkap+">"+data.nama_lengkap+"</option>";
                        });
                    })
                    .catch(err => console.error(err));
            }
        }

        function filteredDesa(){
            fetch('/getJadwalByDesa')
                .then(response => response.json())
                .then(data => {
                    var eventsData = data.data;
                    let filteredData = data.data.filter(event => event.nama_desa === document.getElementById('filteredDesa').value);
                    console.log(filteredData);

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
                            document.getElementById('eventModalTanggal').textContent = moment(info.event.start).format('DD MMMM YYYY');
                            document.getElementById('eventModalRincian').textContent = info.event.extendedProps.rincian_pelaksanaan;
                            document.getElementById('eventModalDesa').textContent = info.event.extendedProps.nama_desa;
                            document.getElementById('eventModalPelaksana1').textContent = info.event.extendedProps.nama_pelaksana1;
                            document.getElementById('eventModalPelaksana2').textContent = info.event.extendedProps.nama_pelaksana2;

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