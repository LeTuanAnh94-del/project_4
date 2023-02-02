@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 4vh;">
            <h5 class="font-weight-bolder mb-0"> Tác Giả: @php echo($tacgia->ho_ten); @endphp </h5>
        </nav>
    </div>
</nav>
@if ($tacgia != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <!-- <div class="form-group">
        <b> Mã Tác Giả </b>
        <input class="form-control" type="text" id="example-text-input" name="ma_TG" value="{{$tacgia->ma_TG}}" readonly>
        <p></p>
    </div> -->
                        <div class="form-group">
                            <b> Họ Tên </b>
                            <input class="form-control" type="text" id="example-search-input" name="ho_ten" value="{{$tacgia->ho_ten}}">
                            <p></p>
                        </div>
                        <!-- <div class="form-group">
                            <b> Địa Chỉ </b>
                            <input class="form-control" type="text" name="dia_chi" id="example-url-input" value="{{$tacgia->dia_chi}}">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <b> Điện Thoại </b>
                            <input class="form-control" type="text" name="lien_he" id="example-tel-input" value="{{$tacgia->lien_he}}">
                            <p></p>
                        </div> -->
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
