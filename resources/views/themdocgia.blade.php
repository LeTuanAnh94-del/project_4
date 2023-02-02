@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Độc Giả </h5>
        </nav>
        <div style="margin-top: 3vh; margin-left:5vh;">
            <a href="{{url('/import-form-docgia')}}" style="color: white">
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
                        <div class="row eachRow">
                            <div class="col">
                                <b> Tên Độc Giả </b>
                                <input style="width: 700px;" class="form-control" type="text" id="example-search-input" name="ho_ten">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ho_ten') }} </i></p>
                            </div>
                            <div class="col" style="margin-top:5vh; margin-left:5vh">
                                <b> Giới tính </b>
                                <input type="radio" id="nam" name="gioi_tinh" value="0"> Nam
                                <input type="radio" id="nu" name="gioi_tinh" value="1"> Nữ
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('gioi_tinh') }} </i></p>
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Email </b>
                                <input style="width: 1030px;" class="form-control" type="email" id="example-email-input" name="email">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('email') }} </i></p>
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Địa Chỉ </b>
                                <input style="width: 490px;" class="form-control" type="text" name="dia_chi" id="example-url-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('dia_chi') }} </i></p>
                            </div>
                            <div class="col" style="margin-left: 1.2vw;">
                                <b> Điện Thoại </b>
                                <input style="width: 490px;" class="form-control" type="number" name="lien_he" id="example-tel-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('lien_he') }} </i></p>
                            </div>
                        </div>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Ngày Sinh </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_sinh" id="example-datetime-local-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ngay_sinh') }} </i></p>
                            </div>
                            <div class="col">
                                <b> Ngày Làm Thẻ </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_lam_the" id="example-date-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ngay_lam_the') }} </i></p>
                            </div>
                            <div class="col">
                                <b> Ngày Hết Hạn Thẻ </b>
                                <input style="width: 320px;" class="form-control" type="date" name="ngay_het_han" id="example-month-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ngay_het_han') }} </i></p>
                            </div>
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
