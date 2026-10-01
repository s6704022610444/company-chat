<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>แก้ไขงาน - CompanyChat</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111827;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
        }

        .box {
            background: #1f2937;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border-radius: 6px;
            border: none;
            background: #374151;
            color: white;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        button,
        .back {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .save {
            background: #2563eb;
        }

        .back {
            background: #4b5563;
        }

        .error {
            background: #7f1d1d;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>✏️ แก้ไขงาน</h1>

    <div class="box">

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST"
              action="{{ route('tasks.updateDetails', $task->id) }}">

            @csrf
            @method('PUT')

            <label>ชื่องาน</label>

            <input
                type="text"
                name="title"
                value="{{ old('title', $task->title) }}"
                required
            >

            <label>รายละเอียด</label>

            <textarea name="description">{{ old('description', $task->description) }}</textarea>

            <label>ผู้รับผิดชอบ</label>

            <select name="assigned_to">

                <option value="">
                    -- ยังไม่มอบหมาย --
                </option>

                @foreach($users as $user)

                    <option
                        value="{{ $user->id }}"
                        {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}
                    >
                        {{ $user->name }} - {{ $user->position }}
                    </option>

                @endforeach

            </select>

            <label>ความสำคัญ</label>

            <select name="priority">

                <option value="ต่ำ"
                    {{ old('priority', $task->priority) === 'ต่ำ' ? 'selected' : '' }}>
                    ต่ำ
                </option>

                <option value="ปกติ"
                    {{ old('priority', $task->priority) === 'ปกติ' ? 'selected' : '' }}>
                    ปกติ
                </option>

                <option value="สูง"
                    {{ old('priority', $task->priority) === 'สูง' ? 'selected' : '' }}>
                    สูง
                </option>

                <option value="ด่วน"
                    {{ old('priority', $task->priority) === 'ด่วน' ? 'selected' : '' }}>
                    ด่วน
                </option>

            </select>

            <label>กำหนดส่ง</label>

            <input
                type="datetime-local"
                name="due_at"
                value="{{ old('due_at', $task->due_at?->format('Y-m-d\TH:i')) }}"
            >

            <div class="buttons">

                <button type="submit" class="save">
                    💾 บันทึกการแก้ไข
                </button>

                <a href="{{ route('tasks.index') }}" class="back">
                    ← ยกเลิก
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>