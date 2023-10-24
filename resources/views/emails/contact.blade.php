<!DOCTYPE html>
<html>
<head>
    <title>https://kenjivietnam.vn/</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Khách hàng muốn tư vấn sản phẩm:</h1>
<p>Họ tên khách hàng: {{ $details['customer_name'] ?? '' }}</p>
<p>Điện thoại: {{ $details['phone'] ?? '' }}</p>
<p>Nội dung yêu cầu:</p>
<p>{{ $details['description'] ?? '' }}</p>

<p><a href="{{ Route('backend.advise.index') }}" target="_blank">Đăng nhập vào xem</a></p>
</body>
</html>
