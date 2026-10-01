<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>งานของฉัน - CompanyChat</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #111827;
            color: white;
        }

        .container {
            width: 90%;
            max-width: 900px;
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

        .task {
            background: #1f2937;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .task-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info {
            color: #d1d5db;
            margin: 6px 0;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #374151;
            margin-right: 5px;
            font-size: 13px;
        }

        .overdue {
            margin-top: 10px;
            padding: 8px 12px;
            background: #7f1d1d;
            color: #fecaca;
            border-radius: 6px;
        }

        .warning {
            margin-top: 10px;
            padding: 8px 12px;
            background: #78350f;
            color: #fed7aa;
            border-radius: 6px;
        }

        .normal {
            margin-top: 10px;
            padding: 8px 12px;
            background: #065f46;
            color: #a7f3d0;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top">

        <h1>📋 งานของฉัน</h1>

        <a href="{{ route('dashboard') }}" class="back">
            ← กลับหน้าแชต
        </a>

    </div>


    @forelse($tasks as $task)

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
                    📌 {{ $task->status }}
                </span>

                <span class="badge">
                    🔥 {{ $task->priority }}
                </span>
            </div>

            <div class="info">
                📅 กำหนดส่ง:
                {{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่กำหนด' }}
            </div>


            @if($task->due_at)

                @php
                    $minutesLeft = now()->diffInMinutes(
                        $task->due_at,
                        false
                    );
                @endphp

                @if($minutesLeft < 0)

                    <div class="overdue">
                        🔴 งานนี้เกินกำหนดแล้ว
                    </div>

                @elseif($minutesLeft <= 60)

                    <div class="warning">
                        🟠 ใกล้ครบกำหนด
                        เหลือ {{ $task->due_at->diffForHumans() }}
                    </div>

                @else

                    <div class="normal">
                        🟢 เหลือ {{ $task->due_at->diffForHumans() }}
                    </div>

                @endif

            @endif

            <form method="POST"
                  action="{{ route('my.tasks.status', $task->id) }}"
                  style="margin-top: 15px;">

                @csrf
                @method('PUT')

                <select name="status"
                        onchange="this.form.submit()"
                        style="
                            width: 100%;
                            padding: 10px;
                            border-radius: 6px;
                            border: none;
                            background: #374151;
                            color: white;
                        ">

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

                    <option value="เสร็จแล้ว">
                        เสร็จแล้ว
                    </option>

                </select>

            </form>

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
            🎉 ตอนนี้ไม่มีงานที่ต้องทำ
        </div>

    @endforelse

</div>

</body>
</html>