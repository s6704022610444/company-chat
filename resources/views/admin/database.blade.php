<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Database Explorer - CompanyChat</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            --bg-primary: #ffffff;
            --bg-secondary: #f9f9f9;
            --bg-surface: #f2f2f2;
            --border-color: #e5e5e5;
            --border-hover: #cbd5e1;
            --text-primary: #0f0f0f;
            --text-secondary: #606060;
            --accent-blue: #065fd4;
            --accent-indigo: #0f0f0f;
            --accent-gradient: #0f0f0f;
            --tab-active-bg: #0f0f0f;
            --tab-active-text: #ffffff;
            --th-bg: #f5f5f5;
            --th-color: #0f0f0f;
            --td-border: #f0f0f0;
            --role-staff-text: #475569;
            --role-staff-bg: rgba(148, 163, 184, 0.2);
        }

        [data-theme="dark"] {
            --bg-primary: #0f0f0f;
            --bg-secondary: #181818;
            --bg-surface: #212121;
            --border-color: #272727;
            --border-hover: #383838;
            --text-primary: #f1f1f1;
            --text-secondary: #aaaaaa;
            --accent-blue: #3ea6ff;
            --accent-indigo: #f1f1f1;
            --accent-gradient: #f1f1f1;
            --tab-active-bg: #f1f1f1;
            --tab-active-text: #0f0f0f;
            --th-bg: #1e1e1e;
            --th-color: #f1f1f1;
            --td-border: rgba(255, 255, 255, 0.05);
            --role-staff-text: #cbd5e1;
            --role-staff-bg: rgba(148, 163, 184, 0.15);
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
            padding: 24px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 22px;
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

        /* DB Info Banner */
        .db-info-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 600;
        }

        .db-postgres {
            background: rgba(16, 185, 129, 0.15);
            color: #6ee7b7;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .db-sqlite {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--bg-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-val {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .stat-lbl {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Main Card */
        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        /* Table Tabs Header */
        .tabs-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 18px;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-surface);
            flex-wrap: wrap;
            gap: 12px;
        }

        .tabs-nav {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .tab-btn:hover {
            color: var(--text-primary);
            background: var(--border-color);
        }

        .tab-btn.active {
            background: var(--tab-active-bg);
            color: var(--tab-active-text);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        /* Search Box */
        .search-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-input {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            font-family: inherit;
        }

        .search-input:focus {
            border-color: var(--accent-blue);
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
            text-align: left;
        }

        th {
            background: var(--th-bg);
            color: var(--th-color);
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--td-border);
            color: var(--text-primary);
            vertical-align: middle;
        }

        tr:hover td {
            background: var(--bg-surface);
        }

        /* Badges */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .badge-role-admin { background: rgba(255, 61, 0, 0.15); color: #FF3D00; border: 1px solid rgba(255, 61, 0, 0.4); }
        .badge-role-manager { background: rgba(255, 179, 0, 0.15); color: #FFB300; border: 1px solid rgba(255, 179, 0, 0.4); }
        .badge-role-supervisor { background: rgba(0, 176, 255, 0.15); color: #00B0FF; border: 1px solid rgba(0, 176, 255, 0.4); }
        .badge-role-staff { background: rgba(0, 200, 83, 0.15); color: #00C853; border: 1px solid rgba(0, 200, 83, 0.4); }

        .badge-priority-urgent { background: rgba(239, 68, 68, 0.2); color: #f87171; }
        .badge-priority-high { background: rgba(245, 158, 11, 0.2); color: #fbbf24; }
        .badge-priority-normal { background: rgba(59, 130, 246, 0.2); color: var(--accent-blue); }
        .badge-priority-low { background: rgba(148, 163, 184, 0.15); color: #94a3b8; }

        .empty-state {
            padding: 50px 20px;
            text-align: center;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <div>
            <h1 class="page-title">
                <img src="{{ asset('logo.png') }}" alt="CompanyChat Logo" style="width: 32px; height: 32px; object-fit: contain; border-radius: 8px; flex-shrink: 0; vertical-align: middle;">
                <span>Database Explorer (ดูข้อมูลสดในระบบ)</span>
            </h1>
            <div style="margin-top: 6px; display: flex; align-items: center; gap: 10px;">
                @if($isPostgres)
                    <span class="db-info-badge db-postgres">
                        เชื่อมต่อ PostgreSQL (Cloud Database ถาวร)
                    </span>
                @else
                    <span class="db-info-badge db-sqlite">
                        ใช้ SQLite ชั่วคราว (Local)
                    </span>
                @endif
                <span style="font-size: 12px; color: var(--text-secondary);">
                    ฐานข้อมูล: <code style="color: #93c5fd;">{{ $dbName }}</code>
                </span>
            </div>
        </div>

        <div style="display: flex; gap: 10px;">
            <a href="{{ route('dashboard') }}" class="btn-back">
                ← กลับหน้าแชตหลัก
            </a>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="color: #60a5fa;">💬</div>
            <div>
                <div class="stat-val">{{ number_format($counts['messages']) }}</div>
                <div class="stat-lbl">ข้อความแชตทั้งหมด</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="color: #f59e0b;">📋</div>
            <div>
                <div class="stat-val">{{ number_format($counts['tasks']) }}</div>
                <div class="stat-lbl">งานและภารกิจ</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="color: #10b981;">👥</div>
            <div>
                <div class="stat-val">{{ number_format($counts['users']) }}</div>
                <div class="stat-lbl">ผู้ใช้งานในระบบ</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="color: #a855f7;">🚪</div>
            <div>
                <div class="stat-val">{{ number_format($counts['rooms']) }}</div>
                <div class="stat-lbl">ห้องสนทนา</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="color: #ec4899;">🕘</div>
            <div>
                <div class="stat-val">{{ number_format($counts['histories']) }}</div>
                <div class="stat-lbl">ประวัติการเปลี่ยนสถานะ</div>
            </div>
        </div>
    </div>

    <!-- Main Content Table Card -->
    <div class="card">

        <div class="tabs-header">
            <div class="tabs-nav">
                <a href="{{ route('admin.database', ['tab' => 'messages']) }}" class="tab-btn {{ $tab === 'messages' ? 'active' : '' }}">
                    💬 ข้อความแชต ({{ $counts['messages'] }})
                </a>
                <a href="{{ route('admin.database', ['tab' => 'tasks']) }}" class="tab-btn {{ $tab === 'tasks' ? 'active' : '' }}">
                    📋 ภารกิจ ({{ $counts['tasks'] }})
                </a>
                <a href="{{ route('admin.database', ['tab' => 'users']) }}" class="tab-btn {{ $tab === 'users' ? 'active' : '' }}">
                    👥 ผู้ใช้ ({{ $counts['users'] }})
                </a>
                <a href="{{ route('admin.database', ['tab' => 'rooms']) }}" class="tab-btn {{ $tab === 'rooms' ? 'active' : '' }}">
                    🚪 ห้องแชต ({{ $counts['rooms'] }})
                </a>
                <a href="{{ route('admin.database', ['tab' => 'histories']) }}" class="tab-btn {{ $tab === 'histories' ? 'active' : '' }}">
                    🕘 ประวัติงาน ({{ $counts['histories'] }})
                </a>
            </div>

            <form method="GET" action="{{ route('admin.database') }}" class="search-form">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <input type="text" name="q" value="{{ $q }}" placeholder="ค้นหาข้อมูล..." class="search-input">
                <button type="submit" style="padding: 7px 12px; background: var(--bg-surface); border: 1px solid var(--border-color); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-size: 13px;">
                    🔍
                </button>
                @if($q)
                    <a href="{{ route('admin.database', ['tab' => $tab]) }}" style="color: var(--text-secondary); font-size: 12px; text-decoration: none;">ล้างค้นหา</a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            @if($tab === 'messages')
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>ผู้ส่ง (User)</th>
                            <th>ข้อความ (Message Content)</th>
                            <th style="width: 110px;">ห้อง (Room ID)</th>
                            <th style="width: 170px;">เวลาที่ส่ง (Timestamp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $msg)
                            <tr>
                                <td><code>#{{ $msg->id }}</code></td>
                                <td>
                                    <strong style="color: var(--text-primary);">{{ $msg->user?->name ?? 'User #' . $msg->user_id }}</strong>
                                    <div style="font-size: 11px; color: var(--text-secondary);">{{ $msg->user?->email }}</div>
                                </td>
                                <td style="color: var(--text-primary); font-weight: 500;">
                                    {{ $msg->message }}
                                </td>
                                <td>
                                    <span style="background: rgba(59, 130, 246, 0.15); color: var(--accent-blue); padding: 2px 8px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                                        Room #{{ $msg->room_id }}
                                    </span>
                                </td>
                                <td style="font-size: 12px; color: var(--text-secondary);">
                                    {{ $msg->created_at?->format('d/m/Y H:i:s') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    📭 ไม่พบข้อความในตาราง messages
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            @elseif($tab === 'tasks')
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>ชื่องาน (Task Title)</th>
                            <th style="width: 130px;">สถานะ</th>
                            <th style="width: 100px;">ความสำคัญ</th>
                            <th>ผู้รับผิดชอบ</th>
                            <th>ผู้สร้าง</th>
                            <th style="width: 160px;">กำหนดส่ง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $t)
                            <tr>
                                <td><code>#{{ $t->id }}</code></td>
                                <td>
                                    <strong style="color: var(--text-primary);">{{ $t->title }}</strong>
                                    @if($t->description)
                                        <div style="font-size: 11.5px; color: var(--text-secondary); margin-top: 2px;">{{ Str::limit($t->description, 60) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span style="background: rgba(99, 102, 241, 0.15); color: var(--accent-blue); padding: 2px 8px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                                        {{ $t->status }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $pClass = match($t->priority) {
                                            'ด่วน' => 'badge-priority-urgent',
                                             'สูง' => 'badge-priority-high',
                                            'ปกติ' => 'badge-priority-normal',
                                            default => 'badge-priority-low'
                                        };
                                    @endphp
                                    <span class="badge {{ $pClass }}">{{ $t->priority }}</span>
                                </td>
                                <td>
                                    <span style="color: var(--accent-blue); font-weight: 500;">{{ $t->assignee?->name ?? 'ยังไม่มอบหมาย' }}</span>
                                </td>
                                <td>
                                    <span>{{ $t->creator?->name ?? '-' }}</span>
                                </td>
                                <td style="font-size: 12px; color: var(--text-secondary);">
                                    {{ $t->due_at?->format('d/m/Y H:i') ?? 'ไม่ระบุ' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">
                                    📭 ไม่พบข้อมูลงานในตาราง tasks
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            @elseif($tab === 'users')
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>ชื่อ (Name)</th>
                            <th>อีเมล (Email)</th>
                            <th style="width: 140px;">ตำแหน่ง (Role)</th>
                            <th style="width: 170px;">วันที่สมัคร (Registered)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $u)
                            <tr>
                                <td><code>#{{ $u->id }}</code></td>
                                <td><strong style="color: var(--text-primary);">{{ $u->name }}</strong></td>
                                <td style="color: var(--accent-blue); font-weight: 500;">{{ $u->email }}</td>
                                <td>
                                    @php
                                        $rClass = match($u->position) {
                                            'ผู้ดูแลระบบ', 'แอดมิน', 'Admin' => 'badge-role-admin',
                                            'ผู้บริหาร', 'ผู้จัดการ', 'Manager', 'Executive' => 'badge-role-manager',
                                            'หัวหน้างาน', 'Supervisor' => 'badge-role-supervisor',
                                            default => 'badge-role-staff'
                                        };
                                    @endphp
                                    <span class="badge {{ $rClass }}">{{ $u->position ?? 'พนักงาน' }}</span>
                                </td>
                                <td style="font-size: 12px; color: var(--text-secondary);">
                                    {{ $u->created_at?->format('d/m/Y H:i:s') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    📭 ไม่พบข้อมูลผู้ใช้ในตาราง users
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            @elseif($tab === 'rooms')
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>ชื่อห้อง (Room Name)</th>
                            <th>คำอธิบาย (Description)</th>
                            <th style="width: 170px;">วันที่สร้าง (Created At)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $r)
                            <tr>
                                <td><code>#{{ $r->id }}</code></td>
                                <td><strong style="color: var(--text-primary);"># {{ $r->name }}</strong></td>
                                <td>{{ $r->description ?? '-' }}</td>
                                <td style="font-size: 12px; color: var(--text-secondary);">
                                    {{ $r->created_at?->format('d/m/Y H:i') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    📭 ไม่พบข้อมูลห้องแชตในตาราง chat_rooms
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            @elseif($tab === 'histories')
                <table>
                    <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th>งาน (Task Title)</th>
                            <th>ผู้ทำการเปลี่ยน (User)</th>
                            <th>สถานะเดิม ➔ สถานะใหม่</th>
                            <th style="width: 170px;">เวลาที่อัปเดต</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $h)
                            <tr>
                                <td><code>#{{ $h->id }}</code></td>
                                <td><strong style="color: var(--text-primary);">{{ $h->task?->title ?? 'Task #' . $h->task_id }}</strong></td>
                                <td><span style="color: var(--accent-blue); font-weight: 500;">{{ $h->user?->name ?? 'User #' . $h->user_id }}</span></td>
                                <td>
                                    <span style="color: var(--text-secondary);">{{ $h->old_status }}</span>
                                    <span> ➔ </span>
                                    <strong style="color: #6ee7b7;">{{ $h->new_status }}</strong>
                                </td>
                                <td style="font-size: 12px; color: var(--text-secondary);">
                                    {{ $h->created_at?->format('d/m/Y H:i:s') ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty-state">
                                    📭 ไม่พบประวัติในตาราง task_histories
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>

    </div>

</div>

</body>
</html>
