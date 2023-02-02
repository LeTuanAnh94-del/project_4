@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top:2vh ;">
            <h5 class="font-weight-bolder mb-0"> Độc Giả </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchdocgia')}}" method="GET">
                    <div class="input-group">
                        <div class="bg-white border-radius-lg d-flex me-2" style="margin-top:4vh ;">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keyworddocgia" value="{{isset($keyworddocgia) ? $keyworddocgia : '' }}">
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
            <a href="{{url('/themdocgia')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Thêm Độc Giả </button>
            </a>
            <a href="{{url('/export_docgia')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Xuất Excel </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1" style="width: 71vw; margin-left:5vh;">
                            <thead>
                                <tr>
                                    <th> Mã </th>
                                    <th> Độc Giả </th>
                                    <th> Ngày Làm Thẻ </th>
                                    <th> Ngày Hết Hạn Thẻ </th>
                                    <th style="padding-left:1.5vw;"> Tình Trạng </th>
                                    <th style="padding-left:0.9vw;"> Chi Tiết </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($docgias as $docgia)
                                <tr>
                                    <td style="padding-left: 1vh;"> {{$docgia->ma_DG}} </td>
                                    <td> {{$docgia->ho_ten}} </td>
                                    <td style="padding-left: 2vh;"> {{$docgia->ngay_lam_the}} </td>
                                    <td style="padding-left: 4vh;"> {{$docgia->ngay_het_han}} </td>
                                    <td style="padding-left: 4vh;">
                                    @if ($docgia->tinh_trang == '')
                                    <a href="{{url('/status_update_docgia', $docgia->ma_DG)}}" class="btn btn-success"> Hiện </a>
                                    @else
                                    <a href="{{url('/status_update_docgia', $docgia->ma_DG)}}" class="btn btn-danger"> Ẩn </a>
                                    @endif
                                </td>
                                    <td>
                                        <a href="{{url('/chitietdocgia/'.$docgia->ma_DG)}}" style="color: white">
                                            <button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Chi Tiết </button>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Danh sách trống</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="padding-top: 2vw;">
            {!! $docgias->withQueryString()->links() !!}
        </div>
        @endsection
