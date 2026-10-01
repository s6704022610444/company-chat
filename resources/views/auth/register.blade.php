<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CompanyChat</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .logo {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #16a34a;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #094e2e 0%, #16a34a 100%);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(9, 78, 46, 0.25);
            transition: all 0.2s;
        }

        button:hover {
            filter: brightness(1.1);
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #0c683f;
            text-decoration: none;
            font-weight: 600;
        }

        .error {
            color: #dc2626;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <div class="logo">
        CompanyChat
    </div>

    <div class="subtitle">
        สร้างบัญชีใหม่
    </div>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <label for="name">ชื่อ</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="กรอกชื่อ"
            required
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="กรอก Email"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="กรอกรหัสผ่าน"
            required
        >

        <label for="password_confirmation">ยืนยัน Password</label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="กรอกรหัสผ่านอีกครั้ง"
            required
        >

        <button type="submit">
            สมัครสมาชิก
        </button>
    </form>

    <div class="links">
        มีบัญชีแล้ว?
        <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
    </div>

</div>

</body>
</html>