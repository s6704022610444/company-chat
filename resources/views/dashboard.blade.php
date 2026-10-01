<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CompanyChat</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            height: 100vh;
        }

        .app {
            display: flex;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #1f2937;
            color: white;
            padding: 25px 15px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            padding-left: 10px;
        }

        .section-title {
            font-size: 12px;
            color: #9ca3af;
            margin: 20px 10px 10px;
        }

        .room {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .room:hover,
        .room.active {
            background: #374151;
        }

        /* Main */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: 70px;
            background: white;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }

        .header h2 {
            font-size: 20px;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .logout {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout:hover {
            background: #dc2626;
        }

        /* Chat */
        .chat {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
        }

        .message {
            margin-bottom: 4px;
            max-width: 65%;
            display: flex;
            flex-direction: column;
        }

        .message.my-message {
            align-self: flex-end;
            align-items: flex-end;
        }

        .message.my-message .message-name {
            display: none;
        }

        .message.my-message .message-text {
            background: #2563eb;
            color: white;
            border-radius: 18px 18px 4px 18px;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        }

        .message.other-message {
            align-self: flex-start;
            align-items: flex-start;
        }

        .message.other-message .message-name {
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .message.other-message .message-text {
            background: white;
            color: #111827;
            border: 1px solid #e5e7eb;
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .message-text {
            display: inline-block;
            padding: 10px 16px;
            font-size: 15px;
            line-height: 1.5;
            word-break: break-word;
        }

        .message-time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 3px;
            padding: 0 4px;
        }

        .live-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #10b981;
            background: #ecfdf5;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #a7f3d0;
            font-weight: 500;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* Input */
        .input-area {
            background: white;
            border-top: 1px solid #ddd;
            padding: 15px 25px;
            display: flex;
            gap: 10px;
        }

        .input-area input {
            flex: 1;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .send {
            background: #2563eb;
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }

        .send:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="app">

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="logo">
            💬 CompanyChat
        </div>

        @if($notifications > 0)

            <div style="
                margin: 15px 0;
                padding: 12px;
                background: #7f1d1d;
                border-radius: 8px;
            ">

                <a href="{{ route('my.tasks') }}"
                    style="
                        display:block;
                        color:white;
                        text-decoration:none;
                    ">

                    🔔 มีงานใกล้ครบกำหนด
                    <b>{{ $notifications }}</b>
                    งาน

                </a>

            </div>

            @endif

        @if($newTaskNotifications > 0)
            <div style="
                margin: 15px 0;
                padding: 12px;
                background: #1e3a8a;
                border-radius: 8px;
            ">
                <a href="{{ route('my.tasks') }}"
                style="
                    display: block;
                    color: white;
                    text-decoration: none;
                ">
                    📋 มีงานใหม่ที่ยังไม่ได้เริ่ม
                    <b>{{ $newTaskNotifications }}</b>
                    งาน
                </a>
            </div>
        @endif

        <div class="section-title">
            ห้องแชต
        </div>

        {{-- งานทั้งหมด --}}
        <div style="margin-bottom: 15px;">

            <a href="{{ route('tasks.index') }}"
            style="
                display: block;
                padding: 12px 15px;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                background: #2563eb;
                font-weight: bold;
            ">
                📋 งานทั้งหมด
            </a>

        </div>

        {{-- รายการห้องแชต --}}
        @foreach($rooms as $room)
            <div style="
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            ">

                <a href="{{ url('/dashboard?room=' . $room->id) }}"
                style="
                    flex: 1;
                    padding: 12px 15px;
                    color: white;
                    text-decoration: none;
                    cursor: pointer;
                    border-radius: 6px;
                    background: {{ $selectedRoom == $room->id ? '#374151' : 'transparent' }};
                ">
                    # {{ $room->name }}
                </a>

                {{-- ลบห้องได้เฉพาะผู้ดูแลระบบ --}}
                @if(auth()->user()->position === 'ผู้ดูแลระบบ')
                    <form method="POST"
                        action="{{ route('rooms.destroy', $room->id) }}"
                        onsubmit="return confirm('ต้องการลบห้อง {{ $room->name }} ใช่หรือไม่?')"
                        style="margin-left: 5px;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                style="
                                    border: none;
                                    background: #dc2626;
                                    color: white;
                                    padding: 8px 10px;
                                    border-radius: 6px;
                                    cursor: pointer;
                                ">
                            🗑️
                        </button>
                    </form>
                @endif

            </div>
        @endforeach

        {{-- ปุ่มเพิ่มห้อง สำหรับผู้จัดการและผู้ดูแลระบบ --}}
        @if(in_array(auth()->user()->position, ['ผู้จัดการ', 'ผู้ดูแลระบบ']))
            <button
                type="button"
                onclick="document.getElementById('createRoomModal').style.display='flex'"
                style="
                    width: 100%;
                    margin-top: 15px;
                    padding: 10px;
                    border: none;
                    border-radius: 8px;
                    background: #2563eb;
                    color: white;
                    cursor: pointer;
                "
            >
                ＋ เพิ่มห้อง
            </button>
        @endif

        {{-- ปุ่มจัดการสิทธิ์ สำหรับผู้ดูแลระบบเท่านั้น --}}
        @if(auth()->user()->position === 'ผู้ดูแลระบบ')
            <a
                href="{{ route('users.index') }}"
                style="
                    display: block;
                    margin-top: 10px;
                    padding: 10px;
                    border-radius: 8px;
                    background: #374151;
                    color: white;
                    text-decoration: none;
                    text-align: center;
                "
            >
                🔐 จัดการสิทธิ์
            </a>
        @endif

    </div>


    <!-- Main -->
    <div class="main">

        <!-- Header -->
        <div class="header">

            <div>
                <h2>
                    # {{ $rooms->firstWhere('id', $selectedRoom)?->name ?? 'ไม่มีห้อง' }}
                </h2>
                <div style="margin-top: 4px;">
                    <span class="live-status">
                        <span class="live-dot"></span>
                        <span id="socketStatus">Real-time WebSocket (Reverb)</span>
                    </span>
                </div>
            </div>

            <div class="user">

                <div class="avatar" title="{{ auth()->user()->position ?? 'สมาชิก' }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div style="font-weight: bold; font-size: 15px;">
                        {{ auth()->user()->name }}
                    </div>
                    <div style="font-size: 12px; color: #6b7280;">
                        {{ auth()->user()->position ?? 'สมาชิก' }}
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout" type="submit">
                        ออกจากระบบ
                    </button>
                </form>

            </div>

        </div>


        <!-- Chat -->
        <div class="chat" id="chatContainer">

            @foreach($messages as $message)
                @php
                    $isMe = $message->user_id === auth()->id();
                @endphp
                <div class="message {{ $isMe ? 'my-message' : 'other-message' }}" data-message-id="{{ $message->id }}">
                    <div class="message-name">
                        👤 {{ $message->user?->name ?? 'User' }}
                    </div>

                    <div class="message-text">
                        {{ $message->message }}
                    </div>

                    <div class="message-time">
                        {{ $message->created_at ? $message->created_at->format('H:i') : '' }}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- งานที่ต้องทำ --}}
        @php
            $priorityOrder = [
                'ด่วน' => 1,
                'สูง' => 2,
                'ปกติ' => 3,
                'ต่ำ' => 4,
            ];

           $importantTask = $tasks
            ->filter(function ($task) {
                return $task->status !== 'เสร็จแล้ว';
            })
            ->sort(function ($a, $b) use ($priorityOrder) {

                $now = now();

                // เวลาที่เหลือ
                $timeA = $a->due_at
                    ? $now->diffInMinutes($a->due_at, false)
                    : PHP_INT_MAX;

                $timeB = $b->due_at
                    ? $now->diffInMinutes($b->due_at, false)
                    : PHP_INT_MAX;

                /*
                * 1. เกินกำหนด
                */
                $overdueA = $timeA < 0;
                $overdueB = $timeB < 0;

                if ($overdueA !== $overdueB) {
                    return $overdueA ? -1 : 1;
                }

                /*
                * 2. เหลือไม่เกิน 1 ชั่วโมง
                */
                $urgentTimeA = $timeA >= 0 && $timeA <= 60;
                $urgentTimeB = $timeB >= 0 && $timeB <= 60;

                if ($urgentTimeA !== $urgentTimeB) {
                    return $urgentTimeA ? -1 : 1;
                }

                /*
                * 3. เหลือไม่เกิน 24 ชั่วโมง
                */
                $soonA = $timeA >= 0 && $timeA <= 1440;
                $soonB = $timeB >= 0 && $timeB <= 1440;

                if ($soonA !== $soonB) {
                    return $soonA ? -1 : 1;
                }

                /*
                * 4. ความสำคัญ
                */
                $priorityA = $priorityOrder[$a->priority] ?? 99;
                $priorityB = $priorityOrder[$b->priority] ?? 99;

                if ($priorityA !== $priorityB) {
                    return $priorityA <=> $priorityB;
                }

                /*
                * 5. กำหนดส่งเร็วกว่าอยู่ก่อน
                */
                return $timeA <=> $timeB;
            })
            ->first();
        @endphp

        @if($importantTask)

            <div style="
                margin: 15px;
                padding: 15px;
                background: #1f2937;
                border-radius: 10px;
            ">

                <div style="
                    font-size: 13px;
                    color: #9ca3af;
                    margin-bottom: 8px;
                ">
                    📌 งานที่ควรจัดการก่อน
                </div>

                <div style="
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 8px;
                ">
                    {{ $importantTask->title }}
                </div>

                <div style="
                    font-size: 13px;
                    color: #d1d5db;
                ">
                    👤 {{ $importantTask->assignee?->name ?? 'ยังไม่มอบหมาย' }}
                    &nbsp; | &nbsp;
                    📌 {{ $importantTask->status }}
                    &nbsp; | &nbsp;
                    🔥 {{ $importantTask->priority }}
                </div>

                @if($importantTask->due_at)

                    @if($importantTask->due_at->isPast())

                        <div style="
                            margin-top: 8px;
                            color: #f87171;
                        ">
                            🔴 เกินกำหนดแล้ว
                        </div>

                    @else

                        <div style="
                            margin-top: 8px;
                            color: #fbbf24;
                        ">
                            ⏳ {{ $importantTask->due_at->diffForHumans() }}
                        </div>

                    @endif

                @endif

            </div>

        @endif

        <!-- Input -->
        <div class="input-area">

            <form id="chatForm" method="POST" action="{{ route('messages.store') }}" style="display: flex; gap: 10px; width: 100%;">
                @csrf

                <input type="hidden" id="roomIdInput" name="room_id" value="{{ $selectedRoom }}">

                <input
                    type="text"
                    id="messageInput"
                    name="message"
                    placeholder="พิมพ์ข้อความ... (กด Enter เพื่อส่งทันที)"
                    required
                    autocomplete="off"
                >

                <button class="send" id="sendBtn" type="submit">
                    ส่ง
                </button>
            </form>

        </div>

    </div>


    {{-- Modal เพิ่มห้อง --}}
    <div id="createRoomModal"
        style="
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        "
    >
        <div style="
            width: 400px;
            background: #1f2937;
            padding: 25px;
            border-radius: 12px;
            color: white;
        ">

            <h2 style="margin-top: 0;">
                ＋ เพิ่มห้องแชต
            </h2>

            <form method="POST" action="{{ route('rooms.store') }}">
                @csrf

                <label>
                    ชื่อห้อง
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="เช่น Project A"
                    required
                    style="
                        width: 100%;
                        box-sizing: border-box;
                        padding: 10px;
                        margin: 8px 0 15px;
                        border-radius: 6px;
                        border: 1px solid #4b5563;
                        background: #111827;
                        color: white;
                    "
                >

                <label>
                    รายละเอียด
                </label>

                <textarea
                    name="description"
                    placeholder="รายละเอียดของห้อง (ถ้ามี)"
                    style="
                        width: 100%;
                        box-sizing: border-box;
                        height: 80px;
                        padding: 10px;
                        margin: 8px 0 15px;
                        border-radius: 6px;
                        border: 1px solid #4b5563;
                        background: #111827;
                        color: white;
                        resize: none;
                    "
                ></textarea>

                <div style="
                    display: flex;
                    gap: 10px;
                    justify-content: flex-end;
                ">

                    <button
                        type="button"
                        onclick="document.getElementById('createRoomModal').style.display='none'"
                        style="
                            padding: 10px 16px;
                            border: none;
                            border-radius: 6px;
                            cursor: pointer;
                        "
                    >
                        ยกเลิก
                    </button>

                    <button
                        type="submit"
                        style="
                            padding: 10px 16px;
                            border: none;
                            border-radius: 6px;
                            background: #2563eb;
                            color: white;
                            cursor: pointer;
                        "
                    >
                        สร้างห้อง
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentUserId = {{ auth()->id() }};
        const currentRoomId = {{ $selectedRoom ?? 'null' }};
        const chatContainer = document.getElementById('chatContainer');
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const socketStatus = document.getElementById('socketStatus');

        function scrollToBottom() {
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }
        scrollToBottom();

        function appendMessage(data) {
            if (!chatContainer) return;
            if (data.id && document.querySelector(`.message[data-message-id="${data.id}"]`)) {
                return;
            }

            const isMe = Number(data.user_id) === Number(currentUserId);
            const msgEl = document.createElement('div');
            msgEl.className = `message ${isMe ? 'my-message' : 'other-message'}`;
            if (data.id) msgEl.setAttribute('data-message-id', data.id);

            const nameHtml = !isMe ? `<div class="message-name">👤 ${escapeHtml(data.user_name || 'User')}</div>` : '';
            const timeHtml = data.created_at ? `<div class="message-time">${escapeHtml(data.created_at)}</div>` : '';

            msgEl.innerHTML = `
                ${nameHtml}
                <div class="message-text">${escapeHtml(data.message)}</div>
                ${timeHtml}
            `;

            chatContainer.appendChild(msgEl);
            scrollToBottom();
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        if (chatForm && messageInput) {
            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const text = messageInput.value.trim();
                if (!text || !currentRoomId) return;

                messageInput.value = '';
                messageInput.focus();

                try {
                    const res = await fetch("{{ route('messages.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            room_id: currentRoomId,
                            message: text
                        })
                    });

                    if (res.ok) {
                        const json = await res.json();
                        if (json.success && json.message) {
                            appendMessage(json.message);
                        }
                    } else {
                        console.error('Send error:', await res.text());
                    }
                } catch (err) {
                    console.error('Fetch error:', err);
                }
            });
        }

        if (window.Echo && currentRoomId) {
            const channel = window.Echo.channel(`chat.${currentRoomId}`);
            
            channel.listen('.MessageSent', (e) => {
                appendMessage(e);
            }).listen('MessageSent', (e) => {
                appendMessage(e);
            });

            if (window.Echo.connector && window.Echo.connector.pusher) {
                window.Echo.connector.pusher.connection.bind('connected', () => {
                    if (socketStatus) {
                        socketStatus.textContent = 'Real-time WebSocket (เชื่อมต่อสำเร็จ)';
                    }
                });
                window.Echo.connector.pusher.connection.bind('disconnected', () => {
                    if (socketStatus) {
                        socketStatus.textContent = 'Real-time WebSocket (หลุดการเชื่อมต่อ)';
                    }
                });
            }
        }
    });
</script>

</body>
</html>