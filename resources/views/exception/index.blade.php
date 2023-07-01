@extends('layouts.app')

@section('content')
<style>
    li.chat-list-item.approval-item.active {
    color: white;
    background-color: #67ddef;
}
li.chat-list-item.history-item.active {
    color: white;
    background-color: #67ddef;
}
</style>
<main id="main-container">
    <!-- Page Content -->
    <div class="js-chat-container row no-gutters content content-full">
        <!-- Left Column -->
        <div class="js-chat-options d-none d-md-block col-md-6 col-lg-4 bg-white border-right">
            <!-- Chat Tabs -->
            <div class="block block-transparent mb-0">
                <ul class="js-chat-tabs nav nav-tabs nav-tabs-alt nav-justified px-15" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#chat-tabs-chats">
                            Belum Approval
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#chat-tabs-calls">
                            History
                        </a>
                    </li>
                </ul>
                <div class="js-chat-tabs-content block-content tab-content p-0">
                    <!-- Chats -->
                    <div class="tab-pane active p-15" id="chat-tabs-chats" role="tabpanel" data-simplebar>
                        <!-- Favorites -->
                        <div class="push">
                            <ul class="chat-list">
                                <!-- Belum Approval -->
                                @foreach($data as $key)
                                <li class="chat-list-item approval-item" data-key="{{$key->id}}">
                                    <div class="mr-10">
                                        <span class="img-link img-status">
                                            <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg" alt="">
                                        </span>
                                    </div>
                                    <div>
                                        <span class="">{{date('d M Y',strtotime($key->created_at))}}</span><br>
                                        <span class="font-w600" >{{$key->nama_lengkap}} <span class="font-size-xs">( {{$key->nama_desa}} )</span></span>
                                        <div class="font-size-xs">
                                            {{$key->alasan}}
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- END Chats -->

                    <!-- History -->
                    <div class="tab-pane p-15" id="chat-tabs-calls" role="tabpanel" data-simplebar>
                        <ul class="chat-list">
                            @foreach($history as $key)
                                <li class="chat-list-item history-item" data-key="{{$key->id}}">
                                    <div class="mr-10">
                                        <span class="img-link img-status">
                                            <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg" alt="">
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-muted">{{date('d M Y',strtotime($key->created_at))}}</span><br>
                                        <span class="font-w600 border-bottom pb-1">{{$key->nama_lengkap}}  <span class="text-muted font-size-xs">({{$key->status_appr = 1? 'Disetujui' : 'Ditolak'}})</span></span>
                                        <p class="font-w600 pt-2">{{$key->kegiatan}}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END History -->
                </div>
            </div>
            <!-- END Chat Tabs -->
            <!-- Separator (visible on mobile) -->
            <div class="d-md-none py-5 bg-body-dark"></div>
        </div>
        <!-- END Left Column -->

        <!-- Right Column -->
        <!-- Clicked Content -->
        <div class="col-md-6 col-lg-8 bg-white" id="fullContent">
        </div>

        <!-- exception content -->
            <div class="col-md-6 col-lg-8 bg-white" id="content" style="display:none;">
                <!-- Active Chat User -->
                <div class="js-chat-active-user p-15 d-flex align-items-center justify-content-between bg-white">
                    <div class="d-flex align-items-center">
                        <a class="img-link img-status" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg" alt="Avatar">
                        </a>
                        <div class="ml-10">
                            <a class="font-w600" href="javascript:void(0)" id="nama"></a>
                            <div class="font-size-sm text-muted" id="desa"></div>
                        </div>
                    </div>
                    <div class="ml-10">
                        <span class="text-muted">Diajukan Pada <span id="exception_date"></span></span>
                        <button type="button" class="d-md-none btn btn-sm btn-circle btn-alt-success ml-5" data-toggle="class-toggle" data-target=".js-chat-options" data-class="d-none">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
                <!-- END Active Chat User -->

                <!-- Chat Window -->
                <div class="js-chat-window p-15 bg-light flex-grow-1 text-wrap-break-word overflow-y-auto">
                    <!-- User Message -->
                    <div class="container-fluid bg-white p-5">
                        <div class="m-5">
                            <div class="row pl-5">
                                <div class="col">
                                    <p><b>Detail Exception</b> ( <span class="text-muted">Kegiatan Pada Tanggal : <span id="tanggal_kegiatan"></span></span>)</p>
                                </div>
                                <div class="col-3 text-right">
                                    <p class="text-mute">kunjungan</p>
                                </div>
                            </div>
                            <div class="row m-5">
                                <table cellpadding='7'>
                                    <tbody>
                                        <tr>
                                            <td>Upaya Kesehatan</td>
                                            <td>:</td>
                                            <td id="upaya_kesehatan"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Alasan</b></td>
                                            <td>:</td>
                                            <td><b id="alasan"></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="row m-5">
                                <form action="{{route('exception.store')}}" method="post">
                                    @csrf
                                    <div class="col">
                                        <h5>FORM APPROVAL</h5>
                                        <input type="hidden" id="id_exception" name="id_exception">
                                        <input type="hidden" id="tanggal_kegiatan_inp" name="tanggal_kegiatan">
                                        <input type="hidden" id="username" name="username">
                                        <input type="hidden" id="id_desa" name="id_desa">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="css-control css-control-lg css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="status" value="0" onchange="checkedFunc();" checked>
                                                    <span class="css-control-indicator"></span> Approve
                                                </label>
                                                <label class="css-control css-control-lg css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="status" value="1" onchange="checkedFunc();">
                                                    <span class="css-control-indicator"></span> Tolak
                                                </label>
                                            </div>
                                            <div class="col" id="txtInput">
                                                <div class="form-group row">
                                                    <div class="col-lg-12">
                                                        <textarea class="js-maxlength form-control" id="example-maxlength10" name="keterangan"  rows="10"  placeholder="Alasan Penolakan" maxlength="200" data-always-show="true"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col" id="txtCalendar">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-8">
                                                        <input type="text" class="js-flatpickr form-control" id="example-flatpickr-inline" name="tanggal" data-inline="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-block btn-submit btn-success" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- END Chat Input -->
            </div>
            <!-- end of exception content -->

            <!-- history content -->
            <div class="col-md-6 col-lg-8 bg-white" id="content-history" style="display:none;">
                <!-- Active Chat User -->
                <div class="js-chat-active-user p-15 d-flex align-items-center justify-content-between bg-white">
                    <div class="d-flex align-items-center">
                        <a class="img-link img-status" href="javascript:void(0)">
                            <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg" alt="Avatar">
                        </a>
                        <div class="ml-10">
                            <a class="font-w600" href="javascript:void(0)" id="nama_history"></a>
                            <div class="font-size-sm text-muted" id="desa_history"></div>
                        </div>
                    </div>
                </div>
                <!-- END Active Chat User -->

                <!-- Chat Window -->
                <div class="js-chat-window p-15 bg-light flex-grow-1 text-wrap-break-word overflow-y-auto">
                    <!-- User Message -->
                    <div class="container-fluid bg-white p-5">
                        <div class="m-5">
                            <div class="row m-5">
                                <table cellpadding='7'>
                                    <tbody>
                                        <tr>
                                            <td><b>Kegiatan</b></td>
                                            <td>:</td>
                                            <td><b id="kegiatan"></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status Approval</b></td>
                                            <td>:</td>
                                            <td><b id="status_appr"></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Kegiatan (Lama)</b></td>
                                            <td>:</td>
                                            <td><b id="old_date"></b></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tanggal Kegiatan (Baru)</b></td>
                                            <td>:</td>
                                            <td><b id="new_date"></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- END Chat Input -->
            </div>
            <!-- end of history content -->
        <!-- END Right Column -->
    </div>
    <!-- END Page Content -->

