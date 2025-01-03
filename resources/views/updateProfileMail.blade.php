<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body>

    <table>
        <tr>
            <th>Họ tên:</th>
            <th>{{$data['name'] }}</th>
        </tr>
        <tr>
            <th>Email:</th>
            <th>{{$data['email'] }}</th>
        </tr>
    </table>
<p><b>Note:- </b> Bạn có thể sử dụng mật khẩu cũ để đăng nhập! </p>
<a href="{{ $data['url'] }}">Nhấn vào link để đăng nhập </a>
<p>Trân trọng cảm ơn!</p>
</body>
</html>
