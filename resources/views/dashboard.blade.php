<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompanyChat - ระบบแชตและจัดการงานองค์กร</title>

    <!-- Google Fonts: Plus Jakarta Sans & Prompt -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg-primary: #0b0f19;
            --bg-secondary: #111827;
            --bg-surface: #1e293b;
            --bg-card: #1f293d;
            --border-color: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(255, 255, 255, 0.16);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --accent-blue: #3b82f6;
            --accent-indigo: #6366f1;
            --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            --accent-glow: 0 4px 20px rgba(59, 130, 246, 0.35);
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
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .app {
            display: flex;
            height: 100vh;
            background: var(--bg-primary);
        }

        /* Sidebar */
        .sidebar {
            width: 290px;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            user-select: none;
            flex-shrink: 0;
            z-index: 20;
        }

        .sidebar-header {
            padding: 20px 20px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--accent-gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: var(--accent-glow);
        }

        .logo-text {
            font-size: 19px;
            font-weight: 700;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #ffffff 40%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }

        .nav-section-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 8px;
            padding-left: 8px;
        }

        .nav-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 9px;
            color: var(--text-primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
            margin-bottom: 6px;
        }

        .nav-button:hover {
            background: rgba(59, 130, 246, 0.15);
            border-color: rgba(59, 130, 246, 0.4);
            transform: translateX(2px);
        }

        .nav-badge {
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 12px;
            font-weight: 600;
        }

        .badge-red {
            background: #ef4444;
            color: white;
        }

        .badge-blue {
            background: #3b82f6;
            color: white;
        }

        .badge-amber {
            background: #f59e0b;
            color: #111827;
        }

        /* Room list items */
        .room-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.18s ease;
            border: 1px solid transparent;
        }

        .room-item:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--border-color);
        }

        .room-item.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.22) 0%, rgba(99, 102, 241, 0.08) 100%);
            border-color: rgba(59, 130, 246, 0.45);
        }

        .room-link {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .room-item.active .room-link {
            color: #ffffff;
            font-weight: 600;
        }

        .room-hash {
            color: var(--accent-blue);
            font-weight: 700;
        }

        .room-delete-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px 6px;
            border-radius: 6px;
            opacity: 0.6;
            transition: all 0.15s;
        }

        .room-delete-btn:hover {
            opacity: 1;
            color: #f87171;
            background: rgba(239, 68, 68, 0.15);
        }

        /* Main View */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-primary);
            position: relative;
            min-width: 0;
        }

        /* Top Header */
        .top-header {
            height: 68px;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 10;
        }

        .room-title-area {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .room-title-area h2 {
            font-size: 18px;
            font-weight: 700;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .live-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #34d399;
            font-weight: 500;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            background-color: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 8px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.8; }
        }

        /* User badge & profile */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--accent-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
        }

        .user-details {
            display: flex;
            flex-direction: column;
            line-height: 1.25;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: #fff;
        }

        .role-pill {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 6px;
            margin-top: 2px;
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

        .logout-btn {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 6px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s;
            font-family: inherit;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        /* Important Task Banner */
        .urgent-task-banner {
            margin: 14px 24px 0;
            padding: 12px 16px;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(245, 158, 11, 0.35);
            border-left: 4px solid #f59e0b;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
        }

        .urgent-task-content {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .urgent-task-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            color: #fbbf24;
            letter-spacing: 0.5px;
        }

        .urgent-task-title {
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
        }

        .urgent-task-meta {
            font-size: 12px;
            color: var(--text-secondary);
        }

        /* Chat Scroll Area */
        .chat-container {
            flex: 1;
            padding: 20px 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            scroll-behavior: smooth;
        }

        .chat-container::-webkit-scrollbar {
            width: 6px;
        }
        .chat-container::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        /* Messages */
        .message-row {
            display: flex;
            flex-direction: column;
            max-width: 68%;
            animation: fadeIn 0.2s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-row.my-message {
            align-self: flex-end;
            align-items: flex-end;
        }

        .message-row.other-message {
            align-self: flex-start;
            align-items: flex-start;
        }

        .message-sender {
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 3px;
            padding-left: 2px;
        }

        .message-bubble {
            padding: 10px 16px;
            font-size: 14.5px;
            line-height: 1.5;
            word-break: break-word;
            position: relative;
        }

        .my-message .message-bubble {
            background: var(--accent-gradient);
            color: #ffffff;
            border-radius: 18px 18px 4px 18px;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
        }

        .other-message .message-bubble {
            background: var(--bg-surface);
            color: #f1f5f9;
            border: 1px solid var(--border-color);
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .message-time {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            padding: 0 4px;
        }

        /* Input Area */
        .input-bar {
            padding: 16px 24px;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
        }

        .input-form {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 5px 6px 5px 16px;
            transition: all 0.2s ease;
        }

        .input-form:focus-within {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .chat-input {
            flex: 1;
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 14.5px;
            font-family: inherit;
            outline: none;
        }

        .chat-input::placeholder {
            color: #64748b;
        }

        .send-button {
            background: var(--accent-gradient);
            border: none;
            color: white;
            padding: 9px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: var(--accent-glow);
            transition: all 0.18s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .send-button:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
        }

        .send-button:active {
            transform: scale(0.98);
        }

        /* Modern Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
            z-index: 100;
        }

        .modal-card {
            width: 440px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-hover);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            animation: modalPop 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .form-input, .form-textarea {
            width: 100%;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 9px;
            color: white;
            font-family: inherit;
            font-size: 14px;
            padding: 10px 12px;
            margin-bottom: 14px;
            outline: none;
            transition: all 0.15s;
        }

        .form-input:focus, .form-textarea:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        /* Mobile Responsive Styles */
        .mobile-toggle-btn {
            display: none;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: #ffffff;
            font-size: 19px;
            width: 38px;
            height: 38px;
            border-radius: 9px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: all 0.18s;
        }

        .mobile-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-close-btn {
            display: none;
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 19px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            margin-left: auto;
        }

        .sidebar-close-btn:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(4px);
            z-index: 80;
        }

        @media (max-width: 768px) {
            .mobile-toggle-btn {
                display: inline-flex;
            }

            .sidebar-close-btn {
                display: block;
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                width: 82%;
                max-width: 320px;
                z-index: 90;
                transform: translateX(-100%);
                transition: transform 0.26s cubic-bezier(0.16, 1, 0.3, 1);
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-backdrop.open {
                display: block;
            }

            .main {
                width: 100vw;
                min-width: 100vw;
            }

            .top-header {
                height: 60px;
                padding: 0 12px;
                gap: 8px;
            }

            .room-title-area h2 {
                font-size: 15px;
            }

            .live-status {
                font-size: 11px;
            }

            .user-details {
                display: none;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 13px;
                border-radius: 8px;
            }

            .logout-btn {
                padding: 5px 8px;
                font-size: 11px;
            }

            .urgent-task-banner {
                margin: 8px 10px 0;
                padding: 10px 12px;
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .urgent-task-title {
                font-size: 13px;
            }

            .urgent-task-meta {
                font-size: 11.5px;
                line-height: 1.4;
            }

            .chat-container {
                padding: 12px 10px;
                gap: 10px;
            }

            .message-row {
                max-width: 88%;
            }

            .message-bubble {
                padding: 8px 13px;
                font-size: 14px;
            }

            .input-bar {
                padding: 10px 10px;
            }

            .input-form {
                padding: 4px 4px 4px 12px;
                border-radius: 12px;
            }

            .chat-input {
                font-size: 13.5px;
            }

            .send-button {
                padding: 8px 14px;
                font-size: 13px;
                border-radius: 8px;
            }

            .modal-card {
                width: 92%;
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>

<div class="app">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="sidebar-header">
            <div class="logo-icon">💬</div>
            <div class="logo-text">CompanyChat</div>
            <button type="button" id="sidebarCloseBtn" class="sidebar-close-btn" aria-label="ปิดเมนู">✕</button>
        </div>

        <div class="sidebar-scroll">

            <!-- Tasks Navigation -->
            <div>
                <div class="nav-section-title">งานและภารกิจ</div>

                <!-- งานของฉัน (My Tasks) -->
                <a href="{{ route('my.tasks') }}" class="nav-button">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        📌 งานของฉัน
                    </span>
                    @if(isset($myTasksCount) && $myTasksCount > 0)
                        <span class="nav-badge badge-blue">{{ $myTasksCount }}</span>
                    @endif
                </a>

                <!-- งานทั้งหมด (All Tasks) -->
                <a href="{{ route('tasks.index') }}" class="nav-button">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        📋 จัดการงานทั้งหมด
                    </span>
                </a>

                @if($notifications > 0)
                    <a href="{{ route('my.tasks') }}" class="nav-button" style="background: rgba(245, 158, 11, 0.15); border-color: rgba(245, 158, 11, 0.35);">
                        <span style="color: #fbbf24; font-size: 13px;">
                            ⏰ ใกล้ครบกำหนด
                        </span>
                        <span class="nav-badge badge-amber">{{ $notifications }}</span>
                    </a>
                @endif
            </div>

            <!-- Chat Rooms Section -->
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                    <div class="nav-section-title" style="margin-bottom: 0;">ห้องแชต ({{ $rooms->count() }})</div>

                    {{-- ปุ่มสร้างห้อง (ผู้จัดการ / ผู้ดูแลระบบ) --}}
                    @if(in_array(auth()->user()->position, ['ผู้จัดการ', 'ผู้ดูแลระบบ']))
                        <button type="button"
                                onclick="document.getElementById('createRoomModal').style.display='flex'"
                                style="background: transparent; border: none; color: var(--accent-blue); cursor: pointer; font-size: 13px; font-weight: 600; padding: 2px 8px; border-radius: 4px;"
                                title="เพิ่มห้องแชตใหม่">
                            ＋ สร้าง
                        </button>
                    @endif
                </div>

                @foreach($rooms as $room)
                    <div class="room-item {{ $selectedRoom == $room->id ? 'active' : '' }}">
                        <a href="{{ url('/dashboard?room=' . $room->id) }}" class="room-link">
                            <span class="room-hash">#</span>
                            <span>{{ $room->name }}</span>
                        </a>

                        {{-- ลบห้อง (ผู้ดูแลระบบเท่านั้น) --}}
                        @if(auth()->user()->position === 'ผู้ดูแลระบบ')
                            <form method="POST"
                                  action="{{ route('rooms.destroy', $room->id) }}"
                                  onsubmit="return confirm('ต้องการลบห้อง {{ $room->name }} ใช่หรือไม่?')"
                                  style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="room-delete-btn" title="ลบห้องนี้">
                                    🗑️
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Admin Area -->
            @if(auth()->user()->position === 'ผู้ดูแลระบบ')
                <div>
                    <div class="nav-section-title">การจัดการระบบ</div>
                    <a href="{{ route('users.index') }}" class="nav-button" style="background: rgba(99, 102, 241, 0.15); border-color: rgba(99, 102, 241, 0.35);">
                        <span>🔐 จัดการสิทธิ์ผู้ใช้</span>
                        <span style="font-size: 11px; color: #a5b4fc;">Admin</span>
                    </a>
                </div>
            @endif

        </div>

    </aside>

    <!-- Mobile Drawer Backdrop -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <!-- Main Chat Workspace -->
    <main class="main">

        <!-- Top Header -->
        <header class="top-header">

            <div style="display: flex; align-items: center; gap: 10px;">
                <button type="button" id="sidebarToggle" class="mobile-toggle-btn" aria-label="เปิดเมนู">
                    ☰
                </button>
                <div class="room-title-area">
                    <h2>
                        <span style="color: var(--accent-blue);">#</span>
                        <span>{{ $rooms->firstWhere('id', $selectedRoom)?->name ?? 'ไม่มีห้อง' }}</span>
                    </h2>
                    <div class="live-status">
                        <span class="live-dot"></span>
                        <span id="socketStatus">Real-time WebSocket (Reverb)</span>
                    </div>
                </div>
            </div>

            <!-- User Info & Logout -->
            <div class="user-profile">
                <div class="user-avatar" title="{{ auth()->user()->position }}">
                    {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="user-details">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    @php
                        $roleClass = match(auth()->user()->position) {
                            'ผู้ดูแลระบบ' => 'role-admin',
                            'ผู้จัดการ' => 'role-manager',
                            'หัวหน้างาน' => 'role-supervisor',
                            default => 'role-staff',
                        };
                    @endphp
                    <span class="role-pill {{ $roleClass }}">
                        {{ auth()->user()->position ?? 'พนักงาน' }}
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}" style="margin-left: 8px;">
                    @csrf
                    <button class="logout-btn" type="submit">
                        ออกจากระบบ
                    </button>
                </form>
            </div>

        </header>

        {{-- Urgent / Important Task Floating Card --}}
        @php
            $priorityOrder = ['ด่วน' => 1, 'สูง' => 2, 'ปกติ' => 3, 'ต่ำ' => 4];
            $importantTask = $tasks
                ->filter(fn($t) => $t->status !== 'เสร็จแล้ว')
                ->sort(function ($a, $b) use ($priorityOrder) {
                    $now = now();
                    $timeA = $a->due_at ? $now->diffInMinutes($a->due_at, false) : PHP_INT_MAX;
                    $timeB = $b->due_at ? $now->diffInMinutes($b->due_at, false) : PHP_INT_MAX;
                    if (($timeA < 0) !== ($timeB < 0)) return $timeA < 0 ? -1 : 1;
                    $pA = $priorityOrder[$a->priority] ?? 99;
                    $pB = $priorityOrder[$b->priority] ?? 99;
                    return $pA <=> $pB ?: $timeA <=> $timeB;
                })
                ->first();
        @endphp

        @if($importantTask)
            <div class="urgent-task-banner">
                <div class="urgent-task-content">
                    <span class="urgent-task-label">⚡ งานสำคัญเร่งด่วน</span>
                    <span class="urgent-task-title">{{ $importantTask->title }}</span>
                    <span class="urgent-task-meta">
                        👤 {{ $importantTask->assignee?->name ?? 'ยังไม่มอบหมาย' }} &nbsp;•&nbsp;
                        สถานะ: <strong style="color: #93c5fd;">{{ $importantTask->status }}</strong> &nbsp;•&nbsp;
                        ความสำคัญ: <strong style="color: #f87171;">{{ $importantTask->priority }}</strong>
                        @if($importantTask->due_at)
                            &nbsp;•&nbsp;
                            @if($importantTask->due_at->isPast())
                                <span style="color: #f87171; font-weight: 600;">🔴 เกินกำหนด</span>
                            @else
                                <span style="color: #fbbf24; font-weight: 600;">⏳ {{ $importantTask->due_at->diffForHumans() }}</span>
                            @endif
                        @endif
                    </span>
                </div>

                <a href="{{ route('tasks.index') }}"
                   style="color: var(--accent-blue); text-decoration: none; font-size: 13px; font-weight: 600; padding: 6px 12px; background: rgba(59, 130, 246, 0.15); border-radius: 8px;">
                    ดูรายละเอียด →
                </a>
            </div>
        @endif

        <!-- Chat Container -->
        <div class="chat-container" id="chatContainer">
            @foreach($messages as $message)
                @php
                    $isMe = $message->user_id === auth()->id();
                @endphp
                <div class="message-row {{ $isMe ? 'my-message' : 'other-message' }}" data-message-id="{{ $message->id }}">
                    @if(!$isMe)
                        <div class="message-sender">
                            👤 {{ $message->user?->name ?? 'User' }}
                        </div>
                    @endif

                    <div class="message-bubble">
                        {{ $message->message }}
                    </div>

                    <div class="message-time">
                        {{ $message->created_at ? $message->created_at->format('H:i') : '' }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input Bar -->
        <div class="input-bar">
            <form id="chatForm" method="POST" action="/messages" class="input-form">
                @csrf
                <input type="hidden" id="roomIdInput" name="room_id" value="{{ $selectedRoom }}">

                <input
                    type="text"
                    id="messageInput"
                    name="message"
                    class="chat-input"
                    placeholder="พิมพ์ข้อความในห้องนี้... (กด Enter เพื่อส่งทันที)"
                    required
                    autocomplete="off"
                >

                <button class="send-button" id="sendBtn" type="submit">
                    <span>ส่ง</span>
                    <span>➔</span>
                </button>
            </form>
        </div>

    </main>

    <!-- Create Room Modal -->
    <div id="createRoomModal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-title">
                <span>➕</span>
                <span>สร้างห้องแชตใหม่</span>
            </div>

            <form method="POST" action="{{ route('rooms.store') }}">
                @csrf

                <label class="form-label">ชื่อห้องแชต</label>
                <input type="text"
                       name="name"
                       class="form-input"
                       placeholder="เช่น แผนกการตลาด, โปรเจกต์ Alpha"
                       required>

                <label class="form-label">รายละเอียดห้อง (ถ้ามี)</label>
                <textarea name="description"
                          class="form-textarea"
                          rows="3"
                          placeholder="อธิบายวัตถุประสงค์ของห้องแชตนี้..."></textarea>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 10px;">
                    <button type="button"
                            onclick="document.getElementById('createRoomModal').style.display='none'"
                            style="padding: 9px 16px; border: 1px solid var(--border-color); background: transparent; color: #cbd5e1; border-radius: 8px; cursor: pointer;">
                        ยกเลิก
                    </button>

                    <button type="submit"
                            style="padding: 9px 20px; border: none; background: var(--accent-gradient); color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">
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

        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        function toggleSidebar(open) {
            if (open) {
                sidebar?.classList.add('open');
                sidebarBackdrop?.classList.add('open');
            } else {
                sidebar?.classList.remove('open');
                sidebarBackdrop?.classList.remove('open');
            }
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => toggleSidebar(true));
        }

        if (sidebarCloseBtn) {
            sidebarCloseBtn.addEventListener('click', () => toggleSidebar(false));
        }

        if (sidebarBackdrop) {
            sidebarBackdrop.addEventListener('click', () => toggleSidebar(false));
        }

        let highestMessageId = 0;
        document.querySelectorAll('.message-row[data-message-id]').forEach(el => {
            const id = parseInt(el.getAttribute('data-message-id'), 10);
            if (id > highestMessageId) highestMessageId = id;
        });

        function scrollToBottom() {
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }
        scrollToBottom();

        function appendMessage(data) {
            if (!chatContainer) return;
            if (data.id) {
                if (data.id > highestMessageId) highestMessageId = data.id;
                if (document.querySelector(`.message-row[data-message-id="${data.id}"]`)) {
                    return;
                }
            }

            const isMe = Number(data.user_id) === Number(currentUserId);
            const msgEl = document.createElement('div');
            msgEl.className = `message-row ${isMe ? 'my-message' : 'other-message'}`;
            if (data.id) msgEl.setAttribute('data-message-id', data.id);

            const nameHtml = !isMe ? `<div class="message-sender">👤 ${escapeHtml(data.user_name || 'User')}</div>` : '';
            const timeHtml = data.created_at ? `<div class="message-time">${escapeHtml(data.created_at)}</div>` : '';

            msgEl.innerHTML = `
                ${nameHtml}
                <div class="message-bubble">${escapeHtml(data.message)}</div>
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
                    const res = await fetch('/messages', {
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
                        const err = await res.text();
                        console.error('Send error:', err);
                        messageInput.value = text;
                        alert('ไม่สามารถส่งข้อความได้ กรุณาลองใหม่อีกครั้ง');
                    }
                } catch (err) {
                    console.error('Fetch error:', err);
                    messageInput.value = text;
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + (err.message || err));
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

        // Background sync to ensure zero missed messages
        if (currentRoomId) {
            setInterval(async () => {
                try {
                    const res = await fetch(`/messages?room_id=${currentRoomId}&after_id=${highestMessageId}`, {
                        headers: { 'Accept': 'application/json' }
                    });
                    if (res.ok) {
                        const newMsgs = await res.json();
                        if (Array.isArray(newMsgs)) {
                            newMsgs.forEach(msg => {
                                appendMessage(msg);
                            });
                        }
                    }
                } catch (e) {
                    // silently handle offline blips
                }
            }, 3000);
        }
    });
</script>

</body>
</html>