</main>

<script>
    // mendapatkan semua elemen <li> dengan class "chat-list-item"
    const _chatItems = document.querySelectorAll('.approval-item');
    const _historyItems = document.querySelectorAll('.history-item');

    // menambahkan event listener ke setiap elemen <li>
    _chatItems.forEach(function(chatItem) {
        chatItem.addEventListener('click', function() {
            // menghapus kelas "active" dari semua elemen <li>
            _chatItems.forEach(function(item) {
                item.classList.remove('active');
            });
            
            // menambahkan kelas "active" ke elemen yang diklik
            chatItem.classList.add('active');
        });
    });

    // menambahkan event listener ke setiap elemen <li>
    _historyItems.forEach(function(chatItem) {
        chatItem.addEventListener('click', function() {
            // menghapus kelas "active" dari semua elemen <li>
            _historyItems.forEach(function(item) {
                item.classList.remove('active');
            });
            
            // menambahkan kelas "active" ke elemen yang diklik
            chatItem.classList.add('active');
        });
    });
    checkedFunc();

    // menambahkan event listener ke setiap elemen <li>
    _chatItems.forEach(function(chatItem) {
        chatItem.addEventListener('click', function() {
            // panggil fungsi getCurrentContent() dengan argumen dari data-key
            const key = chatItem.getAttribute('data-key');
            document.getElementById("content").style.display = "block";
            document.getElementById("fullContent").style.display = "none";
            getCurrentContents(key);
        });
    });
    _historyItems.forEach(function(chatItem) {
        chatItem.addEventListener('click', function() {
            // panggil fungsi getCurrentContent() dengan argumen dari data-key
            const key = chatItem.getAttribute('data-key');
            document.getElementById("content-history").style.display = "block";
            document.getElementById("fullContent").style.display = "none";
            getCurrentContentHistory(key);
        });
    });

    function getCurrentContentHistory(key){
        fetch('/get-detail-history-exception/'+key)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // document.getElementById('id_desa').value = data.id_desa;
                // document.getElementById('username').value = data.username;
                document.getElementById('status_appr').textContent = data.status_appr = 1 ? "DISETUJUI" : "DITOLAK" ;
                document.getElementById('old_date').textContent =  moment(data.old_date).format('DD-MM-YYYY');
                document.getElementById('new_date').textContent =  moment(data.new_date).format('DD-MM-YYYY');
                document.getElementById('kegiatan').textContent = data.kegiatan;
                // document.getElementById('alasan').textContent = data.alasan;
                document.getElementById('desa_history').textContent = data.nama_desa;
                document.getElementById('nama_history').textContent = data.nama_lengkap;
                // document.getElementById('exception_date').textContent = moment(data.created_at).format('DD-MM-YYYY');
            });
    }
    function checkedFunc(){
        value = $("input[name=status]:checked").val();
        txtInput = $("#txtInput");
        txtCalendar = $("#txtCalendar");
        if(value == 0){
            txtCalendar.show();
            txtInput.hide();
        }else{
            txtCalendar.hide();
            txtInput.show();
        }
    }
</script>
@endsection