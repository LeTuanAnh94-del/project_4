@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Lỗi </h5>
        </nav>
        <div style="margin-top: 3vh; margin-left:5vh;">
            <a href="{{url('/import-form-loiphat')}}" style="color: white">
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
                                <b> Lỗi Phạt </b>
                                <input style="width: 700px;" class="form-control" type="text" id="example-search-input" name="loi_phat">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('loi_phat') }} </i></p>
                            </div>
                            <div class="col">
                                <b> Mức Phạt </b>
                                <input style="width: 700px;" class="form-control" type="text" id="example-search-input" name="muc_phat">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('muc_phat') }} </i></p>
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
