<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <p>Xin chào bạn,</p>
    <p>Chúng tôi nhận được yêu cầu thiết lập lại mật khẩu cho tài khoản KTC Store của bạn. </p>
    <div>
     Nhấn <a href="http:127.0.0.1:8000/reset_password/token={{$password_token}}&email={{$email}}">tại đây</a> để thiết lập mật khẩu mới cho tài khoản KTC Store của bạn.
     Hoặc vui lòng copy và dán đường dẫn bên dưới tới trình duyệt:
     <a href="http:127.0.0.1:8000/reset_password/token={{$password_token}}&email={{$email}}">http:127.0.0.1:8000/reset_password/token={{$password_token}}&email={{$email}}</a>
    </div>
    <p>Trân trọng,</p>
    <p>Đội ngũ KTC Store</p>

</body>
</html>
