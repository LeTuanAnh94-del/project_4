@extends('layouts.master')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top:3vh;">
            <h5 class="font-weight-bolder mb-0"> Thêm Phiếu Mượn </h5>
        </nav>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px" onsubmit="return checkdate()">
                        @csrf
                        <div class="row eachRow">
                            <div class="col">
                                <b> Tên Độc Giả </b>
                                <select id='ma_DG' name="ma_DG" style="width: 154vh" class="js-example-placeholder-single">
                                    <option disabled selected>-- Chọn độc giả --</option>
                                    @foreach ($docgias as $items)
                                    @if ($items->tinh_trang == 0)
                                    <option value="{{$items->ma_DG}}">{{$items->ho_ten}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ma_DG') }} </i></p>

                            </div>
                        </div>
                        <div class="row eachRow">
                        <div class="col">
                            <b> Sách </b> <br>
                            <select id="ma_sach" name="ma_sach[]" multiple class="form-control" style="width: 154vh;">
                                @foreach ($sachs as $sach)
                                @if ($sach->tinh_trang == 0)
                                <option value="{{$sach->ma_sach}}">{{$sach->ten_sach}}</option>
                                @endif
                                @endforeach
                            </select>
                            <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ma_sach') }} </i></p>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#ma_sach').select2({
                                        placeholder: "Chọn sách",
                                        allowClear: true
                                    });
                                });
                            </script>
                        </div>
                        </div>
                        <br>
                        <div class="row eachRow">
                            <div class="col">
                                <b> Ngày Mượn </b>
                                @php
                                    date_default_timezone_set('Asia/Bangkok');
                                @endphp
                                <input class="form-control" type="datetime-local" value="{{ date_create()->format('Y-m-d H:i:s') }}" id="ngay_muon" name="ngay_muon"  onchange="checkdate()">

                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('ngay_muon') }} </i></p>
                                {{-- <input type="text" id="datetimepicker7"> --}}
                            </div>
                            <div class="col">
                                <b> Hạn Trả </b>
                                <input class="form-control" type="datetime-local" name="han_tra" id="example-tel-input">
                                <p><i style="color: red; font-size: 2vh;"> {{ $errors->first('han_tra') }} </i></p>
                                <p></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit"> Thêm </button>
                        </div>
                        <script src="/assets/js/plugins/flatpickr.min.js"></script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkdate() {
        var now = new Date();
        var date = new Date(document.getElementById('ngay_muon').value);
        console.log(now.getMinutes(), date.getMinutes());
        if (now.getMinutes() > date.getMinutes()) {
            document.getElementById('ngay_muon').style.border = '1px solid red';
            return false;
        } else {
            document.getElementById('ngay_muon').style.border = '1px solid green';
            return true;
        }
    }

    $(".js-example-placeholder-single").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    // $(function() {
    //     $("#ngay_muon").datetimepicker();
    // });
    // $(function () {
    //       $('#datetimepicker7').datetimepicker();
    //   });

</script>

@endsection
