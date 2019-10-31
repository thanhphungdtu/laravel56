<font face="Arial">
    <div>
        <div></div>
        <h3><font color="#FF9600">Thông tin khách hàng</font></h3>
        <p>
            <strong class="info">Khách hàng: </strong>
            {{ $info['username'] }}
        </p>
        <p>
            <strong class="info">Email: </strong>
            {{ $info['email'] }}
        </p>
        <p>
            <strong class="info">Điện thoại: </strong>
            {{ $info['phone'] }}
        </p>
        <p>
            <strong class="info">Địa chỉ: </strong>
            {{ $info['adress'] }}
        </p>
    </div>
    <div>
        <h3><font color="#FF9600">Hóa đơn mua hàng</font></h3>
        <table border="1" cellspacing="0">
            <tr>
                <td><strong>Tên sản phẩm</strong></td>
                <td><strong>Giá</strong></td>
                <td><strong>Số lượng</strong></td>
                <td><strong>Thành tiền</strong></td>
            </tr>
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price,0,',','.') }} Đ</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->price * $item->qty,0,',','.') }} VNĐ</td>
                </tr>
            @endforeach
            <tr>
                <td>Tổng tiền:</td>
                <td colspan="3" align="right">{{ number_format($total,0,'',',') }} VNĐ</td>
            </tr>
        </table>
    </div>
    <div>
        <h3><font color="#FF9600">Quý khách đã đặt hàng thành công!</font></h3>
        <p>- Hóa đơn mua hàng của Quý khách đã được chuyển đến địa chỉ
            Email có trong phần thông tin khách hàng của chúng tôi.</p>
        <p>- Sản phẩm của Quý khách sẽ được chuyển đến địa chỉ có trong
            phần thông tin khách hàng của chúng tôi sau thời 2 đến đến 3
            ngày tính từ thời điểm này</p>
        <p>- Nhân viên giao hàng sẽ liên hệ với Quý khách qua số điện
            thoại trước khi giao hàng 24 tiếng.</p>
        <p>- Trụ sở chính: B&A Phạm Như Xương - Liên Chiểu - Đà Nẵng</p>
        <p>Cảm ơn Quý khách đã sử dụng công ty chúng tôi.</p>
    </div>
</font>