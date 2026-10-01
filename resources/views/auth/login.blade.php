<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>เข้าสู่ระบบ - CompanyChat</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        (function() {
            try {
                var theme = localStorage.getItem('companychat_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            } catch(e) {}
        })();
    </script>

    <style>
        :root {
            --bg-page: #f8fafc;
            --bg-page-glow: radial-gradient(circle at 50% 12%, rgba(0, 200, 83, 0.09) 0%, transparent 60%),
                            radial-gradient(circle at 85% 85%, rgba(0, 176, 255, 0.05) 0%, transparent 50%),
                            #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.92);
            --card-border: rgba(0, 0, 0, 0.08);
            --card-shadow: 0 20px 50px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
            --text-title: #0f172a;
            --text-subtitle: #475569;
            --text-label: #334155;
            --input-bg: #f8fafc;
            --input-border: #cbd5e1;
            --input-focus-border: #00C853;
            --input-focus-ring: rgba(0, 200, 83, 0.2);
            --btn-gradient: linear-gradient(135deg, #00C853 0%, #00a844 100%);
            --btn-hover-gradient: linear-gradient(135deg, #05dc5e 0%, #00b84b 100%);
            --btn-shadow: 0 6px 20px rgba(0, 200, 83, 0.35);
            --btn-hover-shadow: 0 10px 28px rgba(0, 200, 83, 0.45);
            --btn-text: #ffffff;
            --link-color: #00C853;
            --link-hover: #00a844;
            --theme-toggle-bg: #ffffff;
            --theme-toggle-border: #e2e8f0;
            --theme-toggle-color: #475569;
        }

        [data-theme="dark"] {
            --bg-page: #08080a;
            --bg-page-glow: radial-gradient(circle at 50% 10%, rgba(0, 200, 83, 0.12) 0%, transparent 50%),
                            radial-gradient(circle at 80% 80%, rgba(0, 176, 255, 0.06) 0%, transparent 45%),
                            #08080a;
            --card-bg: rgba(20, 20, 24, 0.88);
            --card-border: rgba(255, 255, 255, 0.08);
            --card-shadow: 0 24px 60px rgba(0, 0, 0, 0.7), 0 0 1px rgba(255, 255, 255, 0.12) inset;
            --text-title: #f8fafc;
            --text-subtitle: #94a3b8;
            --text-label: #cbd5e1;
            --input-bg: rgba(15, 15, 18, 0.7);
            --input-border: #2a2a30;
            --input-focus-border: #00C853;
            --input-focus-ring: rgba(0, 200, 83, 0.25);
            --btn-gradient: linear-gradient(135deg, #00C853 0%, #00a844 100%);
            --btn-hover-gradient: linear-gradient(135deg, #05dc5e 0%, #00b84b 100%);
            --btn-shadow: 0 6px 22px rgba(0, 200, 83, 0.4);
            --btn-hover-shadow: 0 10px 30px rgba(0, 200, 83, 0.55);
            --btn-text: #ffffff;
            --link-color: #22c55e;
            --link-hover: #4ade80;
            --theme-toggle-bg: #18181b;
            --theme-toggle-border: #27272a;
            --theme-toggle-color: #e4e4e7;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-page-glow);
            color: var(--text-title);
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 24px 16px;
            position: relative;
            overflow-x: hidden;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Ambient Glow Blobs */
        .ambient-glow-top {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            height: 350px;
            background: radial-gradient(circle, rgba(0, 200, 83, 0.18) 0%, rgba(0, 200, 83, 0) 70%);
            pointer-events: none;
            filter: blur(40px);
            z-index: 0;
        }

        /* Theme Toggle Float Button */
        .theme-toggle-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--theme-toggle-bg);
            border: 1px solid var(--theme-toggle-border);
            color: var(--theme-toggle-color);
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 10;
        }

        .theme-toggle-btn:hover {
            transform: scale(1.06);
            border-color: #00C853;
        }

        /* Main Card */
        .auth-card {
            width: 420px;
            max-width: 100%;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px 34px;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            position: relative;
            z-index: 1;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 32px 22px;
                border-radius: 20px;
            }
        }

        /* Brand Header */
        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 82px;
            height: 82px;
            border-radius: 22px;
            margin-bottom: 16px;
            position: relative;
            background: linear-gradient(145deg, rgba(0, 200, 83, 0.12), rgba(0, 176, 255, 0.08));
            border: 1px solid rgba(0, 200, 83, 0.25);
            box-shadow: 0 10px 30px rgba(0, 200, 83, 0.25);
            transition: transform 0.3s ease;
        }

        .logo-wrap:hover {
            transform: translateY(-2px) scale(1.03);
        }

        .logo-img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            display: block;
            border-radius: 17px;
        }

        .brand-title {
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -0.6px;
            color: var(--text-title);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .brand-subtitle {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-subtitle);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .brand-badge {
            display: inline-block;
            background: rgba(0, 200, 83, 0.14);
            color: #00C853;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            border: 1px solid rgba(0, 200, 83, 0.3);
        }

        /* Form */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            font-size: 13.5px;
            color: var(--text-label);
            letter-spacing: 0.1px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-subtitle);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 42px;
            border: 1px solid var(--input-border);
            border-radius: 12px;
            font-size: 14.5px;
            background: var(--input-bg);
            color: var(--text-title);
            font-family: inherit;
            outline: none;
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        input:focus {
            border-color: var(--input-focus-border);
            background: var(--card-bg);
            box-shadow: 0 0 0 3px var(--input-focus-ring);
        }

        input::placeholder {
            color: var(--text-subtitle);
            opacity: 0.6;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 50px;
            margin-top: 8px;
            border: none;
            border-radius: 13px;
            background: var(--btn-gradient);
            color: var(--btn-text);
            font-size: 15.5px;
            font-weight: 700;
            letter-spacing: 0.2px;
            cursor: pointer;
            box-shadow: var(--btn-shadow);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--btn-hover-gradient);
            box-shadow: var(--btn-hover-shadow);
            transform: translateY(-2px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Links */
        .links-area {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--card-border);
            font-size: 13.5px;
            color: var(--text-subtitle);
        }

        .links-area a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: 700;
            margin-left: 4px;
            transition: color 0.15s;
        }

        .links-area a:hover {
            color: var(--link-hover);
            text-decoration: underline;
        }

        /* Error Alert */
        .error-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #ef4444;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
        }

        /* Footer Security Tag */
        .security-badge {
            margin-top: 20px;
            font-size: 12px;
            color: var(--text-subtitle);
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0.75;
            z-index: 1;
        }
    </style>
