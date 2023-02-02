<div>
    <p>Xin chào!</p>
    <p>Chào mừng bạn đến với Thư viện học viện công nghệ BKACAD, dưới đây là phiếu mượn sách của bạn.</p>
<div style="width: 600px; margin: 0 auto; padding: 15px;">

    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%">
        <tr>
            <th> Tên Độc Giả </th>
            <td>{{$phieumuon->ho_ten}}</td>
        </tr>
        <tr>
            <th> Sách Mượn</th>
            <td>
                {{-- @foreach ($phieumuon as $key => $phieumuons ) --}}
                {{$phieumuon->ten_sach}}
                {{-- @if ($key != count($phieumuon)-1)
                ,
                @endif
                @endforeach --}}
            </td>
        </tr>
        <tr>
            <th> Ngày Mượn </th>
            <td>{{$phieumuon->ngay_muon}}</td>
        </tr>
        <tr>
            <th> Hạn Trả </th>
            <td>{{$phieumuon->han_tra}}</td>
        </tr>
    </table>
</div>
</div>
