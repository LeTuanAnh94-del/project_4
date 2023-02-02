@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Chuyên ngành: @php echo($CN->chuyen_nganh); @endphp </h5>
        </nav>
    </div>
</nav>
@if ($CN != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Mã Chuyên Ngành </b>
                                <input style="width: 250px;" type="text" class="form-control" id="ma_CN" name="ma_CN" value="{{$CN->ma_CN}}" readonly>
                                <p></p>
                            </div>
                            <div class="col">
                                <b> Chuyên Ngành </b>
                                <input style="width: 700px;" type="text" class="form-control" id="chuyen_nganh" name="chuyen_nganh" value="{{$CN->chuyen_nganh}}">
                                <p></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"> Cập Nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<h1>Không có dữ liệu</h1>
@endif
@endsection
