@extends('layouts.master')
@section('chitietdocgia')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 1vh;">
            <table>
                @forelse ($chitiets as $chitiet)
                <tr>
                    <td>
                        <h5 class="fw-bolder m-0"> Độc giả: @php echo($chitiet->ho_ten); @endphp </h5>
                    </td>
                    <td style="padding-left: 53vw;">
                        <a href="{{url('/suadocgia/'.$chitiet->ma_DG)}}" class="btn btn-primary align-self-center"> Sửa </a>
                    </td>
                </tr>
            </table>
        </nav>
    </div>
</nav>



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card" style="margin-top: 3vh;">
                <div class="card-body">
                    <div class="table-responsive product-table" style="padding-left: 5vw;">
                        <table class="display" id="basic-1" style="width: 65vw;">
                            <tr>
                                <th> Mã </th>
                                <td> : {{$chitiet->ma_DG}} </td>
                            </tr>
                            <tr>
                                <th> Họ Tên </th>
                                <td> : {{$chitiet->ho_ten}} </td>
                            </tr>
                            <tr>
                                <th> Ngày Sinh </th>
                                <td> : {{$chitiet->ngay_sinh}} </td>
                            </tr>
                            <tr>
                                <th> Giới Tính </th>
                                @if ($chitiet->gioi_tinh == 0)
                                <td> : Nam </td>
                                @else
                                <td> : Nữ </td>
                                @endif
                            </tr>
                            <tr>
                                <th> Email </th>
                                <td> : {{$chitiet->email}} </td>
                            </tr>
                            <tr>
                                <th> Điện Thoại </th>
                                <td> : 0{{$chitiet->lien_he}} </td>
                            </tr>
                            <tr>
                                <th> Địa Chỉ </th>
                                <td> : {{$chitiet->dia_chi}} </td>
                            </tr>
                            <tr>
                                <th> Ngày làm thẻ </th>
                                <td> : {{$chitiet->ngay_lam_the}} </td>
                            </tr>
                            <tr>
                                <th> Ngày hết Hạn </th>
                                <td> : {{$chitiet->ngay_het_han}} </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8"> Danh sách trống ! </td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
