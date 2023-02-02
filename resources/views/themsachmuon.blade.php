@extends('layouts.master')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h5 class="font-weight-bolder mb-0"> Thêm Sách Mượn </h5>
      </nav>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
    <div class="card">
<div class="mainForm">
  <form method="POST" style="padding-left: 30px; padding-top:30px; padding-right:30px" >
    @csrf
    <div class="form-group">
        <b> Tên Sách </b>
        <select name="ma_sach" class="form-control" style="width: 250px;">
          @foreach ($sachs as $item)
              <option value="{{$item->ma_sach}}">{{$item->ten_sach}}</option>
          @endforeach
        </select>
    </div>
    {{-- <div class="form-group">
        <b> Ngày Trả </b>
        <input class="form-control" type="datetime-local" id="example-search-input" name="ngay_tra">
    </div> --}}
    <div class="form-group">
        <b> Trạng Thái </b>
        <select name="tinh_trang" class="form-control" style="width: 250px;" id='tinh_trang'>
              <option value="Chưa trả"> Chưa Trả </option>
              <option value="Đã trả"> Đã Trả </option>
        </select>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" type="submit"> Thêm </button>
    </div>
</form>
</div>
    </div>
    </div>
    </div>
  </div>
  @endsection
