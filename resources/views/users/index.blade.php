<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสิทธิ์ผู้ใช้ - CompanyChat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0b0f19;
            --bg-secondary: #111827;
            --bg-surface: #1e293b;
            --border-color: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.16);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
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
            color: #cbd5e1;
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
            background: rgba(255, 255, 255, 0.1);
            color: white;
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
            color: #ffffff;
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
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(236, 72, 153, 0.2));
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .role-manager {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(59, 130, 246, 0.2));
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.35);
        }

        .role-supervisor {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(20, 184, 166, 0.2));
            color: #34d399;
            border: 1px solid rgba(52, 211, 153, 0.35);
        }

        .role-staff {
            background: rgba(148, 163, 184, 0.15);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.25);
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
            color: white;
            font-family: inherit;
            font-size: 13.5px;
            outline: none;
            cursor: pointer;
            min-width: 170px;
            transition: all 0.2s;
        }

        select:focus {
            border-color: #3b82f6;
        }

        .btn-update {
            background: var(--accent-gradient);
            border: none;
            color: white;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
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
            color: #cbd5e1;
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
            color: white;
            display: block;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h1 class="page-title">
            <span>🔐</span>
            <span>จัดการสิทธิ์และตำแหน่งผู้ใช้</span>
        </h1>

        <a href="{{ route('dashboard') }}" class="btn-back">
            ← กลับหน้าแชต
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px; color: var(--text-secondary); font-size: 14px;">
        รายชื่อสมาชิกทั้งหมดในระบบ ({{ $users->count() }} ท่าน)
    </div>

    @foreach($users as $user)
        <div class="user-card">
            <div class="user-left">
                <div class="user-avatar">
                    {{ strtoupper(mb_substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <div class="user-info-name">{{ $user->name }}</div>
                    <div class="user-info-email">{{ $user->email }}</div>
                    <div>
                        @php
                            $roleClass = match($user->position) {
                                'ผู้ดูแลระบบ' => 'role-admin',
                                'ผู้จัดการ' => 'role-manager',
                                'หัวหน้างาน' => 'role-supervisor',
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
                        👤 พนักงาน
                    </option>
                    <option value="หัวหน้างาน" {{ $user->position === 'หัวหน้างาน' ? 'selected' : '' }}>
                        👔 หัวหน้างาน
                    </option>
                    <option value="ผู้จัดการ" {{ $user->position === 'ผู้จัดการ' ? 'selected' : '' }}>
                        💼 ผู้จัดการ
                    </option>
                    <option value="ผู้ดูแลระบบ" {{ $user->position === 'ผู้ดูแลระบบ' ? 'selected' : '' }}>
                        👑 ผู้ดูแลระบบ
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
        <h3>📖 สรุปโครงสร้างสิทธิ์การใช้งานทั้ง 4 ระดับ</h3>
        <div class="guide-grid">
            <div class="guide-item">
                <strong style="color: #cbd5e1;">👤 พนักงาน</strong>
                - ดูงานที่ได้รับมอบหมาย<br>
                - อัปเดตสถานะงานตัวเอง<br>
                - สนทนาในห้องแชต
            </div>
            <div class="guide-item">
                <strong style="color: #34d399;">👔 หัวหน้างาน</strong>
                - ดูงานทั้งหมดของทีม<br>
                - สร้างและมอบหมายงาน<br>
                - แก้ไข/ลบงานที่ดูแล
            </div>
            <div class="guide-item">
                <strong style="color: #38bdf8;">💼 ผู้จัดการ</strong>
                - จัดการงานทั้งหมดในระบบ<br>
                - สร้างห้องสนทนาใหม่<br>
                - ติดตาม Dashboard สรุปงาน
            </div>
            <div class="guide-item">
                <strong style="color: #fbbf24;">👑 ผู้ดูแลระบบ</strong>
                - สิทธิ์สูงสุดทุกฟังก์ชัน<br>
                - ปรับเปลี่ยนตำแหน่งผู้ใช้<br>
                - ลบห้องสนทนาที่ไม่ใช้งาน
            </div>
        </div>
    </div>

</div>

</body>
</html>