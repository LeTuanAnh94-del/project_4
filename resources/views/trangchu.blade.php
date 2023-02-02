@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bolder mb-0"> Trang Chủ </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class=" ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchsach')}}" method="GET">
                    @csrf
                    <div class="col-auto" style="margin-top:4vh ;">
                        <div class="bg-white border-radius-lg d-flex me-2">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keywordsach" value="{{isset($keywordsach) ? $keywordsach : '' }}">
                            <button class="btn bg-gradient-primary my-1 me-1" type="submit"> Tìm </button>
                        </div>
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
            <a href="{{url('/create')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Thêm Sách </button>
            </a>
            <a href="{{url('/export_sach')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Xuất Excel </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1" style="width: 70vw; margin-left:5vh;">
                            <tr>
                                <th> Mã </th>
                                <th style="padding-left: 1.5vh;"> Bìa Sách </th>
                                <th> Tên Sách </th>
                                <!-- <th> Giá </th> -->
                                <th> Số lượng </th>
                                <th style="padding-left:1.5vw;"> Tình Trạng </th>
                                <th style="padding-left:1vw;"> Chi Tiết </th>
                            </tr>
                            @forelse ($sachs as $sach)
                            <tr>
                                <td style="padding-left:1vh;"> {{$sach->ma_sach}} </td>
                                <td> <img  src="{{$sach->image}}" style="width:12vh;" alt=""> </td>
                                <td> {{$sach->ten_sach}} </td>
                                <!-- <td> {{number_format($sach->gia_tien)}} VND</td> -->
                                <td style="padding-left:3vh;"> {{$sach->so_luong}} </td>
                                <td style="padding-left: 4vh;">
                                    @if ($sach->tinh_trang == '')
                                    <a href="{{url('/status_update_sach', $sach->ma_sach)}}" class="btn btn-success btn-xs"> Còn </a>
                                    @else
                                    <a href="{{url('/status_update_sach', $sach->ma_sach)}}" class="btn btn-danger btn-xs"> Hết </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/chitietsach/'.$sach->ma_sach)}}" style="color: white">
                                        <button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Chi tiết </button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6"> Danh sách trống ! </td>
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
    {!! $sachs->withQueryString()->links() !!}
</div>
@endsection
