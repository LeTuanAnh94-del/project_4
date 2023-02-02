@extends('layouts.master')
@section('update')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 3vh;">
            <h5 class="font-weight-bolder mb-0"> Sách: @php echo($sach->ten_sach); @endphp </h5>
        </nav>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" action={{"/updated/".$sach->ma_sach}} onsubmit="return true" style="padding-left: 30px; padding-top:30px" enctype="multipart/form-data">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Tên Sách </b>
                                <input style="width:68vw" type="text" class="form-control" id='ten_sach' name='ten_sach' value="{{$sach->ten_sach}}">
                                <p id="fnameVali"></p>
                            </div>
                        </div>

                        <div class="row eachRow">
                            <div class="col">
                                <b> Giá tiền </b>
                                <input style="width: 250px;" type="text" class="form-control" id='gia_tien' name='gia_tien' value="{{$sach->gia_tien}}">
                                <p id="giaTienVali"></p>
                            </div>
                            <div class="col" style="margin-left: 1vw;">
                                <b> Số Trang </b>
                                <input style="width: 250px;" type="text" class="form-control" id='so_trang' name='so_trang' value="{{$sach->so_trang}}">
                                <p id="soTrangVali"></p>
                            </div>
                            <div class="col">
                                <b> Số Lượng </b>
                                <input style="width: 250px;" type="text" class="form-control" id='so_luong' name='so_luong' value="{{$sach->so_luong}}">
                                <p id="soLuongVali"></p>
                            </div>
                        </div>

                        <div class="row eachRow">
                            <div class="col">
                                <b>Tác Giả </b> <br>
                                <select style="width:43.5vw" id="ma_TG" name="ma_TG[]" multiple class="form-control" style="width: 250px;">
                                    @foreach ($tacgias as $tacgia)
                                    <option value="{{$tacgia->ma_TG}}" {{in_array($tacgia->ma_TG, $valueTG) ? "selected" : ""}}>{{$tacgia->ho_ten}}</option>
                                    @endforeach

                                </select>

                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#ma_TG').select2();
                                    });
                                </script>
                                <p id="maTGVali"></p>
                            </div>
                            <div class="col" style="margin-left: 5.5vw;">
                                <b>Thể Loại </b> <br>
                                <select id="ma_TL" name="ma_TL"  class="js-example-placeholder-single" style="width: 250px;">
                                    <option disabled selected>Chọn thể loại</option>
                                    @foreach ($theloais as $theloai)
                                    <option value="{{$theloai->ma_TL}}" {{($theloais) ==  $theloai->ma_TL ? 'selected' : ''}}>{{$theloai->the_loai}}</option>
                                    @endforeach
                                </select>

                                <p id="maTLVali"></p>
                            </div>
                        </div>

                        <div class="row eachRow">
                            <div class="col">
                                <b>Nhà xuất bản </b> <br>
                                <select id="ma_NXB" name="ma_NXB" class="js-example-placeholder" style="width: 250px;">
                                    <option disabled selected>Chọn nhà xuất bản</option>
                                    @foreach ($NXBs as $item)
                                    <option value="{{$item->ma_NXB}}" selected>{{$item->nha_xuat_ban}}</option>
                                    @endforeach
                                </select>
                                {{-- <script type="text/javascript">
                        $(document).ready(function() {
                            $('#ma_NXB').select2();
                        });
                        </script> --}}
                                <p id="maNXBVali"></p>
                            </div>
                            <div class="col">
                                <b>Chuyên ngành </b> <br>
                                <select id="ma_CN" name="ma_CN" class="js-example" style="width: 250px;">
                                    <option disabled selected>Chọn chuyên ngành</option>
                                    @foreach ($CNs as $item)
                                    <option value="{{$item->ma_CN}}">{{$item->chuyen_nganh}}</option>
                                    @endforeach
                                </select>

                                <p id="maCNVali"></p>
                            </div>
                            <div class="col">
                                <b> Ngày Nhập </b>
                                <input style="width: 250px;" type="date" class="form-control" id='ngay_nhap' name='ngay_nhap' value="{{date('Y-m-d',strtotime($sach->ngay_nhap))}}">
                                <p id="ngayNhapVali"></p>
                            </div>
                            <div class="row eachRow">
                                <div class="col">
                                    <b> Nội Dung Tóm Tắt </b>
                                    <br>
                                    <textarea class="form-control" name="noi_dung" style="width:43.5vw; height:150px;">@php echo($sach->noi_dung); @endphp </textarea>
                                    <p id="noiDungVali"></p>
                                </div>
                                <div class="col">
                                <input name="image" required type="file" class="form-control" accept="image/*" value="{{$sach->image}}">
                            </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success px-xl-5 mt-4"> Cập Nhật </button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".js-example-placeholder-single").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    $(".js-example-placeholder").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    $(".js-example").select2({
        placeholder: "Select a state",
        allowClear: true
    });
</script>
@endsection
