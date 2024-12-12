<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu Cầu Đặt Lại Mật Khẩu</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Căn chỉnh và phong cách chung */
        body {
            background-color: #faf8f0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #f9c74f;
            color: #333333;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .email-content {
            padding: 30px;
            text-align: center;
        }

        .email-content p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 16px;
        }

        .reset-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #f9c74f;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .reset-button:hover {
            background-color: #f9844a;
            color: #fff;
        }

        .email-footer {
            background-color: #fff3cd;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #856404;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Yêu Cầu Đặt Lại Mật Khẩu</h1>
        </div>
        <div class="email-content">
            <p>Xin chào Bạn</p>
            <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấn vào liên kết bên dưới để đặt lại mật khẩu:</p>
            <a href="{{ route('ShowFormResetPasswoek') }}" class="reset-button">Đặt Lại Mật Khẩu</a>
            <p style="margin-top: 20px;">Nếu bạn không yêu cầu thay đổi mật khẩu, hãy bỏ qua email này.</p>
        </div>
        <div class="email-footer">
            <p>Trân trọng,<br>Đội ngũ Hỗ trợ nhóm 1 sẽ hỗ trợ bạn</p>
        </div>
    </div>

    <!-- Link Bootstrap JS (nếu cần) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
