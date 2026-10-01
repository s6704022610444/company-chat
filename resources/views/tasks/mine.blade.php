<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>งานของฉัน - CompanyChat</title>

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
            max-width: 900px;
            margin: 30px auto;
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

        .task-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 18px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .task-card:hover {
            border-color: var(--border-hover);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 8px;
        }

        .task-title {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
        }

        .task-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .badges-row {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .badge {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .priority-urgent { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); }
        .priority-high { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4); }
        .priority-normal { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.4); }
        .priority-low { background: rgba(148, 163, 184, 0.15); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.3); }

        .due-overdue { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }
        .due-warning { background: rgba(245, 158, 11, 0.2); color: #fde68a; }
        .due-normal { background: rgba(16, 185, 129, 0.2); color: #a7f3d0; }

        .meta-line {
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 14px;
        }

        .status-form {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 14px;
            border-top: 1px solid var(--border-color);
        }

        select {
            padding: 8px 14px;
            border-radius: 8px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: white;
            font-family: inherit;
            font-size: 13.5px;
            outline: none;
            cursor: pointer;
        }

        select:focus {
            border-color: #3b82f6;
        }

        .history-box {
            background: var(--bg-surface);
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 14px;
            border: 1px solid var(--border-color);
        }

        .history-title {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .history-item {
            font-size: 12px;
            color: #cbd5e1;
            padding: 5px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h1 class="page-title">
            <span>📌</span>
            <span>งานของฉัน</span>
        </h1>

        <div style="display: flex; gap: 10px;">
            <a href="{{ route('tasks.index') }}" class="btn-back">
                📋 งานทั้งหมด
            </a>
            <a href="{{ route('dashboard') }}" class="btn-back">
                ← กลับหน้าแชต
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @forelse($tasks as $task)
        <div class="task-card">
            <div class="task-header">
                <div class="task-title">{{ $task->title }}</div>

                @php
                    $priorityClass = match($task->priority) {
                        'ด่วน' => 'priority-urgent',
                        'สูง' => 'priority-high',
                        'ปกติ' => 'priority-normal',
                        default => 'priority-low',
                    };
                @endphp
                <span class="badge {{ $priorityClass }}">
                    {{ $task->priority === 'ด่วน' ? '🔥' : ($task->priority === 'สูง' ? '⚡' : '📌') }} {{ $task->priority }}
                </span>
            </div>

            @if($task->description)
                <div class="task-desc">{{ $task->description }}</div>
            @endif

            <div class="badges-row">
                <span class="badge" style="background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border: 1px solid rgba(99, 102, 241, 0.4);">
                    📌 {{ $task->status }}
                </span>

                @if($task->due_at)
                    @php
                        $diffMin = now()->diffInMinutes($task->due_at, false);
                    @endphp
                    @if($diffMin < 0)
                        <span class="badge due-overdue">🔴 งานนี้เกินกำหนดแล้ว ({{ $task->due_at->format('d/m/Y H:i') }})</span>
                    @elseif($diffMin <= 60)
                        <span class="badge due-warning">🟠 ใกล้ครบกำหนด (เหลือ {{ $task->due_at->diffForHumans() }})</span>
                    @else
                        <span class="badge due-normal">🟢 เหลือเวลา: {{ $task->due_at->diffForHumans() }}</span>
                    @endif
                @endif
            </div>

            <div class="meta-line">
                📅 กำหนดส่ง: <strong>{{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่ระบุ' }}</strong>
            </div>

            {{-- Quick status changer form --}}
            <form method="POST" action="{{ route('my.tasks.status', $task->id) }}" class="status-form">
                @csrf
                @method('PUT')

                <span style="font-size: 13px; color: var(--text-secondary); font-weight: 500;">
                    อัปเดตสถานะงาน:
                </span>

                <select name="status" onchange="this.form.submit()">
                    <option value="ยังไม่เริ่ม" {{ $task->status === 'ยังไม่เริ่ม' ? 'selected' : '' }}>⏳ ยังไม่เริ่ม</option>
                    <option value="รับงานแล้ว" {{ $task->status === 'รับงานแล้ว' ? 'selected' : '' }}>📥 รับงานแล้ว</option>
                    <option value="กำลังดำเนินการ" {{ $task->status === 'กำลังดำเนินการ' ? 'selected' : '' }}>⚙️ กำลังดำเนินการ</option>
                    <option value="เสร็จแล้ว">✅ เสร็จแล้ว</option>
                </select>
            </form>

            {{-- History of status changes --}}
            @if($task->histories->count() > 0)
                <div class="history-box">
                    <div class="history-title">🕘 ประวัติการเปลี่ยนสถานะ</div>
                    @foreach($task->histories as $history)
                        <div class="history-item">
                            <span>👤 {{ $history->user?->name ?? 'User' }}: <strong>{{ $history->old_status }}</strong> → <strong>{{ $history->new_status }}</strong></span>
                            <span style="color: var(--text-secondary);">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div style="background: var(--bg-secondary); padding: 50px 20px; text-align: center; border-radius: 14px; border: 1px solid var(--border-color);">
            <div style="font-size: 36px; margin-bottom: 12px;">🎉</div>
            <div style="font-size: 18px; font-weight: 600; color: #fff;">ไม่มีงานคั่งค้างในขณะนี้</div>
            <div style="font-size: 14px; color: var(--text-secondary); margin-top: 6px;">คุณได้จัดการงานที่ได้รับมอบหมายเสร็จสิ้นทั้งหมดแล้ว</div>
        </div>
    @endforelse

</div>

</body>
</html>