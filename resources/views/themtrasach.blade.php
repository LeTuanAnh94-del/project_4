@extends('layouts.master')
@section('content')


<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 4vh;">
            <h5 class="font-weight-bolder mb-0"> Phiếu mượn @php echo($phieumuon->ma_phieu); @endphp </h5>
        </nav>
    </div>
</nav>
{{-- @if ($phieumuon != null) --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 4vh;">
            <div class="card">
                <div class="mainForm">
                    <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px">
                        @csrf

                        <div class="table-responsive product-table">
                            <form action="#">
                            <table class="display" id="basic-1" style="width: 72vw;">
                                <tr>
                                    <th style="padding-left: 5vh;"> Sách Mượn </th>
                                    <th style="padding-left: 3vh;"> Trả sách </th>
                                    <th style="padding-left: 3vh;"> Ngày Trả </th>
                                    <th></th>
                                    <th colspan="3" style="padding-left: 5vh"> Lỗi Phạt </th>
                                    <th></th>
                                </tr>
                                @php
                                $i = 0;
                                @endphp
                                @forelse ($phieutras as $phieutra)
                                <tr>
                                    <td>
                                        <input name="ma_phieu" value="{{ $phieutra->ma_phieu }}" id="example-search-input" class="form-control" readonly type="hidden">
                                        <input value="{{ $phieutra->ten_sach }}" id="example-search-input" class="form-control" disabled type="text">
                                    </td>
                                    <td style="padding-left: 2vh;">
                                        @if($phieutra->tinh_trang == 0)
                                        <input style="margin-left: 5vh;" class="checkbox-tra-sach" type="checkbox" name="tra_sach[{{$phieutra->ma_sach}}]" value="1">
                                        @else
                                        <input style="margin-left: 5vh;" type="checkbox" name="tra_sach[{{$phieutra->ma_sach}}]" value="1" disabled>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        date_default_timezone_set('Asia/Bangkok');
                                        @endphp

                                        @if($phieutra->tinh_trang == 0)
                                        <input style="width: 28vh" class="form-control" type="datetime-local" value="{{ date_create()->format('Y-m-d H:i:s') }}" name="ngay_tra" id="example-url-input">
                                        @else
                                        <input style="width: 28vh" class="form-control" type="datetime-local" value="{{ $phieutra->ngay_tra }}" name="ngay_tra" id="example-url-input">
                                        @endif
                                    </td>
                                    <td>
                                        @if($phieutra->tinh_trang == 0)
                                        <input type="checkbox" class="check_loi" value="{{ $i }}">
                                        @else
                                        <input type="checkbox" class="check_loi" value="{{ $i }}" disabled>
                                        @endif
                                    </td>
                                    <td>
                                        <select disabled id="maPhat_{{ $i }}" style="width:25vh;" onchange="onSelect('{{ $i }}')" name="ma_Phat[{{$phieutra->ma_sach}}]" class="form-control">
                                                <option disabled selected>-- Tất cả --</option>
                                            @foreach ($loiphats as $loiphat)
                                                <option data-value="{{$loiphat->muc_phat}}" id="{{ $i }}_{{$loiphat->ma_Phat}}" value="{{ $loiphat->ma_Phat }}">{{ $loiphat->loi_phat }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>
                                     <input style="width:15vh" class="form-control" type="text" disabled id="ma_Phat{{$i}}" value="">

                                    </td>
                                    @php
                                    $i++;
                                    @endphp
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="4"> Danh sách trống ! </td>
                                </tr>
                                @endforelse

                                <tr>
                                    <td colspan="6">
                                        <br>
                                        <button id="tra_sach_btn" class="btn btn-primary" type="submit"> Trả sách </button>
                                    </td>
                                </tr>
                                <span id="abc"></span>
                            </table>

                            <script>
                                function onSelect (id){
                                  const htm =  document.getElementById('maPhat_'+id);
                                  const val = document.getElementById(id+'_'+htm.value);

                                  const inp = document.getElementById('ma_Phat'+id);
                                  inp.value = val.getAttribute('data-value')
                                  console.log(
                                   val.getAttribute('data-value')
                                  );
                                  return;
                                }
                            </script>
                        </form>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        let value_ckb;

        $('.check_loi').click(function() {
            var id = '#maPhat_' + $(this).val();
            if ($(this).prop("checked") == true) {
                $(id).prop('disabled', false);
            } else {
                $(id).prop('disabled', true);
            }

            var id = '#example-url-input' + $(this).val();
            if ($(this).prop("checked") == true) {
                $(id).prop('disabled', false);
            } else {
                $(id).prop('disabled', true);
            }
        });

        var tra_sach_btn = $('#tra_sach_btn')
        tra_sach_btn.prop('disabled', true)
        $('.checkbox-tra-sach').click(function() {
            if ($(this).prop("checked") == true) {
                tra_sach_btn.prop('disabled', false);
            } else {
                var is_uncheck_all = true
                for(let i = 0; i < $('.checkbox-tra-sach').length; i++){
                    if ($('.checkbox-tra-sach')[i].checked == true) {
                        is_uncheck_all = false;
                        break;
                    }
                }
                tra_sach_btn.prop('disabled', is_uncheck_all);
            }
        });

        // const tra_sach_btn = $("#tra_sach_btn")
        // tra_sach_btn.prop('disabled', true);
        // const checkboxs = $('.checkbox-tra-sach')

        // checkbox.forEach(cb => {
        //     cb.click(function() {
        //         if ($(this).prop("checked") == true) {
        //         tra_sach_btn.prop('disabled', false);
        //     }
        //     })
        // });
        // for (let i = 0; i < checkboxs.length; i++) {
        //     if (ch)
        // }

        console.log(checkboxs);
    });
</script>
@endsection
