<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CompanyChat</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

        <script>
        (function() {
            try {
                var theme = localStorage.getItem('companychat_theme') || 'light';
                document.documentElement.setAttribute('data-theme', theme);
            } catch(e) {}
        })();
    </script>
    <style>
        :root {
            --bg-page: #f9f9f9;
            --bg-card: #ffffff;
            --border-card: #e5e5e5;
            --text-title: #0f0f0f;
            --text-muted: #606060;
            --input-bg: #f8fafc;
            --input-border: #cbd5e1;
            --input-focus: #065fd4;
            --btn-bg: #0f0f0f;
            --btn-hover: #272727;
            --btn-text: #ffffff;
            --link-color: #065fd4;
        }

        [data-theme="dark"] {
            --bg-page: #0f0f0f;
            --bg-card: #181818;
            --border-card: #272727;
            --text-title: #f1f1f1;
            --text-muted: #aaaaaa;
            --input-bg: #121212;
            --input-border: #383838;
            --input-focus: #3ea6ff;
            --btn-bg: #f1f1f1;
            --btn-hover: #ffffff;
            --btn-text: #0f0f0f;
            --link-color: #3ea6ff;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Prompt', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-page);
            color: var(--text-title);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.2s, color 0.2s;
        }

        .login-box {
            width: 400px;
            max-width: 90vw;
            background: var(--bg-card);
            padding: 35px;
            border-radius: 16px;
            border: 1px solid var(--border-card);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }

        .logo {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-title);
        }

        .subtitle {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 26px;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            font-size: 13.5px;
            color: var(--text-title);
        }

        input {
            width: 100%;
            padding: 11px 14px;
            margin-bottom: 18px;
            border: 1px solid var(--input-border);
            border-radius: 9px;
            font-size: 14.5px;
            background: var(--input-bg);
            color: var(--text-title);
            font-family: inherit;
            outline: none;
            transition: all 0.15s;
        }

        input:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 2px rgba(6, 95, 212, 0.2);
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 9px;
            background: var(--btn-bg);
            color: var(--btn-text);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            transition: all 0.18s;
            font-family: inherit;
        }

        button:hover {
            background: var(--btn-hover);
            transform: scale(1.01);
        }

        .links {
            text-align: center;
            margin-top: 22px;
            font-size: 13.5px;
            color: var(--text-muted);
        }

        .links a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: 600;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .error {
            color: #ef4444;
            margin-bottom: 15px;
            font-size: 13.5px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <div style="text-align: center; margin-bottom: 12px;">
        <img src="{{ asset('logo.png') }}" alt="CompanyChat Logo" style="width: 76px; height: 76px; object-fit: contain; border-radius: 16px; display: inline-block; filter: drop-shadow(0 4px 12px rgba(0, 200, 83, 0.25));">
    </div>

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

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div>
                <label for="first_name">ชื่อจริง</label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    placeholder="กรอกชื่อจริง"
                    required
                    autocomplete="given-name"
                >
            </div>
            <div>
                <label for="last_name">นามสกุล</label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name') }}"
                    placeholder="กรอกนามสกุล"
                    required
                    autocomplete="family-name"
                >
            </div>
        </div>

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