@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" style="margin-top: 4vh;">
            <h5 class="font-weight-bolder mb-0"> Thống kê </h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" style="margin-top: 5vh;">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold"> Số Độc Giả</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{count($docgias)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="/docgia">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold"> Số Loại Sách </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{count($sosach)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="/trangchu">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Số Phiếu Mượn</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{count($phieumuons)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="/phieumuon">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-bold-right" aria-hidden="true"></i>
                                    </div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold"> Số Sách Đang Mượn </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{count($chitiets)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-bold-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <form autocomplete="off" action="{{route('thong_ke')}}" method="get">
                @csrf
                <table style="margin-left: 250px">
                    <tr>
                        <td>
                            <input type="date" name="from_date" class="form-control" id="datepicker" placeholder="Tu ngay" style="width:200px">
                        </td>
                        <td>
                            <input type="date" name="to_date" class="form-control" id="datepicker2" placeholder="Den ngay" style="width:200px">
                        </td>
                        <td style="padding-top: 2vh">
                            <button type="submit" id="btn-dashboard-filter"  class="btn btn-primary"> Lọc Kết Quả </button>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive product-table">
                            <h2 style="text-align: center"> <b> Thống kê doanh thu </b></h2>
                {{-- <div id="myfirstchart" style="height: 200px; width:50%; margin-left:5vh"></div> --}}


                            <div class="row">
                                <div class="col-sm-6 text-center">
                                  <label class="label label-success">Phí mượn</label>
                                  <div id="area-chart" ></div>
                                </div>
                                <div class="col-sm-6 text-center">
                                   <label class="label label-success">Lỗi phạt</label>
                                  <div id="line-chart"></div>
                                </div>

                              </div>
            <br><br><br>


                <div class="card-body">
                    <div class="table-responsive product-table">
                            <h2 style="text-align: center"> <b> Thống kê sách </b></h2>
                <div id="bar-example" style="height: 200px; width:90%; margin-left:5vh"></div>
            <br><br><br>

            <script>
                $(document).ready(function() {
                    // var chart = new Morris.Line({
                    //     element: 'myfirstchart',
                    //     lineColors:['gray', 'red'],
                    //     fillOpacity: 0.6,
                    //     data: [<?php
                    //             if(isset($data1)){
                    //                 foreach($data1 as $item){
                    //                     echo "{'ngay':'" . $item->ngay . "','phimuon':'".$item->phimuon."','loiphat':".$item->loiphat.",},";
                    //                     }
                    //                 }
                    //             ?>
                    //     ],
                    //     xkey: 'ngay',
                    //     ykeys: ['phimuon','loiphat'],
                    //     behaveLikeLine: true,
                    //     labels: ['Phí mượn','Lỗi phạt']
                    // });

                    //phimuon
                    var data = [<?php
                        if(isset($data1)){
                            foreach($data1 as $item){
                                echo "{'ngay':'" . $item->ngay . "','phimuon':".$item->phimuon.",},";
                                }
                            }
                        ?>
                        ],
                        config = {
                        data: data,
                        xkey: 'ngay',
                        ykeys: ['phimuon'],
                        labels: ['Phí mượn'],
                        fillOpacity: 0.6,
                        hideHover: 'auto',
                        behaveLikeLine: true,
                        resize: true,
                        pointFillColors:['#ffffff'],
                        pointStrokeColors: ['black'],
                        lineColors:['gray','red']
                    };
                        config.element = 'area-chart';
                        Morris.Area(config);
                    //loiphat
                    var data = [<?php
                        if(isset($data2)){
                            foreach($data2 as $item){
                                echo "{'ngaytra':'" . $item->ngaytra . "','loiphat':".$item->loiphat.",},";
                                }
                            }
                        ?>
                        ],
                        config = {
                        data: data,
                        xkey: 'ngaytra',
                        ykeys: ['loiphat'],
                        labels: ['Lỗi phạt'],
                        fillOpacity: 0.6,
                        hideHover: 'auto',
                        behaveLikeLine: true,
                        resize: true,
                        pointFillColors:['#ffffff'],
                        pointStrokeColors: ['black'],
                        lineColors:['gray','red']
                    };
                    config.element = 'line-chart';
                    Morris.Line(config);
                });
                    //sach
                    var chart = new Morris.Bar({
                        element: 'bar-example',
                        parseTime: false,

                        data: [<?php
                                if(isset($data)){
                                    foreach($data as $item){
                                        echo "{'ten':'".$item->ten."','nguoimuon':".$item->nguoimuon.",},";
                                        }
                                    }
                                ?>
                            ],
                        xkey: 'ten',

                        ykeys: ['nguoimuon'],
                        behaveLikeLine: true,

                        labels: ['Số người mượn']

                        });
                        // })
                    </script>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
