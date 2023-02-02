@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Lỗi Phạt </h5>
        </nav>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card" style="min-height: 60vh">
                <div class="mainForm">
                    <form method="POST" action="{{route('import_loiphat')}}" style="padding-left: 30px; padding-top:30px; padding-right:30px" enctype="multipart/form-data">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Chọn Tệp Tin </b>
                                <input style="width: 700px;" accept=".xlsx" class="form-control" type="file" id="example-search-input" name="file">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('file') }} </i></p>
                            </div>
                            <div class="col" style="margin-top: 3.5vh; margin-left:2vh;">
                                <button class="btn btn-success" type="submit"> Thêm </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
