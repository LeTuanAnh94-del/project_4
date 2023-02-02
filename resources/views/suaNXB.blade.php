@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Nhà Xuất Bản: @php echo($NXB->nha_xuat_ban); @endphp </h5>
        </nav>
    </div>
</nav>
@if ($NXB != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <div class="form-group">
                            <b> Mã </b>
                            <input class="form-control" type="text" id="example-text-input" name="ma_NXB" value="{{$NXB->ma_NXB}}" readonly>
                            <p></p>
                        </div>
                        <div class="form-group">
                            <b> Nhà Xuất Bản </b>
                                <input class="form-control" type="text" id="example-search-input" name="nha_xuat_ban" value="{{$NXB->nha_xuat_ban}}">
                                <p></p>
                        </div>
                        <div class="form-group">
                            <b> Địa Chỉ </b>
                            <input class="form-control" type="text" name="dia_chi" id="example-url-input" value="{{$NXB->dia_chi}}">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <b> Điện Thoại </b>
                            <input class="form-control" type="tel" name="lien_he" id="example-tel-input" value="{{$NXB->lien_he}}">
                            <p></p>
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
