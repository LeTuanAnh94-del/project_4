@extends('layouts.master')
@section('chitietsach')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 1vh;">
            <table>
                @forelse ($chitiets as $chitiet)
                <tr>
                    <td>
                        <h5 class="font-weight-bolder mb-0" style="width:65vw"> Sách: @php echo($chitiet->ten_sach); @endphp </h5>
                    </td>
                    <td>
                        <a href="{{url('/edit/'.$chitiet->ma_sach)}}" class="btn btn-primary align-self-center"> Sửa </a>
                    </td>
                </tr>
            </table>
        </nav>
    </div>
</nav>

<style>
    th{
        min-width: 25vh;
    }
    td{
        padding-left: 5vh;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 3vh;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table" style="padding-left: 5vw;">
                        <table class="display" id="basic-1" style="width: 65vw;">
                            <table>
                                <tr>
                                    <td rowspan="8">
                                        <div style="min-width: 35vh;">
                                        <img src="{{url($chitiet->image)}}" alt="" style="width: 35vh;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style="margin-left: 10vh;">
                                            <tr>
                                                <th> Mã Sách </th>
                                                <td> : {{$chitiet->ma_sach}} </td>
                                            </tr>
                                            <tr>
                                                <th> Tên Sách </th>
                                                <td> : {{$chitiet->ten_sach}} </td>
                                            </tr>
                                            <tr>
                                                <th> Nội dung </th>
                                                <td> : {{$chitiet->noi_dung}} </td>
                                            </tr>
                                            <tr>
                                                <th> Số trang </th>
                                                <td> : {{$chitiet->so_trang}} </td>
                                            </tr>
                                            <tr>
                                                <th> Số lượng </th>
                                                <td> : {{$chitiet->so_luong}} </td>
                                            </tr>
                                            <tr>
                                                <th> Giá </th>
                                                <td> : {{number_format($chitiet->gia_tien) }} VND </td>
                                            </tr>
                                            <tr>
                                                <th> Ngày nhập </th>
                                                <td> : {{date('Y-m-d',strtotime($chitiet->ngay_nhap))}} </td>
                                            </tr>
                                            <tr>
                                                <th> Thể Loại </th>
                                                <td> : {{$chitiet->the_loai}} </td>
                                            </tr>
                                            <tr>
                                                <th> Nhà Xuất Bản </th>
                                                <td> : {{$chitiet->nha_xuat_ban}} </td>
                                            </tr>
                                            <tr>
                                                <th> Chuyên Ngành </th>
                                                <td> : {{$chitiet->chuyen_nganh}} </td>
                                            </tr>
                                            <tr>
                                                <th> Tác Giả </th>
                                                <td> :
                                                    @foreach ($tgs as $key => $tg )
                                                    {{$tg->ho_ten}}
                                                    @if ($key != count($tgs)-1)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11"> Danh sách trống </td>
                                            </tr>
                                            @endforelse
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
