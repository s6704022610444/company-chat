<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการงานทั้งหมด - CompanyChat</title>

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
            max-width: 1100px;
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

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #fca5a5;
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Create Task Card */
        .create-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-full {
            grid-column: span 2;
        }

        label {
            display: block;
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 6px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: white;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        .btn-submit {
            background: var(--accent-gradient);
            color: white;
            border: none;
            padding: 11px 24px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.35);
            transition: all 0.2s;
        }

        .btn-submit:hover {
            transform: scale(1.01);
            filter: brightness(1.1);
        }

        /* Task Cards */
        .task-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .task-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 12px;
        }

        .task-title {
            font-size: 17px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .task-desc {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.5;
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

        .status-badge {
            background: rgba(99, 102, 241, 0.15);
            color: #a5b4fc;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .due-overdue { background: rgba(239, 68, 68, 0.2); color: #fca5a5; }
        .due-warning { background: rgba(245, 158, 11, 0.2); color: #fde68a; }
        .due-normal { background: rgba(16, 185, 129, 0.2); color: #a7f3d0; }

        .meta-text {
            font-size: 13px;
            color: var(--text-secondary);
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Action buttons */
        .task-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid var(--border-color);
            margin-top: 14px;
        }

        .btn-edit {
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 6px 14px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
        }

        /* History accordion */
        .history-box {
            background: var(--bg-surface);
            border-radius: 9px;
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
            <span>📋</span>
            <span>จัดการงานทั้งหมด</span>
        </h1>

        <div style="display: flex; gap: 10px;">
            <a href="{{ route('my.tasks') }}" class="btn-back" style="background: rgba(59, 130, 246, 0.15); border-color: rgba(59, 130, 246, 0.3); color: #93c5fd;">
                📌 งานของฉัน
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

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>⚠️ {{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Create Task Form (Supervisor, Manager, Admin only) --}}
    @if(in_array(auth()->user()->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ']))
        <div class="create-card">
            <div class="card-header-title">
                <span>➕</span>
                <span>สร้างงานและมอบหมาย</span>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="form-grid">
                    <div class="form-full">
                        <label>ชื่องาน <span style="color: #f87171;">*</span></label>
                        <input type="text" name="title" placeholder="เช่น สรุปผลการทดสอบระบบประจำสัปดาห์" required>
                    </div>

                    <div class="form-full">
                        <label>รายละเอียดของงาน</label>
                        <textarea name="description" placeholder="ระบุขั้นตอน หรือสิ่งที่ต้องส่งมอบ..."></textarea>
                    </div>

                    <div>
                        <label>มอบหมายให้</label>
                        <select name="assigned_to">
                            <option value="">-- ยังไม่มอบหมาย --</option>
                            @foreach($users->where('position', '!=', 'ผู้ดูแลระบบ') as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} ({{ $user->position }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>ระดับความสำคัญ <span style="color: #f87171;">*</span></label>
                        <select name="priority" required>
                            <option value="ต่ำ">🟢 ต่ำ</option>
                            <option value="ปกติ" selected>📌 ปกติ</option>
                            <option value="สูง">⚡ สูง</option>
                            <option value="ด่วน">🔥 ด่วน</option>
                        </select>
                    </div>

                    <div class="form-full">
                        <label>กำหนดส่ง (วัน/เวลา)</label>
                        <input type="datetime-local" name="due_at">
                    </div>
                </div>

                <div style="margin-top: 18px; display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-submit">
                        ＋ ยืนยันการสร้างงาน
                    </button>
                </div>
            </form>
        </div>
    @endif

    {{-- Task List --}}
    <h2 style="font-size: 18px; margin-bottom: 16px; color: var(--text-secondary);">
        รายการงานทั้งหมด ({{ $tasks->count() }})
    </h2>

    @forelse($tasks as $task)
        <div class="task-card">
            <div class="task-top">
                <div>
                    <div class="task-title">{{ $task->title }}</div>
                    @if($task->description)
                        <div class="task-desc">{{ $task->description }}</div>
                    @endif
                </div>

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

            <div class="badges-row">
                <span class="badge status-badge">
                    สถานะ: {{ $task->status }}
                </span>

                @if($task->due_at)
                    @php
                        $diffMin = now()->diffInMinutes($task->due_at, false);
                    @endphp
                    @if($diffMin < 0)
                        <span class="badge due-overdue">🔴 เกินกำหนดส่ง ({{ $task->due_at->format('d/m/Y H:i') }})</span>
                    @elseif($diffMin <= 60)
                        <span class="badge due-warning">⏳ ครบกำหนดใน {{ $task->due_at->diffForHumans() }}</span>
                    @else
                        <span class="badge due-normal">📅 กำหนดส่ง: {{ $task->due_at->format('d/m/Y H:i') }}</span>
                    @endif
                @endif
            </div>

            <div class="meta-text">
                <span>👤 มอบหมายให้: <strong>{{ $task->assignee?->name ?? 'ยังไม่มอบหมาย' }}</strong></span>
                <span>✍️ สร้างโดย: {{ $task->creator?->name ?? 'ระบบ' }}</span>
                <span>🕒 สร้างเมื่อ: {{ $task->created_at->format('d/m/Y H:i') }}</span>
            </div>

            {{-- Status changer for Assignee or Privileged Roles --}}
            @php
                $canChangeStatus = $task->assigned_to == auth()->id() || in_array(auth()->user()->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ']);
            @endphp

            @if($canChangeStatus)
                <div style="margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 13px; color: var(--text-secondary);">เปลี่ยนสถานะ:</span>
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" style="display: inline-block;">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" style="width: auto; padding: 6px 12px; font-size: 13px;">
                            <option value="ยังไม่เริ่ม" {{ $task->status === 'ยังไม่เริ่ม' ? 'selected' : '' }}>ยังไม่เริ่ม</option>
                            <option value="รับงานแล้ว" {{ $task->status === 'รับงานแล้ว' ? 'selected' : '' }}>รับงานแล้ว</option>
                            <option value="กำลังดำเนินการ" {{ $task->status === 'กำลังดำเนินการ' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                            <option value="เสร็จแล้ว" {{ $task->status === 'เสร็จแล้ว' ? 'selected' : '' }}>เสร็จแล้ว</option>
                        </select>
                    </form>
                </div>
            @endif

            {{-- Edit & Delete (Supervisor, Manager, Admin) --}}
            @if(in_array(auth()->user()->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ']))
                <div class="task-actions">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn-edit">
                        ✏️ แก้ไขงาน
                    </a>

                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return confirm('ยืนยันที่จะลบงานนี้หรือไม่?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            🗑️ ลบงาน
                        </button>
                    </form>
                </div>
            @endif

            {{-- History Timeline --}}
            @if($task->histories->count() > 0)
                <div class="history-box">
                    <div class="history-title">🕘 ประวัติการเปลี่ยนสถานะ ({{ $task->histories->count() }})</div>
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
        <div style="background: var(--bg-secondary); padding: 40px; text-align: center; border-radius: 12px; color: var(--text-secondary);">
            🎉 ยังไม่มีงานในระบบ
        </div>
    @endforelse

</div>

</body>
</html>