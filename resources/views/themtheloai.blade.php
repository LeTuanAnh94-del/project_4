@extends('layouts.master')
@section('insert')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top:3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Thể Loại </h5>
        </nav>
        <div style="margin-top: 3vh; margin-left:5vh;">
            <a href="{{url('/import-form-theloai')}}" style="color: white">
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
                            <b> Thể Loại </b>
                            <input class="form-control" type="text" id="example-search-input" name="the_loai">
                            <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('the_loai') }} </i></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success "> Thêm </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
