@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bolder mb-0"> Sửa Nhà Xuất Bản </h5>
        </nav>
    </div>
</nav>
@if ($phieumuon != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="mainForm">
                    <form method="get" action="/updatephieumuon" onsubmit="return true" style="padding-left: 30px; padding-top:30px">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Mã Sách </b>
                                <input style="width: 250px;" type="text" class="form-control" id='ma_phieu' name='ma_phieu' value="{{$phieumuon->ma_phieu}}" readonly>
                                <p id="maSachVali"></p>
                            </div>
                            <div class="row eachRow">
                                <div class="col">
                                    <b> Độc Giả </b>
                                    <select name="ma_DG" class="form-control" style="width: 250px;" id='ma_DG'>
                                        @foreach ($docgias as $docgia)
                                        <option value="{{$docgia->ma_DG}}">{{$docgia->ho_ten}}</option>
                                        @endforeach
                                    </select>
                                </div> <br>
                                <div class="col">
                                    <b>Sách </b> <br>
                                    <select style="width:43.5vw" id="ma_sach" name="ma_sach[]" multiple class="form-control" style="width: 250px;">
                                        @foreach ($sachs as $sach)
                                        <option value="{{$sach->ma_sach}}" {{in_array($sach->ma_sach, $valueSach) ? "selected" : ""}}>{{$sach->ten_sach}}</option>
                                        @endforeach
                                    </select>

                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#ma_sach').select2({
                                                placeholder: "Chọn sách",
                                                allowClear: true
                                            });
                                        });
                                    </script>
                                    {{-- <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ma_sach') }} </i></p> --}}
                                </div>
                                <br>
                                <div class="col">
                                    <b> Ngày Mượn </b>
                                    <input style="width: 250px;" type="datetime-local" class="form-control" id='ngay_muon' name='ngay_muon' value="{{date('Y-m-d\TH:i',strtotime($phieumuon->ngay_muon))}}"">
                <p id=" giaTienVali"></p>
                                </div>
                                <div class="col">
                                    <b> Hạn Trả </b>
                                    <input style="width: 250px;" type="datetime-local" class="form-control" id='han_tra' name='han_tra' value="{{date('Y-m-d\TH:i',strtotime($phieumuon->han_tra))}}">
                                    <p id="soTrangVali"></p>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success px-xl-5 mt-4"> Cập Nhật </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        @else
        <h1>Không có dữ liệu</h1>
        @endif
        @endsection
