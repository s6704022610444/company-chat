<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขงาน - CompanyChat</title>

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
            width: 90%;
            max-width: 680px;
            margin: 40px auto;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .edit-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.25);
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

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-top: 16px;
            margin-bottom: 6px;
        }

        label:first-child {
            margin-top: 0;
        }

        input, textarea, select {
            width: 100%;
            padding: 11px 14px;
            border-radius: 9px;
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
            min-height: 100px;
            resize: vertical;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 26px;
        }

        .btn-save {
            flex: 1;
            background: var(--accent-gradient);
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.35);
            transition: all 0.2s;
        }

        .btn-save:hover {
            transform: scale(1.01);
            filter: brightness(1.1);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 10px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="top-bar">
        <h1 class="page-title">
            <span>✏️</span>
            <span>แก้ไขรายละเอียดงาน</span>
        </h1>

        <a href="{{ url('/dashboard?view=all-tasks') }}" class="btn-cancel" style="padding: 8px 16px;">
            ← กลับรายการงาน
        </a>
    </div>

    <div class="edit-card">

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <div>⚠️ {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.updateDetails', $task->id) }}">
            @csrf
            @method('PUT')

            <label>ชื่องาน <span style="color: #f87171;">*</span></label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $task->title) }}"
                   required>

            <label>รายละเอียดของงาน</label>
            <textarea name="description">{{ old('description', $task->description) }}</textarea>

            <label>ผู้รับผิดชอบงาน</label>
            <select name="assigned_to">
                <option value="">-- ยังไม่มอบหมาย --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->position }})
                    </option>
                @endforeach
            </select>

            <label>ระดับความสำคัญ <span style="color: #f87171;">*</span></label>
            <select name="priority" required>
                <option value="ต่ำ" {{ old('priority', $task->priority) === 'ต่ำ' ? 'selected' : '' }}>🟢 ต่ำ</option>
                <option value="ปกติ" {{ old('priority', $task->priority) === 'ปกติ' ? 'selected' : '' }}>📌 ปกติ</option>
                <option value="สูง" {{ old('priority', $task->priority) === 'สูง' ? 'selected' : '' }}>⚡ สูง</option>
                <option value="ด่วน" {{ old('priority', $task->priority) === 'ด่วน' ? 'selected' : '' }}>🔥 ด่วน</option>
            </select>

            <label>กำหนดวัน/เวลาส่ง</label>
            <input type="datetime-local"
                   name="due_at"
                   value="{{ old('due_at', $task->due_at?->format('Y-m-d\TH:i')) }}">

            <div class="btn-group">
                <button type="submit" class="btn-save">
                    💾 บันทึกการเปลี่ยนแปลง
                </button>
                <a href="{{ url('/dashboard?view=all-tasks') }}" class="btn-cancel">
                    ยกเลิก
                </a>
            </div>
        </form>

    </div>

</div>

</body>
</html>