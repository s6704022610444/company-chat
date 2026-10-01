<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>งาน - CompanyChat</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111827;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .back {
            color: white;
            text-decoration: none;
            background: #374151;
            padding: 10px 16px;
            border-radius: 6px;
        }

        .create-box {
            background: #1f2937;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        input,
        textarea,
        select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: none;
            border-radius: 6px;
            background: #374151;
            color: white;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        button {
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            background: #2563eb;
            color: white;
        }

        .task {
            background: #1f2937;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .task-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .info {
            color: #d1d5db;
            margin: 5px 0;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #374151;
            margin-right: 5px;
            font-size: 13px;
        }

        .success {
            background: #065f46;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            background: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .status-form {
            margin-top: 15px;
        }

        .status-form select {
            max-width: 300px;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">
        <h1>📋 งานทั้งหมด</h1>

        <a href="{{ route('dashboard') }}" class="back">
            ← กลับหน้าแชต
        </a>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if(in_array(auth()->user()->position, [
        'หัวหน้างาน',
        'ผู้จัดการ',
        'ผู้ดูแลระบบ'
    ]))

        {{-- สร้างงาน --}}

            <div class="create-box">

                <h2>➕ สร้างงานใหม่</h2>

                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <label>ชื่องาน</label>
                    <input
                        type="text"
                        name="title"
                        placeholder="เช่น จัดทำรายงานประจำเดือน"
                        required
                    >

                    <label>รายละเอียด</label>
                    <textarea
                        name="description"
                        placeholder="รายละเอียดของงาน..."
                    ></textarea>

                    <label>มอบหมายให้</label>
                    <select name="assigned_to">
                        <option value="">-- ยังไม่มอบหมาย --</option>

                        @foreach($users->where('position', '!=', 'ผู้ดูแลระบบ') as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} - {{ $user->position }}
                            </option>
                        @endforeach
                    </select>

                    <label>ความสำคัญ</label>
                    <select name="priority" required>
                        <option value="ต่ำ">ต่ำ</option>
                        <option value="ปกติ" selected>ปกติ</option>
                        <option value="สูง">สูง</option>
                        <option value="ด่วน">ด่วน</option>
                    </select>

                    <label>กำหนดส่ง</label>
                    <input
                        type="datetime-local"
                        name="due_at"
                    >

                    <button type="submit">
                        สร้างงาน
                    </button>
                </form>

            </div>

    @endif


    {{-- รายการงาน --}}
    @forelse($tasks->where('status', '!=', 'เสร็จแล้ว') as $task)

        <div class="task">

            <div class="task-title">
                {{ $task->title }}
            </div>

            @if($task->description)
                <div class="info">
                    {{ $task->description }}
                </div>
            @endif

            <div>
                <span class="badge">
                    สถานะ: {{ $task->status }}
                </span>

                <span class="badge">
                    ความสำคัญ: {{ $task->priority }}
                </span>
            </div>

            <div class="info">
                👤 ผู้สร้าง:
                {{ $task->creator->name }}
            </div>

            <div class="info">
                🎯 ผู้รับผิดชอบ:
                {{ $task->assignee?->name ?? 'ยังไม่มอบหมาย' }}
            </div>

            <div class="info">
                📅 กำหนดส่ง:
                {{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่กำหนด' }}
            </div>


            {{-- เวลาที่เหลือ --}}
           @if($task->due_at && $task->status !== 'เสร็จแล้ว')

                @php
                    $now = now();
                    $due = $task->due_at;

                    $minutesLeft = $now->diffInMinutes($due, false);
                @endphp

                @if($minutesLeft < 0)

                    {{-- เกินกำหนด --}}
                    <div style="
                        margin-top: 10px;
                        padding: 8px 12px;
                        background: #7f1d1d;
                        color: #fecaca;
                        border-radius: 6px;
                    ">
                        🔴 เกินกำหนด
                        {{ $due->diffForHumans() }}
                    </div>

                @elseif($minutesLeft <= 60)

                    {{-- เหลือไม่เกิน 1 ชั่วโมง --}}
                    <div style="
                        margin-top: 10px;
                        padding: 8px 12px;
                        background: #78350f;
                        color: #fed7aa;
                        border-radius: 6px;
                    ">
                        🟠 ใกล้ครบกำหนด
                        เหลือ {{ $due->diffForHumans() }}
                    </div>

                @else

                    {{-- ยังมีเวลา --}}
                    <div style="
                        margin-top: 10px;
                        padding: 8px 12px;
                        background: #065f46;
                        color: #a7f3d0;
                        border-radius: 6px;
                    ">
                        🟢 เหลือ {{ $due->diffForHumans() }}
                    </div>

                @endif

            @endif


            {{-- เปลี่ยนสถานะ --}}
            @if(
                $task->assigned_to == auth()->id() ||
                in_array(auth()->user()->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ'])
            )

                <form
                    method="POST"
                    action="{{ route('tasks.update', $task->id) }}"
                    class="status-form"
                >

                    @csrf
                    @method('PUT')

                    <select name="status">

                        <option value="ยังไม่เริ่ม"
                            {{ $task->status === 'ยังไม่เริ่ม' ? 'selected' : '' }}>
                            ยังไม่เริ่ม
                        </option>

                        <option value="รับงานแล้ว"
                            {{ $task->status === 'รับงานแล้ว' ? 'selected' : '' }}>
                            รับงานแล้ว
                        </option>

                        <option value="กำลังดำเนินการ"
                            {{ $task->status === 'กำลังดำเนินการ' ? 'selected' : '' }}>
                            กำลังดำเนินการ
                        </option>

                        <option value="เสร็จแล้ว"
                            {{ $task->status === 'เสร็จแล้ว' ? 'selected' : '' }}>
                            เสร็จแล้ว
                        </option>

                    </select>

                    <button type="submit">
                        อัปเดตสถานะ
                    </button>

                </form>

            @endif

            @if(in_array(auth()->user()->position, [
                'หัวหน้างาน',
                'ผู้จัดการ',
                'ผู้ดูแลระบบ'
            ]))

                <a href="{{ route('tasks.edit', $task->id) }}"
                style="
                    display: inline-block;
                    margin-top: 10px;
                    padding: 8px 12px;
                    background: #2563eb;
                    color: white;
                    text-decoration: none;
                    border-radius: 6px;
                ">
                    ✏️ แก้ไขงาน
                </a>

                <form method="POST"
                    action="{{ route('tasks.destroy', $task->id) }}"
                    style="display: inline-block; margin-left: 5px;"
                    onsubmit="return confirm('ต้องการลบงานนี้ใช่หรือไม่?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            style="
                                margin-top: 10px;
                                padding: 8px 12px;
                                background: #dc2626;
                                color: white;
                                border: none;
                                border-radius: 6px;
                                cursor: pointer;
                            ">
                        🗑️ ลบงาน
                    </button>

                </form>

            @endif

            {{-- ประวัติการเปลี่ยนสถานะ --}}
            @if($task->histories->count() > 0)

                <div style="
                    margin-top: 15px;
                    padding: 12px;
                    background: #111827;
                    border-radius: 8px;
                ">

                    <div style="
                        font-weight: bold;
                        margin-bottom: 10px;
                    ">
                        🕘 ประวัติการเปลี่ยนสถานะ
                    </div>

                    @foreach($task->histories as $history)

                        <div style="
                            padding: 8px 0;
                            border-bottom: 1px solid #374151;
                        ">

                            <div style="font-size: 13px;">
                                👤 {{ $history->user->name }}
                            </div>

                            <div style="
                                margin-top: 3px;
                                color: #d1d5db;
                            ">
                                {{ $history->old_status }}
                                →
                                {{ $history->new_status }}
                            </div>

                            <div style="
                                margin-top: 3px;
                                font-size: 12px;
                                color: #9ca3af;
                            ">
                                🕐 {{ $history->created_at->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    @endforeach

                </div>

            @endif

        </div>

    @empty

        <div class="task">
            ยังไม่มีงานในระบบ
        </div>

    @endforelse

    {{-- งานที่เสร็จแล้ว --}}
    @php
        $completedTasks = $tasks->where('status', 'เสร็จแล้ว');

        if (!in_array(auth()->user()->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ'])) {
            $completedTasks = $completedTasks->where('assigned_to', auth()->id());
        }
    @endphp

    <div class="create-box" style="margin-top: 30px;">

        <details>

            <summary style="
                cursor: pointer;
                font-size: 18px;
                font-weight: bold;
                padding: 5px;
            ">
                ✅ งานที่เสร็จแล้ว
                ({{ $completedTasks->count() }})
            </summary>

            <div style="margin-top: 15px;">

                @forelse($completedTasks as $task)

                    <div class="task" style="
                        opacity: 0.75;
                        margin-bottom: 10px;
                    ">

                        <div class="task-title">
                            ✅ {{ $task->title }}
                        </div>

                        <div class="info">
                            👤 ผู้รับผิดชอบ:
                            {{ $task->assignee?->name ?? 'ไม่ระบุ' }}
                        </div>

                        <div class="info">
                            📅 กำหนดส่ง:
                            {{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่กำหนด' }}
                        </div>

                        <span class="badge">
                            เสร็จแล้ว
                        </span>

                    </div>

                @empty

                    <div style="
                        color: #9ca3af;
                        padding: 15px 0;
                    ">
                        ยังไม่มีงานที่เสร็จแล้ว
                    </div>

                @endforelse

            </div>

        </details>

    </div>

</div>

</body>
</html>