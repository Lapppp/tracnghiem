<!DOCTYPE html>
<html>
<head>
    <title>https://kenjivietnam.vn/</title>
    <meta charset="UTF-8">
</head>
<body>
<p>Khách hàng có số điện thoại {{ $details['phone'] ?? '' }} vừa đặt hàng tại kenjivietnam.vn</p>
<p><a href="{{ Route('backend.order.show',['id'=>$details['order_id']]) }}" target="_blank">Xem chi tiết đơn hàng</a></p>
</body>
</html>
