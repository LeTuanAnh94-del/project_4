@php
    function getDiff ($date){
        $d = strtotime(date('Y-m-d',strtotime($date)));
        return (strtotime(date('Y-m-d')) - $d) / 86400;
    }
@endphp

@extends('layouts.master')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h5 class="font-weight-bolder mb-0"> Phiếu mượn </h5>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form action="{{ route('searchphieumuon') }}" method="GET">
                        @csrf
                        <div class="col-auto" style="margin-top:4vh ;">
                            <div class="bg-white border-radius-lg d-flex me-2">
                                <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..."
                                    name="keywordphieumuon" value="{{ isset($keywordphieumuon) ? $keywordphieumuon : '' }}">
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
                <a href="{{ url('/themphieumuon') }}" style="color: white">
                    <button class="btn btn-primary" type="button"> Thêm Phiếu Mượn </button>
                </a>
                <a href="{{ url('/export_phieumuon') }}" style="color: white">
                    <button class="btn btn-primary" type="button"> Xuất Excel </button>
                </a>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1" style="width: 73vw;">
                                <tr>
                                    <th> Phiếu </th>
                                    <th style="padding-left: 2vh; min-width:30vh;"> Độc Giả </th>
                                    <!-- <th> Sách Mượn </th> -->
                                    <th> Ngày Mượn </th>
                                    <th> Hạn Trả </th>
                                    <th> Phí Mượn </th>
                                    <th style="padding-left:1.5vw;"> Hành Động </th>
                                </tr>
                                @forelse ($phieumuons as $phieumuon)
                                    <tr>
                                        <td> {{ $phieumuon->ma_phieu }} </td>
                                        <td style="padding-left: 2vh;"> {{ $phieumuon->ho_ten }} </span></td>
                                        <td> {{ $phieumuon->ngay_muon }} </td>
                                        <td>
                                            @if (getDiff($phieumuon->han_tra) > 0)
                                                <span style="color: white; background-color: red">{{ date("d-m-Y",strtotime($phieumuon->han_tra)) }}</span>
                                            @elseif (getDiff($phieumuon->han_tra) > -2)
                                                <span style="color: white; background-color: orange">{{ date("d-m-Y",strtotime($phieumuon->han_tra)) }}</span>
                                            @else
                                                {{ date("d-m-Y",strtotime($phieumuon->han_tra)) }}
                                            @endif
                                        </td>
                                        <td> {{ number_format($phieumuon->tong_tien)}} VNĐ </td>
                                        <td>
                                            @foreach ($phieumuonsachs as $phieumuonsach)
                                                @if ($phieumuonsach->ma_phieu == $phieumuon->ma_phieu && $phieumuonsach->tinh_trang == null)
                                                    <a href="{{ URL::to('/themtrasach/' . $phieumuon->ma_phieu) }}"
                                                        style="padding-left:1.5vw; color: white">
                                                        <button class="btn btn-info btn-xs" type="button"
                                                            data-original-title="btn btn-danger btn-xs" title="">
                                                            Trả sách
                                                        </button>
                                                    </a>
                                                    @break
                                                @endif
                                            @endforeach

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
        {!! $phieumuons->withQueryString()->links() !!}
    </div>

@endsection
