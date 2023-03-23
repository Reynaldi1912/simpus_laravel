<style>
    .alertNotify{
        display: inline-block; 
        position: fixed; 
        -webkit-animation: cssAnimation 5s forwards; 
        animation: cssAnimation 5s forwards;
        z-index: 1033; 
        right: 10px; 
        bottom : 0;
        animation-iteration-count: 1;
    }
</style>
@if ($message = Session::get('success'))
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-success animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif


@if ($message = Session::get('error'))
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-danger animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif


@if ($message = Session::get('warning'))
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-warning animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif


@if ($message = Session::get('info'))
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-info animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif


@if ($errors->any())
<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-danger animated fadeIn alertNotify" 
    role="alert" data-notify-position="bottom-left" id="alertNotify">
    <span data-notify="title"></span> <span data-notify="message">{{$message}}</span><a href="#" target="_blank" data-notify="url"></a></div>
@endif

<script>
    setTimeout(function () {
        if(document.getElementById('alertNotify')){
            document.getElementById('alertNotify').style.display = 'none'
        }
    }, 5000)
</script>