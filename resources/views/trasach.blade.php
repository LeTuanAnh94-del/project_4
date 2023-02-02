@extends('layouts.master')
@section('content')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <h5 class="font-weight-bolder mb-0"> Trả Sách </h5>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form action="{{ route('searchtrasach') }}" method="GET">
                        @csrf
                        <div class="col-auto" style="margin-top:4vh ;">
                            <div class="bg-white border-radius-lg d-flex me-2">
                                <input type="text" class="form-control border-0 ps-3" placeholder="Nhập..."
                                    name="keywordtrasach" value="{{ isset($keywordtrasach) ? $keywordtrasach : '' }}">
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1" style="width: 71vw; margin-left:5vh;">
                                <tr>
                                    <th> Phiếu </th>
                                    <th> Tên Độc Giả </th>
                                    <th> Sách Mượn </th>
                                    <!-- <th> Tổng Tiền </th> -->
                                    <th style="padding-left:1.5vw;"> Chi Tiết </th>
                                </tr>
                                @forelse ($phieumuons as $phieumuon)
                                    <tr>
                                        <td style="padding-left: 1vh;"> {{ $phieumuon->ma_phieu }} </td>
                                        <td> {{ $phieumuon->ho_ten }} </span></td>
                                        <td>
                                            @foreach ($phieumuonsachs as $phieumuonsach)
                                                @if ($phieumuonsach->ma_phieu == $phieumuon->ma_phieu)
                                                    {{ $phieumuonsach->ten_sach }},
                                                @endif
                                            @endforeach
                                        </td>
                                        <!-- <td></td> -->
                                        <td style="padding-left: 1vh;">
                                            <a href="{{ url('/chitiettrasach/' . $phieumuon->ma_phieu) }}"
                                                style="color: white">
                                                <button class="btn btn-info btn-xs" type="button"
                                                    data-original-title="btn btn-danger btn-xs" title=""> Chi tiết
                                                </button>
                                            </a>

                                            {{-- @foreach ($phieumuonsachs as $phieumuonsach)
                                        @if ($phieumuonsach->ma_sach == null)
                                        <a href="{{url('/chitiettrasach/'.$phieumuon->ma_phieu)}}" style="color: white">
                                            <button class="btn btn-info btn-xs" type="button" data-original-title="btn btn-danger btn-xs" title=""> Chi tiết </button>
                                        </a>
                                        @else
                                        <p>1</p>
                                        @endif

                                    @endforeach --}}
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
