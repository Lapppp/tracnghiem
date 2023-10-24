<!DOCTYPE html>
<html>
<head>
    <title>https://kenjivietnam.vn/</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Để thay đổi mật khẩu, Anh/chị  click vào liên kết bên dưới:</h1>
<p><a href="{{ Route('frontend.auth.resetPassword',['token'=>$details['token'],'key'=>$details['password']]) }}" target="_blank">Thay đổi mật khẩu</a></p>
<p>Thank you</p>
</body>
</html>
