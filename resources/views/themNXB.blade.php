@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Nhà Xuất Bản </h5>
        </nav>
        <div style="margin-top: 3vh; margin-left:5vh;">
            <a href="{{url('/import-form-nhaxuatban')}}" style="color: white">
                <button class="btn btn-primary" type="button"> File </button>
            </a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 1.5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <div class="form-group">
                            <b> Tên Nhà Xuất Bản </b>
                            <input class="form-control" type="text" id="example-search-input" name="nha_xuat_ban">
                            <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('nha_xuat_ban') }} </i></p>
                        </div>
                        <div class="form-group">
                            <b> Địa Chỉ </b>
                            <input class="form-control" type="text" name="dia_chi" id="example-url-input">
                            <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('dia_chi') }} </i></p>
                        </div>
                        <div class="form-group">
                            <b> Liên Hệ </b>
                            <input class="form-control" type="text" name="lien_he" id="example-tel-input">
                            <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('lien_he') }} </i></p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"> Thêm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection