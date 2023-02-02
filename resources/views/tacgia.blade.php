@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top:1vh ;">
            <h5 class="font-weight-bolder mb-0"> Tác Giả </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <form action="{{route('searchTacGia')}}" method="GET">
                    @csrf
                    <div class="col-auto" style="margin-top:4vh ;">
                        <div class="bg-white border-radius-lg d-flex me-2">
                            <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..." name="keywordTacGia" value="{{isset($keywordTacGia) ? $keywordTacGia : '' }}">
                            <button class="btn bg-gradient-primary my-1 me-1" type="submit">Tìm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12" style="margin-top:1.5vh;">
                <a href="{{url('/themtacgia')}}" style="color: white">
                    <button class="btn btn-primary" type="button"> Thêm Tác Giả </button>
                </a>
                <a href="{{url('/export_tacgia')}}" style="color: white"> Xuất Excel
                    <button style="margin-left: -10vh;" class="btn btn-primary" type="button"> Xuất Excel
                </a>
                </button>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1" style="width: 70vw; margin-left:8vh;">
                                <tr>
                                    <th> Mã </th>
                                    <th> Tác Giả </th>
                                    <th style="padding-left: 0.9vw;"> Chỉnh Sửa </th>
                                </tr>
                                @forelse ($tacgias as $tacgia)
                                <tr>
                                    <td style="padding-left: 1vh;"> {{$tacgia->ma_TG}} </td>
                                    <td> {{$tacgia->ho_ten}} </td>
                                    <td style="padding-left: 3vh;">
                                        <a href="{{url('/suatacgia/'.$tacgia->ma_TG)}}" style="color: white">
                                            <button class="btn btn-primary btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Sửa </button>
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
        {!! $tacgias->withQueryString()->links() !!}
    </div>
    @endsection
