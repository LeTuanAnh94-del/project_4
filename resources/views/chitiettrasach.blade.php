@extends('layouts.master')
@section('chitiettrasach')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 4vh;">
            <table>

                <tr>
                    <td>
                        <h5 class="font-weight-bolder mb-0" style="width:65vw"> Mã Phiếu: {{$chitiets[0]->ma_phieu; }} </h5>
                    </td>
                </tr>
            </table>
        </nav>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 4vh;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table" style="padding-left: 5vw;">
                        <table class="display" id="basic-1" style="width: 65vw; margin-left:-4vh;">
                            <tr>
                                <th> Sách Mượn </th>
                                <th> Bìa Sách </th>
                                <th> Ngày Trả </th>
                                <th> Lỗi Phạt </th>
                                <th> Tiền Phạt </th>
                            </tr>
                            <tr>
                                @forelse ($chitiets as $chitiet)
                                <td> {{ $chitiet->ten_sach }} </td>
                                <td> <img src="{{ url($chitiet->image) }}" width="100px" alt=""> </td>
                                <td> {{ date('Y-m-d', strtotime($chitiet->ngay_tra)) }} </td>
                                <td> {{ $chitiet->loi_phat }} </td>
                                <td> {{ number_format($chitiet->muc_phat) }} VND </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11"> Danh sách trống ! </td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                    <hr>
                    <div class="table-responsive product-table" style="padding-left: 5vw;">
                        <table class="display" id="basic-1" style="width: 65vw; margin-left:-4vh;">
                            <tr>
                                <th> Phí Mượn Sách (Đã Thu) </th>
                                <th style="padding-left: 85vh;"> {{ number_format($chitiet->tong_tien) }} VND </th>
                            </tr>
                            <tr>
                                <th> Phụ Phí </th>
                                <th style="padding-left: 85vh;"> {{ number_format($chitiets->sum('muc_phat')) }} VND </th>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="table-responsive product-table" style="padding-left: 5vw;">
                        <table class="display" id="basic-1" style="width: 65vw; margin-left:-4vh;">
                            <tr>
                                <th> Tổng </th>
                                <th style="padding-left: 109vh;"> {{ number_format(($chitiet->tong_tien) + ($chitiets->sum('muc_phat'))) }} VNĐ</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
