@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bolder mb-0"> Thể Loại </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchTheLoai')}}" method="GET">
                    @csrf
                    <div class="col-auto" style="margin-top:4vh ;">
                        <div class="bg-white border-radius-lg d-flex me-2">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keywordTheLoai" value="{{isset($keywordTheLoai) ? $keywordTheLoai : '' }}">
                            <button class="btn bg-gradient-primary my-1 me-1" type="submit"> Tìm </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top:1.5vh;">
            <a href="{{url('/themtheloai')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Thêm Thể Loại </button>
            </a>
            <a href="{{url('/export_theloai')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Xuất Excel </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1" style="width: 65vw; margin-left:10vh">
                            <tr>
                                <th> Mã </th>
                                <th> Thể loại </th>
                                <th style="padding-left: 0.9vw;"> Chỉnh Sửa </th>
                            </tr>
                            @forelse ($theloais as $theloai)
                            <tr>
                                <td> {{$theloai->ma_TL}} </td>
                                <td> {{$theloai->the_loai}} </td>
                                <td style="padding-left: 2vh;">
                                    <a href="{{url('suatheloai/'.$theloai->ma_TL)}}" style="color: white">
                                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Sửa </button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4"> Danh sách trống ! </td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center" style="padding-top: 2vw;">
    {!! $theloais->withQueryString()->links() !!}
</div>

@endsection
