@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Nhà Xuất Bản </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchNXB')}}" method="GET">
                    @csrf
                    <div class="col-auto" style="margin-top:4vh ;">
                        <div class="bg-white border-radius-lg d-flex me-2">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keywordNXB" value="{{isset($keywordNXB) ? $keywordNXB : '' }}">
                            <button class="btn bg-gradient-primary my-1 me-1" type="submit">Tìm</button>
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
            <a href="{{url('/themNXB')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Thêm NXB </button>
            </a>
            <a href="{{url('/export_NXB')}}" style="color: white">
                <button class="btn btn-primary" type="button"> Xuất Excel </button>
            </a>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1" style="width: 140vh; margin-left:10vh">
                            <thead>
                                <tr>
                                    <th> Mã </th>
                                    <th> Nhà Xuất Bản </th>
                                    <th style="width:300px"> Địa Chỉ </th>
                                    <th style="padding-left: 5vh;"> Liên Hệ </th>
                                    <th> Chỉnh Sửa </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($NXBs as $NXB)
                                <tr>
                                    <td style="padding-left: 1vh;"> {{$NXB->ma_NXB}} </td>
                                    <td> {{$NXB->nha_xuat_ban}} </td>
                                    <td> {{$NXB->dia_chi}} </td>
                                    <td style="padding-left: 5vh;">0{{$NXB->lien_he}} </td>
                                    <td style="padding-left: 1vh;">
                                        <a href="{{url('/suaNXB/'.$NXB->ma_NXB)}}" style="color: white">
                                            <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Sửa </button>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6"> Danh sách trống !</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="padding-top: 2vw;">
            {!! $NXBs->withQueryString()->links() !!}
        </div>
        @endsection
