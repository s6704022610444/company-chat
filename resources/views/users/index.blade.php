<!DOCTYPE html>
<html lang="th">
<head>
    <script>(function(){try{var t=localStorage.getItem("companychat_theme")||"light";document.documentElement.setAttribute("data-theme",t);}catch(e){}})();</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสิทธิ์ผู้ใช้ - CompanyChat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #ffffff;
            --bg-surface: #f9f9f9;
            --border-color: #e5e5e5;
            --border-hover: #cbd5e1;
            --text-primary: #0f0f0f;
            --text-secondary: #606060;
            --accent-gradient: #0f0f0f;
            --btn-update-bg: #0f0f0f;
            --btn-update-text: #ffffff;
            --role-staff-text: #475569;
            --role-staff-bg: rgba(148, 163, 184, 0.2);
            --role-staff-border: rgba(148, 163, 184, 0.35);
        }

        [data-theme="dark"] {
            --bg-primary: #0f0f0f;
            --bg-secondary: #181818;
            --bg-surface: #212121;
            --border-color: #272727;
            --border-hover: #383838;
            --text-primary: #f1f1f1;
            --text-secondary: #aaaaaa;
            --accent-gradient: #f1f1f1;
            --btn-update-bg: #f1f1f1;
            --btn-update-text: #0f0f0f;
            --role-staff-text: #cbd5e1;
            --role-staff-bg: rgba(148, 163, 184, 0.15);
            --role-staff-border: rgba(148, 163, 184, 0.25);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        .container {
            width: 92%;
            max-width: 960px;
            margin: 35px auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-primary);
            text-decoration: none;
            background: var(--bg-surface);
            padding: 8px 16px;
            border-radius: 9px;
            border: 1px solid var(--border-color);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--border-color);
            color: var(--text-primary);
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #6ee7b7;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* User Card */
        .user-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            transition: all 0.2s;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .user-card:hover {
            border-color: var(--border-hover);
        }

        .user-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-avatar {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--accent-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .user-info-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .user-info-email {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .role-pill {
            display: inline-block;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 6px;
        }

        .role-admin {
            background: rgba(255, 61, 0, 0.15);
            color: #FF3D00;
            border: 1px solid rgba(255, 61, 0, 0.4);
        }

        .role-manager {
            background: rgba(255, 179, 0, 0.15);
            color: #FFB300;
            border: 1px solid rgba(255, 179, 0, 0.4);
        }

        .role-supervisor {
            background: rgba(0, 176, 255, 0.15);
            color: #00B0FF;
            border: 1px solid rgba(0, 176, 255, 0.4);
        }

        .role-staff {
            background: rgba(0, 200, 83, 0.15);
            color: #00C853;
            border: 1px solid rgba(0, 200, 83, 0.4);
        }

        .role-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        select {
            padding: 9px 14px;
            border-radius: 8px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-family: inherit;
            font-size: 13.5px;
            outline: none;
            cursor: pointer;
            min-width: 170px;
            transition: all 0.2s;
        }

        select option {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        select:focus {
            border-color: #3b82f6;
        }

        .btn-update {
            background: var(--btn-update-bg);
            border: none;
            color: var(--btn-update-text);
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transition: all 0.2s;
        }

        .btn-update:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
        }

        .role-guide {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            margin-top: 30px;
        }

        .role-guide h3 {
            font-size: 15px;
            margin-bottom: 12px;
            color: var(--text-primary);
        }

        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .guide-item {
            background: var(--bg-surface);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        .guide-item strong {
            color: var(--text-primary);
            display: block;
            margin-bottom: 4px;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                margin: 15px auto;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .page-title {
                font-size: 20px;
            }

            .user-card {
                flex-direction: column;
                align-items: stretch;
                gap: 14px;
                padding: 16px;
            }

            .role-form {
                flex-direction: column;
                align-items: stretch;
            }

            select {
                width: 100%;
            }

            .btn-update {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h1 class="page-title">
            <span>จัดการสิทธิ์และตำแหน่งผู้ใช้</span>
        </h1>

        <a href="{{ route('dashboard') }}" class="btn-back">
            ← กลับหน้าแชต
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px; color: var(--text-secondary); font-size: 14px;">
        รายชื่อสมาชิกทั้งหมดในระบบ ({{ $users->count() }} ท่าน)
    </div>

    @foreach($users as $user)
        <div class="user-card">
            <div class="user-left">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" style="width: 46px; height: 46px; border-radius: 12px; object-fit: cover; flex-shrink: 0; border: 1px solid var(--border-color);" alt="{{ $user->name }}">
                @else
                    <div class="user-avatar">
                        {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <div class="user-info-name">{{ $user->name }}</div>
                    <div class="user-info-email">{{ $user->email }}</div>
                    <div>
                        @php
                            $roleClass = match($user->position) {
                                'ผู้ดูแลระบบ', 'แอดมิน', 'Admin' => 'role-admin',
                                'ผู้บริหาร', 'ผู้จัดการ', 'Manager', 'Executive' => 'role-manager',
                                'หัวหน้างาน', 'Supervisor' => 'role-supervisor',
                                default => 'role-staff',
                            };
                        @endphp
                        <span class="role-pill {{ $roleClass }}">
                            {{ $user->position }}
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('users.position', $user) }}" class="role-form">
                @csrf
                @method('PUT')

                <select name="position">
                    <option value="พนักงาน" {{ $user->position === 'พนักงาน' ? 'selected' : '' }}>
                        พนักงาน
                    </option>
                    <option value="หัวหน้างาน" {{ $user->position === 'หัวหน้างาน' ? 'selected' : '' }}>
                        หัวหน้างาน
                    </option>
                    <option value="ผู้บริหาร" {{ in_array($user->position, ['ผู้บริหาร', 'ผู้จัดการ', 'Manager', 'Executive']) ? 'selected' : '' }}>
                        ผู้บริหาร
                    </option>
                    <option value="ผู้ดูแลระบบ" {{ in_array($user->position, ['ผู้ดูแลระบบ', 'แอดมิน', 'Admin']) ? 'selected' : '' }}>
                        ผู้ดูแลระบบ
                    </option>
                </select>

                <button type="submit" class="btn-update">
                    บันทึกสิทธิ์
                </button>
            </form>
        </div>
    @endforeach

    {{-- Role Permissions Summary Guide --}}
    <div class="role-guide">
        <h3>สรุปโครงสร้างสิทธิ์การใช้งานทั้ง 4 ระดับ</h3>
        <div class="guide-grid">
            <div class="guide-item">
                <strong style="color: #00C853;">1. พนักงาน</strong><br>
                - ดูงานที่ได้รับมอบหมาย<br>
                - อัปเดตสถานะงานตัวเอง<br>
                - สนทนาในห้องแชต
            </div>
            <div class="guide-item">
                <strong style="color: #00B0FF;">2. หัวหน้างาน</strong><br>
                - ดูงานทั้งหมดของทีม<br>
                - สร้างและมอบหมายงาน<br>
                - แก้ไข/ลบงานที่ดูแล
            </div>
            <div class="guide-item">
                <strong style="color: #FFB300;">3. ผู้บริหาร</strong><br>
                - จัดการงานทั้งหมดในระบบ<br>
                - สร้างห้องสนทนาใหม่<br>
                - ติดตาม Dashboard สรุปงาน
            </div>
            <div class="guide-item">
                <strong style="color: #FF3D00;">4. แอดมิน / ผู้ดูแลระบบ</strong><br>
                - สิทธิ์สูงสุดทุกฟังก์ชัน<br>
                - ปรับเปลี่ยนตำแหน่งผู้ใช้<br>
                - ลบห้องสนทนาที่ไม่ใช้งาน
            </div>
        </div>
    </div>

</div>

</body>
</html>