</head>

<body>

    <div class="ambient-glow-top"></div>

    <!-- Theme Toggle -->
    <button type="button" class="theme-toggle-btn" onclick="toggleTheme()" aria-label="สลับธีม" title="สลับโหมดมืด/สว่าง">
        <span id="themeIcon">☀️</span>
    </button>

    <div class="auth-card">

        <!-- Brand Header -->
        <div class="brand-header">
            <div class="logo-wrap">
                <img src="{{ asset('logo.png') }}" alt="CompanyChat" class="logo-img">
            </div>
            <h1 class="brand-title">CompanyChat</h1>
            <div class="brand-subtitle">
                <span>เข้าสู่ระบบเพื่อเริ่มการทำงาน</span>
                <span class="brand-badge">Official</span>
            </div>
        </div>

        @if ($errors->any())
            <div class="error-alert">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="form-group">
                <label for="email">อีเมล (Company Email)</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@company.com"
                        required
                        autofocus
                        autocomplete="email"
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">รหัสผ่าน (Password)</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="กรอกรหัสผ่านของคุณ"
                        required
                        autocomplete="current-password"
                    >
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <span>เข้าสู่ระบบ</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>
        </form>

        <div class="links-area">
            <span>ยังไม่มีบัญชีผู้ใช้งาน?</span>
            <a href="{{ route('register') }}">สมัครสมาชิกใหม่</a>
        </div>

    </div>

    <!-- Security badge -->
    <div class="security-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        <span>ระบบความปลอดภัยองค์กร • เข้ารหัสข้อมูลแบบ End-to-End</span>
    </div>

    <script>
        function updateThemeIcon(theme) {
            const icon = document.getElementById('themeIcon');
            if (icon) {
                icon.textContent = theme === 'dark' ? '☀️' : '🌙';
            }
        }

        function toggleTheme() {
            const current = document.documentElement.getAttribute('data-theme') || 'dark';
            const next = current === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', next);
            localStorage.setItem('companychat_theme', next);
            updateThemeIcon(next);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const theme = document.documentElement.getAttribute('data-theme') || 'dark';
            updateThemeIcon(theme);
        });
    </script>

</body>
</html>