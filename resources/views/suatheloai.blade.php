@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 4vh;">
            <h5 class="font-weight-bolder mb-0"> Thể Loại: @php echo($theloai->the_loai); @endphp </h5>
        </nav>
    </div>
</nav>
@if ($theloai != NULL)
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf
                        <div class="form-group">
                            <b> Mã Thể Loại </b>
                            <input style="width:20vw;" class="form-control" type="text" id="example-text-input" name="ma_TL" value="{{$theloai->ma_TL}}" readonly>
                        </div>
                        <div class="form-group">
                            <b> Thể Loại </b>
                            <input style="width:20vw;" class="form-control" type="text" id="example-search-input" name="the_loai" value="{{$theloai->the_loai}}">
                        </div>
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
