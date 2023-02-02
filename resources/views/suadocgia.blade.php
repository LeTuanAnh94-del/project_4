@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0">Độc giả: @php echo($docgia->ho_ten); @endphp</h5>
        </nav>
    </div>
</nav>
@if ($docgia != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" style="margin-top: 5vh;">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Tên Độc Giả </b>
                                <input style="width: 700px;" class="form-control" type="text" id="example-search-input" name="ho_ten" value="{{$docgia->ho_ten}}">
                            </div>
                            <div class="col" style="margin-top:5vh; margin-left:5vh">
                                <b> Giới tính </b>
                                <input type="radio" id="nam" name="gioi_tinh" value="0" checked> Nam
                                <input type="radio" id="nu" name="gioi_tinh" value="1"
                                    @if ($docgia->gioi_tinh == 1)
                                        checked
                                    @endif
                                > Nữ
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Email </b>
                                <input style="width: 1030px;" type="email" class="form-control" id="email" name="email" value="{{$docgia->email}}">
                                <p></p>
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Địa Chỉ </b>
                                <input style="width: 490px;" type="text" class="form-control" name="dia_chi" id="dia_chi" value="{{$docgia->dia_chi}}">
                                <p></p>
                            </div>
                            <div class="col" style="margin-left: 1.2vw;">
                                <b> Điện Thoại </b>
                                <input style="width: 490px;" type="tel" class="form-control" name="lien_he" id="lien_he" value="{{$docgia->lien_he}}">
                                <p></p>
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Ngày Sinh </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_sinh" id="example-datetime-local-input" value="{{$docgia->ngay_sinh}}">
                                <p></p>
                            </div>
                            <div class="col">
                                <b> Ngày Làm Thẻ </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_lam_the" id="example-date-input" value="{{$docgia->ngay_lam_the}}">
                                <p></p>
                            </div>
                            <div class="col">
                                <b> Ngày Hết Hạn Thẻ </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_het_han" id="example-month-input" value="{{$docgia->ngay_het_han}}">
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
