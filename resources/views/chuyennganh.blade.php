@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h5 class="font-weight-bolder mb-0"> Chuyên Ngành </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchCN')}}" method="GET">
                    @csrf
                    <div class="col-auto" style="margin-top:4vh ;">
                        <div class="bg-white border-radius-lg d-flex me-2">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keywordCN" value="{{isset($keywordCN) ? $keywordCN : '' }}">
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
            <button class="btn btn-primary" type="button">
                <a href="{{url('/themCN')}}" style="color: white"> Thêm Chuyên Ngành </a>
            </button>
            <button class="btn btn-primary" type="button">
                <a href="{{url('/export_chuyennganh')}}" style="color: white"> Xuất Excel </a>
            </button>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display" id="basic-1" style="width: 65vw; margin-left:10vh">
                            <thead>
                                <tr>
                                    <th> Mã </th>
                                    <th> Chuyên Ngành </th>
                                    <th> Chỉnh Sửa </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($CNs as $CN)
                                <tr>
                                    <td style="padding-left: 1vh;"> {{$CN->ma_CN}} </td>
                                    <td> {{$CN->chuyen_nganh}} </td>
                                    <td style="padding-left: 1.5vh;">
                                    <a href="{{url('/suaCN/'.$CN->ma_CN)}}" style="color: white">
                                        <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Sửa </button>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Danh sách trống</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="padding-top: 2vw;">
            {!! $CNs->withQueryString()->links() !!}
        </div>
        @endsection
