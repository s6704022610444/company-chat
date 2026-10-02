<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>CompanyChat - ระบบแชตและจัดการงานองค์กร</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <script>
        (function() {
            try {
                var theme = localStorage.getItem('companychat_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {}
        })();
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Prompt -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* YouTube Light Mode (Default) */
            --bg-app: #ffffff;
            --bg-header: #ffffff;
            --bg-sidebar: #ffffff;
            --bg-sidebar-footer: #ffffff;
            --bg-main: #ffffff;
            --bg-chat: #ffffff;
            --bg-surface: #f9f9f9;
            --bg-surface-hover: #f2f2f2;
            --bg-active-pill: #f2f2f2;
            --bg-card: #ffffff;
            --bg-input: #f8fafc;
            --bg-input-focus: #ffffff;
            
            --border-color: #e5e5e5;
            --border-subtle: #f0f0f0;
            --border-input: #cbd5e1;
            
            --text-primary: #0f0f0f;
            --text-secondary: #606060;
            --text-muted: #909090;
            
            --logo-bg: transparent;
            --logo-color: #00C853;
            
            /* Message Bubbles */
            --bubble-me-bg: #0f0f0f;
            --bubble-me-text: #ffffff;
            --bubble-me-border: #0f0f0f;
            --bubble-other-bg: #f2f2f2;
            --bubble-other-text: #0f0f0f;
            --bubble-other-border: #e5e5e5;
            --bubble-sender-color: #0f0f0f;
            
            /* Action Buttons (YouTube style: solid dark pill) */
            --btn-primary-bg: #0f0f0f;
            --btn-primary-hover: #272727;
            --btn-primary-text: #ffffff;
            
            --nav-button-color: #0f0f0f;
            --nav-button-bg: #f9f9f9;
            --nav-button-hover: #f2f2f2;
            --nav-button-active-bg: #f2f2f2;
            --nav-button-active-border: #0f0f0f;
            --nav-button-active-color: #0f0f0f;
            
            --room-link-color: #0f0f0f;
            --room-active-bg: #f2f2f2;
            --room-hash-color: #606060;

            --badge-blue-bg: #e0f2fe;
            --badge-blue-text: #0369a1;
            --badge-amber-bg: #fef3c7;
            --badge-amber-text: #92400e;
            --badge-red-bg: #fee2e2;
            --badge-red-text: #b91c1c;

            --modal-overlay-bg: rgba(0, 0, 0, 0.45);
            --scrollbar-thumb: #cccccc;
            --dropdown-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            --focus-ring: 0 0 0 2px rgba(6, 95, 212, 0.25);
            --focus-border: #065fd4;
        }

        [data-theme="dark"] {
            /* YouTube Dark Mode */
            --bg-app: #0f0f0f;
            --bg-header: #0f0f0f;
            --bg-sidebar: #0f0f0f;
            --bg-sidebar-footer: #0f0f0f;
            --bg-main: #0f0f0f;
            --bg-chat: #0f0f0f;
            --bg-surface: #181818;
            --bg-surface-hover: #272727;
            --bg-active-pill: #272727;
            --bg-card: #181818;
            --bg-input: #121212;
            --bg-input-focus: #181818;
            
            --border-color: #272727;
            --border-subtle: #212121;
            --border-input: #383838;
            
            --text-primary: #f1f1f1;
            --text-secondary: #aaaaaa;
            --text-muted: #717171;
            
            --logo-bg: transparent;
            --logo-color: #00C853;
            
            /* Message Bubbles */
            --bubble-me-bg: #272727;
            --bubble-me-text: #f1f1f1;
            --bubble-me-border: #3f3f3f;
            --bubble-other-bg: #1e1e1e;
            --bubble-other-text: #f1f1f1;
            --bubble-other-border: #2d2d2d;
            --bubble-sender-color: #aaaaaa;
            
            /* Action Buttons (YouTube Dark style: white pill) */
            --btn-primary-bg: #f1f1f1;
            --btn-primary-hover: #ffffff;
            --btn-primary-text: #0f0f0f;
            
            --nav-button-color: #f1f1f1;
            --nav-button-bg: #181818;
            --nav-button-hover: #272727;
            --nav-button-active-bg: #272727;
            --nav-button-active-border: #f1f1f1;
            --nav-button-active-color: #ffffff;
            
            --room-link-color: #f1f1f1;
            --room-active-bg: #272727;
            --room-hash-color: #aaaaaa;

            --badge-blue-bg: rgba(56, 189, 248, 0.18);
            --badge-blue-text: #38bdf8;
            --badge-amber-bg: rgba(245, 158, 11, 0.18);
            --badge-amber-text: #fbbf24;
            --badge-red-bg: rgba(239, 68, 68, 0.18);
            --badge-red-text: #f87171;

            --modal-overlay-bg: rgba(0, 0, 0, 0.75);
            --scrollbar-thumb: #3f3f3f;
            --dropdown-shadow: 0 16px 40px rgba(0, 0, 0, 0.6);
            --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.35);
            --focus-ring: 0 0 0 2px rgba(62, 166, 255, 0.35);
            --focus-border: #3ea6ff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Prompt', 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-app);
            color: var(--text-primary);
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

                .app {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            background: var(--bg-app);
        }

        /* Top Header (Full Width Unified Bar - YouTube Style) */
        .top-header {
            height: 60px;
            min-height: 60px;
            max-height: 60px;
            background: var(--bg-header);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px 0 0;
            z-index: 30;
            box-sizing: border-box;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 280px;
            min-width: 280px;
            max-width: 280px;
            height: 100%;
            padding: 0 20px;
            box-sizing: border-box;
            border-right: 1px solid var(--border-color);
            flex-shrink: 0;
            transition: border-color 0.2s ease;
        }

        .header-center {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
            padding-left: 20px;
            height: 100%;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: transparent;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: none !important;
        }

        .app-logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .logo-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.4px;
            color: var(--text-primary);
        }

        .app-body {
            display: flex;
            flex: 1;
            height: calc(100vh - 60px);
            min-height: 0;
            overflow: hidden;
            background: var(--bg-app);
        }

        /* Sidebar (Below Top Header - YouTube Clean Style) */
        .sidebar {
            width: 280px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            user-select: none;
            flex-shrink: 0;
            z-index: 20;
            height: 100%;
            box-sizing: border-box;
            transition: background-color 0.2s ease, border-color 0.2s ease;
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
            width: 6px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 10px;
        }

        .nav-section-title {
            font-size: 12.5px;
            letter-spacing: 0.2px;
            color: var(--text-secondary);
            font-weight: 700;
            margin-bottom: 8px;
            padding-left: 8px;
        }

        .nav-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--nav-button-color);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            background: var(--nav-button-bg);
            border: 1px solid var(--border-subtle);
            transition: all 0.18s ease;
            margin-bottom: 6px;
        }

        .nav-button:hover {
            background: var(--nav-button-hover);
            transform: translateX(2px);
        }

        .nav-button.active {
            background: var(--nav-button-active-bg) !important;
            border-color: var(--nav-button-active-border) !important;
            color: var(--nav-button-active-color) !important;
            font-weight: 700;
        }

        .nav-badge {
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 12px;
            font-weight: 600;
        }

        .badge-red {
            background: var(--badge-red-bg);
            color: var(--badge-red-text);
        }

        .badge-blue {
            background: var(--badge-blue-bg);
            color: var(--badge-blue-text);
        }

        .badge-amber {
            background: var(--badge-amber-bg);
            color: var(--badge-amber-text);
        }

        /* Room list items */
        .room-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-radius: 9px;
            margin-bottom: 4px;
            transition: all 0.18s ease;
            border: 1px solid transparent;
        }

        .room-item:hover {
            background: var(--bg-surface-hover);
        }

        .room-item.active {
            background: var(--room-active-bg);
        }

        .room-link {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--room-link-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .room-item.active .room-link {
            font-weight: 700;
        }

        .room-hash {
            color: var(--room-hash-color);
            font-weight: 700;
            flex-shrink: 0;
        }

        .room-name-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
        }

        .room-actions {
            display: flex;
            align-items: center;
            gap: 2px;
            flex-shrink: 0;
            margin-left: 6px;
        }

        .room-edit-btn,
        .room-delete-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px 5px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.18s ease;
            line-height: 1;
        }

        .room-edit-btn {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .room-edit-btn:hover {
            opacity: 1;
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.12);
            transform: scale(1.08);
        }

        .room-delete-btn {
            color: #ef4444;
            opacity: 0.85;
        }

        .room-delete-btn:hover {
            opacity: 1;
            color: #dc2626;
            background: rgba(239, 68, 68, 0.15);
            transform: scale(1.08);
        }

        /* Main Workspace */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--bg-main);
            position: relative;
            min-width: 0;
            height: 100%;
            overflow: hidden;
            transition: background-color 0.2s ease;
        }

        

        .room-title-area {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .room-title-area h2 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .live-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .live-dot {
            width: 7px;
            height: 7px;
            background-color: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 8px #22c55e;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.8; }
        }

        /* User profile & avatar */
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--btn-primary-bg);
            color: var(--btn-primary-text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
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
            background: rgba(255, 61, 0, 0.15);
            color: #FF3D00;
            border: 1px solid rgba(255, 61, 0, 0.4);
        }
        [data-theme="dark"] .role-admin {
            color: #FF3D00;
        }

        .role-manager {
            background: rgba(255, 179, 0, 0.15);
            color: #FFB300;
            border: 1px solid rgba(255, 179, 0, 0.4);
        }
        [data-theme="dark"] .role-manager {
            color: #FFB300;
        }

        .role-supervisor {
            background: rgba(0, 176, 255, 0.15);
            color: #00B0FF;
            border: 1px solid rgba(0, 176, 255, 0.4);
        }
        [data-theme="dark"] .role-supervisor {
            color: #00B0FF;
        }

        .role-staff {
            background: rgba(0, 200, 83, 0.15);
            color: #00C853;
            border: 1px solid rgba(0, 200, 83, 0.4);
        }
        [data-theme="dark"] .role-staff {
            color: #00C853;
        }

        .logout-btn {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12.5px;
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

        /* Sidebar Footer (Bottom-Left Settings & Profile - Exact Height Aligned) */
        .sidebar-footer {
            height: 72px;
            min-height: 72px;
            max-height: 72px;
            box-sizing: border-box;
            padding: 0 16px;
            border-top: 1px solid var(--border-color);
            background: var(--bg-sidebar-footer);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-shrink: 0;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .user-footer-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 2px;
            flex: 1;
            min-width: 0;
        }

        .user-footer-meta {
            display: flex;
            flex-direction: column;
            min-width: 0;
            line-height: 1.25;
        }

        .user-footer-name {
            font-weight: 600;
            font-size: 13.5px;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .settings-icon-btn {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 17px;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .settings-icon-btn:hover {
            background: var(--bg-surface-hover);
            transform: rotate(45deg);
        }

        /* Theme Toggle Button (Top-Right Header) */
        .theme-toggle-btn {
            position: relative;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
            flex-shrink: 0;
        }

        .theme-toggle-btn:hover {
            background: var(--bg-surface-hover);
            transform: scale(1.06);
            border-color: #00C853;
        }

        .theme-toggle-btn:active {
            transform: scale(0.96);
        }

        /* Notification Bell (Top-Right) */
        .bell-btn {
            position: relative;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: inherit;
        }

        .bell-btn:hover {
            background: var(--bg-surface-hover);
            transform: scale(1.06);
            border-color: #00C853;
        }

        .bell-btn:active {
            transform: scale(0.96);
        }

        .bell-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #ffffff;
            font-size: 10.5px;
            font-weight: 700;
            min-width: 19px;
            height: 19px;
            padding: 0 4px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.6);
            border: 2px solid var(--bg-header);
            animation: bellBadgePulse 2s infinite;
        }

        @keyframes bellBadgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 360px;
            max-width: 90vw;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            box-shadow: var(--dropdown-shadow);
            z-index: 100;
            flex-direction: column;
            overflow: hidden;
            animation: dropFade 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .notification-dropdown.show {
            display: flex;
        }

        @keyframes dropFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .notification-header {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-surface);
            color: var(--text-primary);
        }

        .notification-body {
            max-height: 380px;
            overflow-y: auto;
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            background: var(--bg-card);
        }

        .notification-body::-webkit-scrollbar {
            width: 5px;
        }
        .notification-body::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 10px;
        }

        .notification-item {
            padding: 10px 12px;
            border-radius: 10px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            cursor: pointer;
            transition: all 0.18s;
            text-align: left;
        }

        .notification-item:hover {
            background: var(--bg-surface-hover);
            transform: translateX(2px);
        }

        .notification-item-title {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.35;
        }

        .notification-item-meta {
            font-size: 11.5px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .notification-empty {
            padding: 30px 16px;
            text-align: center;
            color: var(--text-muted);
            background: var(--bg-card);
        }

        .notification-footer {
            padding: 11px 16px;
            border-top: 1px solid var(--border-color);
            background: var(--bg-surface);
            text-align: center;
        }

        .notification-view-all {
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.15s;
        }

        .notification-view-all:hover {
            text-decoration: underline;
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
            background: var(--bg-chat);
            transition: background-color 0.2s ease;
        }

        .chat-container::-webkit-scrollbar {
            width: 6px;
        }
        .chat-container::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 10px;
        }

                /* Messages (Modern Chat Bubble with Avatar & Sender Name) */
        .message-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 78%;
            animation: fadeIn 0.2s ease forwards;
            margin-bottom: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-row.my-message {
            align-self: flex-end;
            flex-direction: row;
        }

        .message-row.other-message {
            align-self: flex-start;
            flex-direction: row;
        }

        .message-avatar-wrap {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            margin-top: 2px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .chat-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 50%;
        }

        .chat-avatar-fallback {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-primary);
            background: var(--nav-hover);
            border-radius: 50%;
        }

        .message-content-wrap {
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .my-message .message-content-wrap {
            align-items: flex-end;
        }

        .other-message .message-content-wrap {
            align-items: flex-start;
        }

        .message-header-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
            padding: 0 4px;
        }

        .my-message .message-header-line {
            justify-content: flex-end;
        }

        .message-sender-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--bubble-sender-color);
            letter-spacing: 0.15px;
        }

        .my-message .message-sender-name {
            font-weight: 700;
        }

        .message-bubble {
            padding: 11px 16px;
            font-size: 14.5px;
            line-height: 1.55;
            word-break: break-word;
            position: relative;
        }

        .my-message .message-bubble {
            background: var(--bubble-me-bg);
            color: var(--bubble-me-text);
            border: 1px solid var(--bubble-me-border);
            border-radius: 18px 18px 4px 18px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .other-message .message-bubble {
            background: var(--bubble-other-bg);
            color: var(--bubble-other-text);
            border: 1px solid var(--bubble-other-border);
            border-radius: 18px 18px 18px 4px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .message-time {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* Message Media (Images & Voice) */
        .message-image-wrap {
            margin-bottom: 6px;
        }

        .message-chat-image {
            max-width: 100%;
            max-height: 280px;
            border-radius: 12px;
            display: block;
            object-fit: contain;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            transition: opacity 0.2s ease, transform 0.15s ease;
        }

        .message-chat-image:hover {
            opacity: 0.92;
            transform: scale(1.015);
        }

        .message-audio-wrap {
            margin-bottom: 6px;
        }

        .message-audio-player {
            width: 100%;
            min-width: 220px;
            max-width: 300px;
            height: 38px;
            border-radius: 20px;
            display: block;
            outline: none;
        }

        /* Chat Image Lightbox Modal */
        .chat-image-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .chat-image-modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .chat-image-modal-dialog {
            position: relative;
            z-index: 10;
            max-width: 95vw;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            background: rgba(24, 28, 38, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7);
            animation: zoom-in-image-modal 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes zoom-in-image-modal {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .chat-image-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            gap: 12px;
        }

        .chat-image-modal-title {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #f1f5f9;
        }

        .chat-image-modal-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .chat-image-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            font-size: 12.5px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.18s ease;
            font-family: inherit;
        }

        .chat-image-action-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .chat-image-close-btn {
            background: transparent;
            border: none;
            color: #94a3b8;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.18s ease;
            padding: 0;
        }

        .chat-image-close-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .chat-image-modal-body {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            max-height: calc(92vh - 60px);
            overflow: auto;
            background: #0b0f19;
        }

        .chat-modal-view-img {
            max-width: 90vw;
            max-height: calc(85vh - 70px);
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            user-select: none;
        }

        .chat-image-loader {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 40px;
            color: #cbd5e1;
            font-size: 13.5px;
        }

        .chat-image-spinner {
            width: 36px;
            height: 36px;
            border: 3px solid rgba(255, 255, 255, 0.15);
            border-top-color: #38bdf8;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .chat-image-error {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
            padding: 40px 24px;
            max-width: 380px;
        }

        .chat-image-error-title {
            font-size: 16px;
            font-weight: 600;
            color: #f1f5f9;
            margin: 0;
        }

        .chat-image-error-subtitle {
            font-size: 13px;
            color: #94a3b8;
            margin: 0 0 12px 0;
            line-height: 1.4;
        }

        .chat-image-retry-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #f1f5f9;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            font-family: inherit;
        }

        .chat-image-retry-btn:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        .message-text {
            word-break: break-word;
        }

        .message-bubble > :last-child {
            margin-bottom: 0;
        }

        /* Settings Avatar Uploader Card */
        .avatar-uploader-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .settings-avatar-preview-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            flex-shrink: 0;
            overflow: hidden;
            border: 2px solid var(--border-color);
            background: var(--nav-hover);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .settings-avatar-preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .settings-avatar-fallback-text {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .btn-avatar-pick {
            padding: 8px 14px;
            border-radius: 8px;
            background: var(--btn-primary-bg);
            color: var(--btn-primary-text);
            border: none;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s;
            font-family: inherit;
        }

        .btn-avatar-pick:hover {
            opacity: 0.9;
        }

        .btn-avatar-remove {
            padding: 8px 12px;
            border-radius: 8px;
            background: transparent;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.4);
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-avatar-remove:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Input Bar (Exact Height Aligned with Sidebar Footer) */
        .input-bar {
            position: relative;
            height: 72px;
            min-height: 72px;
            max-height: 72px;
            box-sizing: border-box;
            padding: 0 24px;
            background: var(--bg-chat);
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .input-form {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-input);
            border: 1.5px solid var(--border-input);
            border-radius: 14px;
            padding: 6px 8px 6px 10px;
            transition: all 0.2s ease;
        }

        /* Chat Tool Buttons (Attach Photo & Voice) */
        .chat-tool-btn {
            background: transparent;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: var(--text-secondary);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.18s ease;
            padding: 0;
        }

        .chat-tool-btn:hover {
            background: var(--bg-surface-hover);
            color: var(--text-primary);
        }

        .chat-tool-btn.active-recording {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.12);
            animation: pulse-recording 1.2s infinite ease-in-out;
        }

        @keyframes pulse-recording {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.08); opacity: 0.85; }
        }

        /* Floating Attached Media Preview Bar */
        .chat-media-preview-bar {
            position: absolute;
            bottom: calc(100% + 8px);
            left: 24px;
            right: 24px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 8px 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            z-index: 50;
            display: none;
            flex-direction: column;
            gap: 8px;
            backdrop-filter: blur(10px);
        }

        .media-preview-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 8px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
        }

        .media-preview-thumb {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: var(--bg-app);
            flex-shrink: 0;
        }

        .media-preview-meta {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
            min-width: 0;
        }

        .media-preview-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .media-preview-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .media-preview-close {
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .media-preview-close:hover {
            background: var(--bg-surface-hover);
            color: #ef4444;
        }

        /* Voice Live Recording Box */
        .voice-recording-box {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .voice-live-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ef4444;
            animation: pulse-recording 1.2s infinite ease-in-out;
            flex-shrink: 0;
        }

        .voice-status-label {
            font-size: 13px;
            font-weight: 600;
            color: #ef4444;
        }

        .voice-timer {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            font-variant-numeric: tabular-nums;
            margin-left: auto;
        }

        .btn-voice-stop {
            background: #ef4444;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: inherit;
            transition: opacity 0.15s;
        }

        .btn-voice-stop:hover {
            opacity: 0.9;
        }

        .voice-playback-box {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .media-preview-audio {
            flex: 1;
            height: 36px;
            outline: none;
        }

        .input-form:focus-within {
            border-color: var(--focus-border);
            box-shadow: var(--focus-ring);
            background: var(--bg-input-focus);
        }

        .chat-input {
            flex: 1;
            background: transparent;
            border: none;
            color: var(--text-primary);
            font-size: 14.5px;
            font-family: inherit;
            outline: none;
        }

        .chat-input::placeholder {
            color: var(--text-muted);
        }

        .send-button {
            background: var(--btn-primary-bg);
            border: none;
            color: var(--btn-primary-text);
            padding: 9px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
            transition: all 0.18s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .send-button:hover {
            background: var(--btn-primary-hover);
            transform: scale(1.02);
        }

        .send-button:active {
            transform: scale(0.98);
        }

        /* Task Workspaces */
        .task-workspace {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            background: var(--bg-main);
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: background-color 0.2s ease;
        }

        .task-content-inner {
            max-width: 900px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .task-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.2s ease;
            position: relative;
        }

        .task-card:hover {
            border-color: var(--border-input);
            transform: translateY(-1px);
        }

        .task-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .task-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.4;
        }

        .task-desc {
            font-size: 13.5px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 12px;
            white-space: pre-wrap;
        }

        .badges-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .badge {
            font-size: 11.5px;
            padding: 3px 9px;
            border-radius: 6px;
            font-weight: 600;
        }

        .priority-urgent {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        [data-theme="dark"] .priority-urgent {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.4);
        }

        .priority-high {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }
        [data-theme="dark"] .priority-high {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.4);
        }

        .priority-normal {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        [data-theme="dark"] .priority-normal {
            background: rgba(56, 189, 248, 0.2);
            color: #38bdf8;
            border-color: rgba(56, 189, 248, 0.4);
        }

        .priority-low {
            background: var(--bg-surface);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }

        .status-badge {
            background: var(--bg-surface);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .due-overdue {
            background: #fee2e2;
            color: #dc2626;
            font-weight: 700;
        }
        [data-theme="dark"] .due-overdue {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171;
        }

        .due-warning {
            background: #fef3c7;
            color: #b45309;
            font-weight: 700;
        }
        [data-theme="dark"] .due-warning {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
        }

        .due-normal {
            background: #ecfdf5;
            color: #047857;
        }
        [data-theme="dark"] .due-normal {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399;
        }

        .meta-line {
            font-size: 12px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .task-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding-top: 12px;
            border-top: 1px solid var(--border-subtle);
            flex-wrap: wrap;
        }

        .btn-action-edit {
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 600;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s;
        }

        .btn-action-edit:hover {
            background: var(--bg-surface-hover);
            color: #3b82f6;
            border-color: rgba(59, 130, 246, 0.4);
        }

        .btn-action-delete {
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 600;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            color: #ef4444;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s;
            font-family: inherit;
        }

        .btn-action-delete:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .status-select {
            padding: 6px 10px;
            border-radius: 7px;
            background: var(--bg-input);
            border: 1px solid var(--border-input);
            color: var(--text-primary);
            font-size: 12.5px;
            font-family: inherit;
            outline: none;
            cursor: pointer;
        }

        .status-select:focus {
            border-color: var(--focus-border);
            box-shadow: var(--focus-ring);
        }

        .history-box {
            background: var(--bg-surface);
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 12px;
            border: 1px solid var(--border-color);
        }

        .history-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
        }

        .history-item {
            font-size: 12px;
            color: var(--text-primary);
            padding: 5px 0;
            border-bottom: 1px solid var(--border-subtle);
            display: flex;
            justify-content: space-between;
        }

        /* Create Task Card */
        .create-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 22px;
            box-shadow: var(--card-shadow);
        }

        .card-header-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-full {
            grid-column: span 2;
        }

        .form-grid label, .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .form-grid input, .form-grid textarea, .form-grid select, .form-input, .form-textarea {
            width: 100%;
            padding: 9px 12px;
            border-radius: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border-input);
            color: var(--text-primary);
            font-family: inherit;
            font-size: 13.5px;
            outline: none;
            transition: all 0.15s;
        }

        .form-grid input:focus, .form-grid textarea:focus, .form-grid select:focus, .form-input:focus, .form-textarea:focus {
            background: var(--bg-input-focus);
            border-color: var(--focus-border);
            box-shadow: var(--focus-ring);
        }

        .btn-submit {
            background: var(--btn-primary-bg);
            color: var(--btn-primary-text);
            border: none;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.18s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-submit:hover {
            background: var(--btn-primary-hover);
            transform: scale(1.02);
        }

        /* Filter Pills Bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            margin-bottom: 8px;
        }

        .filter-pill {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 600;
            background: var(--bg-surface);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.15s;
        }

        .filter-pill:hover {
            background: var(--bg-surface-hover);
            color: var(--text-primary);
        }

        .filter-pill.active {
            background: var(--btn-primary-bg);
            color: var(--btn-primary-text);
            border-color: var(--btn-primary-bg);
        }

        /* Modals */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--modal-overlay-bg);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 16px;
            animation: fadeIn 0.2s ease;
        }

        .modal-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            width: 440px;
            max-width: 95vw;
            box-shadow: var(--dropdown-shadow);
            color: var(--text-primary);
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }


        /* Mobile Responsive Styles */
        .mobile-toggle-btn {
            display: none;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            width: 38px;
            height: 38px;
            border-radius: 9px;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            z-index: 199;
        }

        /* Mobile Drawer Header */
        .sidebar-mobile-header {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-surface);
            flex-shrink: 0;
        }

        .sidebar-close-btn {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 20px;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
        }

        .sidebar-close-btn:hover {
            color: var(--text-primary);
            background: var(--bg-surface-hover);
        }

        @media (max-width: 768px) {
            .mobile-toggle-btn {
                display: flex;
                width: 36px;
                height: 36px;
                font-size: 16px;
                border-radius: 8px;
                flex-shrink: 0;
            }

            .top-header {
                height: 56px;
                min-height: 56px;
                max-height: 56px;
                padding: 0 10px;
                gap: 6px;
            }

            .app-body {
                height: calc(100vh - 56px);
                height: calc(100dvh - 56px);
            }

            .header-brand {
                width: auto;
                min-width: auto;
                max-width: none;
                border-right: none;
                padding: 0;
                gap: 6px;
                flex-shrink: 0;
            }

            /* On small screens, hide text "CompanyChat" in top header so room title has ample space */
            .header-brand .logo-text {
                display: none;
            }

            .header-brand .logo-icon {
                width: 34px;
                height: 34px;
            }

            .header-center {
                padding-left: 6px;
                min-width: 0;
                flex: 1;
                overflow: hidden;
            }

            .room-title-area {
                min-width: 0;
                max-width: 100%;
                overflow: hidden;
            }

            .room-title-area h2 {
                font-size: 14.5px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: flex;
                align-items: center;
                gap: 4px;
                line-height: 1.25;
                margin: 0;
            }

            .live-status {
                font-size: 10.5px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: flex;
                align-items: center;
                gap: 5px;
                line-height: 1.2;
                margin-top: 2px;
            }

            .sidebar-mobile-header {
                display: flex;
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                width: 300px;
                max-width: 85vw;
                height: 100vh;
                height: 100dvh;
                z-index: 200;
                transform: translateX(-100%);
                transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1);
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-backdrop.open {
                display: block;
            }

            .sidebar-footer {
                height: auto;
                min-height: 64px;
                padding: 12px 14px;
                padding-bottom: calc(12px + env(safe-area-inset-bottom, 0px));
                background: var(--bg-surface);
                border-top: 1px solid var(--border-color);
            }

            .main {
                width: 100vw;
                min-width: 100vw;
            }

            .header-right {
                gap: 8px;
            }

            .theme-toggle-btn {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .bell-btn {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }

            .notification-dropdown {
                right: -6px;
                width: 320px;
                max-width: calc(100vw - 20px);
            }

            .chat-container {
                padding: 12px 10px;
                gap: 12px;
            }

            .message-row {
                max-width: 90%;
            }

            .message-content-wrap {
                max-width: 100%;
            }

            .message-bubble {
                font-size: 14px;
                padding: 9px 13px;
                word-break: break-word;
                overflow-wrap: anywhere;
            }

            .message-chat-image {
                max-width: 230px;
                max-height: 230px;
            }

            .message-audio-player {
                max-width: 200px;
                height: 36px;
            }

            .input-bar {
                height: auto;
                min-height: 60px;
                padding: 8px 10px;
                padding-bottom: calc(8px + env(safe-area-inset-bottom, 0px));
            }

            .input-box {
                height: 40px;
                padding: 0 10px;
                font-size: 14px;
            }

            .chat-tool-btn, .send-btn {
                width: 38px;
                height: 38px;
            }

            .chat-media-preview-bar {
                left: 10px;
                right: 10px;
                bottom: calc(100% + 6px);
            }

            .task-workspace {
                padding: 14px 10px;
            }

            .task-card {
                padding: 14px 12px;
            }

            .filter-pills-bar {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 6px;
                -webkit-overflow-scrolling: touch;
            }

            .filter-pill {
                flex-shrink: 0;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-full {
                grid-column: span 1;
            }

            .modal-card {
                width: 95vw !important;
                margin: 10px auto;
                padding: 18px 14px;
            }
        }

        /* ========================================================
           COMPANY NEWS & ANNOUNCEMENTS STYLES
           ======================================================== */
        .news-workspace {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 60px);
            overflow-y: auto;
            background: var(--bg-app);
            padding: 24px 20px 60px;
            scroll-behavior: smooth;
        }

        .news-container {
            max-width: 860px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .news-filter-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }

        .news-filter-bar::-webkit-scrollbar {
            display: none;
        }

        .news-filter-chip {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-secondary);
            white-space: nowrap;
            transition: all 0.2s ease;
            user-select: none;
        }

        .news-filter-chip:hover {
            color: var(--text-primary);
            border-color: var(--text-muted);
        }

        .news-filter-chip.active {
            background: var(--text-primary);
            color: var(--bg-app);
            border-color: var(--text-primary);
            font-weight: 600;
        }

        .news-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 22px;
            box-shadow: var(--card-shadow);
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .news-card:hover {
            box-shadow: 0 10px 32px rgba(0, 0, 0, 0.15);
        }

        .news-card.is-pinned {
            border-color: rgba(255, 179, 0, 0.45);
            background: linear-gradient(180deg, rgba(255, 179, 0, 0.04) 0%, var(--bg-card) 24%);
            box-shadow: 0 4px 20px rgba(255, 179, 0, 0.08);
        }

        .news-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .news-author-group {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .news-author-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 1.5px solid var(--border-color);
        }

        .news-author-initial {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #00C853, #009624);
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .news-author-meta {
            display: flex;
            flex-direction: column;
            gap: 3px;
            min-width: 0;
        }

        .news-author-name {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .news-timestamp {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .news-title {
            font-size: 18.5px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.4;
            letter-spacing: -0.2px;
            word-break: break-word;
        }

        .news-content {
            font-size: 14.5px;
            line-height: 1.7;
            color: var(--text-primary);
            word-break: break-word;
            opacity: 0.94;
        }

        .news-cover-wrap {
            width: 100%;
            max-height: 440px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            cursor: pointer;
            position: relative;
        }

        .news-cover-img {
            width: 100%;
            max-height: 440px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .news-cover-wrap:hover .news-cover-img {
            transform: scale(1.015);
        }

        .news-audio-player {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
        }

        .news-audio-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(0, 200, 83, 0.15);
            color: #00C853;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .news-audio-info {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .news-audio-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .news-audio-element {
            width: 100%;
            height: 34px;
            outline: none;
        }

        .news-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 14px;
            border-top: 1px solid var(--border-color);
        }

        .news-like-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid var(--border-color);
            background: var(--bg-surface);
            color: var(--text-secondary);
            transition: all 0.2s ease;
            user-select: none;
        }

        .news-like-btn:hover {
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.35);
            background: rgba(239, 68, 68, 0.06);
            transform: scale(1.02);
        }

        .news-like-btn.liked {
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.4);
            background: rgba(239, 68, 68, 0.12);
        }

        .news-badge-pinned {
            background: rgba(255, 179, 0, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(255, 179, 0, 0.35);
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .news-admin-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-news-action {
            background: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 12px;
            padding: 4px 10px;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.15s;
        }

        .btn-news-action:hover {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--text-muted);
        }

        .btn-news-action.danger {
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .btn-news-action.danger:hover {
            color: #dc2626;
            border-color: rgba(239, 68, 68, 0.5);
            background: rgba(239, 68, 68, 0.12);
        }

        .btn-news-action.pinned {
            color: #f59e0b;
            border-color: rgba(245, 158, 11, 0.4);
            background: rgba(245, 158, 11, 0.08);
        }

        .btn-news-action.pinned:hover {
            color: #d97706;
            border-color: rgba(245, 158, 11, 0.6);
            background: rgba(245, 158, 11, 0.15);
        }

        .chat-news-card {
            background: rgba(0, 200, 83, 0.12);
            border: 1px solid rgba(0, 200, 83, 0.35);
            border-radius: 10px;
            padding: 10px 14px;
            margin-top: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
        }
        .chat-news-card:hover {
            background: rgba(0, 200, 83, 0.2);
            border-color: #00C853;
            transform: translateY(-1px);
        }
        .chat-link {
            color: #38bdf8;
            text-decoration: underline;
            word-break: break-all;
        }
        .my-message .chat-link {
            color: #a5f3fc;
        }

        /* Level 1 Feature Styles: File Cards, Mentions, Message Actions, DMs */
        .chat-file-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px;
            margin-top: 6px;
            transition: all 0.2s ease;
            max-width: 380px;
        }
        .chat-file-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        .chat-file-icon {
            font-size: 26px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-file-info {
            flex: 1;
            min-width: 0;
        }
        .chat-file-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
        .chat-file-size {
            font-size: 11px;
            color: var(--text-secondary);
            margin-top: 2px;
        }
        .chat-file-download-btn {
            background: rgba(59, 130, 246, 0.15);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }
        .chat-file-download-btn:hover {
            background: #3b82f6;
            color: #ffffff;
        }

        /* Mention styles */
        .mention-badge {
            background: rgba(56, 189, 248, 0.18);
            color: #38bdf8;
            font-weight: 600;
            padding: 1px 6px;
            border-radius: 5px;
            display: inline-block;
            border: 1px solid rgba(56, 189, 248, 0.3);
            margin: 0 1px;
        }
        .mention-badge.mention-all {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
            border-color: rgba(245, 158, 11, 0.4);
        }
        .message-row.is-mentioned .message-bubble {
            border-color: #f59e0b !important;
            box-shadow: 0 0 14px rgba(245, 158, 11, 0.25);
            background: rgba(245, 158, 11, 0.06);
        }

        /* Mention autocomplete dropdown */
        .mention-autocomplete-dropdown {
            position: absolute;
            bottom: 74px;
            left: 20px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 280px;
            max-height: 240px;
            overflow-y: auto;
            z-index: 1000;
            padding: 6px;
            display: none;
        }
        .mention-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.15s;
            font-size: 13px;
            color: var(--text-primary);
        }
        .mention-item:hover, .mention-item.selected {
            background: var(--bg-hover);
        }
        .mention-item-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .mention-item-fallback {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Message Action Toolbar (Edit / Delete) */
        .message-row {
            position: relative;
        }
        .message-action-toolbar {
            position: absolute;
            top: -12px;
            display: none;
            align-items: center;
            gap: 2px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 2px 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10;
        }
        .message-row.my-message .message-action-toolbar {
            right: 48px;
        }
        .message-row.other-message .message-action-toolbar {
            left: 48px;
        }
        .message-row:hover .message-action-toolbar {
            display: flex;
        }
        .btn-msg-tool {
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 12px;
            padding: 4px 7px;
            border-radius: 6px;
            color: var(--text-secondary);
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-msg-tool:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }
        .btn-msg-tool.danger {
            color: #ef4444;
        }
        .btn-msg-tool.danger:hover {
            color: #dc2626;
            background: rgba(239, 68, 68, 0.12);
        }
        .message-edited-badge {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-left: 5px;
            font-style: italic;
        }

        /* Inline Message Editor */
        .msg-edit-box {
            display: flex;
            flex-direction: column;
            gap: 6px;
            width: 100%;
            min-width: 250px;
        }
        .msg-edit-textarea {
            width: 100%;
            background: var(--bg-surface);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13.5px;
            font-family: inherit;
            resize: vertical;
            outline: none;
            box-sizing: border-box;
        }
        .msg-edit-textarea:focus {
            border-color: #3b82f6;
        }
        .msg-edit-btn-row {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
        }
        .btn-save-edit {
            background: #10b981;
            color: #fff;
            border: none;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-cancel-edit {
            background: var(--bg-surface);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
        /* ============================================================ */
        /* CHAT EXPERIENCE: REACTIONS, REPLIES, LIGHTBOX, MEMBER MANAGE */
        /* ============================================================ */

        /* Reaction Quick Picker inside Action Toolbar */
        .msg-reaction-picker {
            display: flex;
            align-items: center;
            gap: 2px;
            padding-right: 4px;
            margin-right: 4px;
            border-right: 1px solid var(--border-color);
        }
        .btn-reaction-emoji {
            background: transparent;
            border: none;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 3px 4px;
            border-radius: 4px;
            transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-reaction-emoji:hover {
            transform: scale(1.35);
            background: var(--bg-hover);
        }

        /* Message Reactions Badges Row (Below message bubble) */
        .message-reactions-row {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 4px;
        }
        .message-row.my-message .message-reactions-row {
            justify-content: flex-end;
        }
        .message-row.other-message .message-reactions-row {
            justify-content: flex-start;
        }
        .reaction-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 7px;
            border-radius: 12px;
            font-size: 11.5px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }
        .reaction-badge:hover {
            border-color: #00C853;
            transform: translateY(-1px);
        }
        .reaction-badge.active {
            background: rgba(0, 200, 83, 0.15);
            border-color: rgba(0, 200, 83, 0.5);
            color: #00C853;
            font-weight: 600;
        }
        .rx-emoji {
            font-size: 12.5px;
            line-height: 1;
        }
        .rx-count {
            font-weight: 600;
            font-size: 11px;
        }

        /* Reply Quote Box (Inside Message Bubble) */
        .message-reply-quote {
            padding: 6px 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            background: rgba(0, 0, 0, 0.12);
            border-left: 3px solid #00C853;
            cursor: pointer;
            transition: background 0.15s;
            max-width: 100%;
        }
        [data-theme="light"] .message-reply-quote {
            background: rgba(0, 0, 0, 0.05);
        }
        .message-reply-quote:hover {
            background: rgba(0, 0, 0, 0.2);
        }
        .reply-quote-sender {
            font-size: 11px;
            font-weight: 700;
            color: #00C853;
            margin-bottom: 2px;
        }
        .reply-quote-snippet {
            font-size: 12px;
            color: var(--text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 320px;
        }

        /* Floating Reply Preview Bar (Above Input Form) */
        .chat-reply-preview-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 14px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-left: 4px solid #00C853;
            border-radius: 10px;
            margin-bottom: 8px;
            animation: slideDownFade 0.2s ease;
        }
        .reply-preview-left {
            display: flex;
            align-items: center;
            gap: 10px;
            overflow: hidden;
            color: #00C853;
        }
        .reply-preview-text {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            font-size: 12px;
            color: var(--text-primary);
        }
        .reply-snippet-text {
            color: var(--text-secondary);
            font-size: 11.5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 450px;
        }
        .reply-preview-close {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 16px;
            padding: 2px 6px;
            border-radius: 4px;
            transition: color 0.15s;
        }
        .reply-preview-close:hover {
            color: #ef4444;
        }

        /* Image Lightbox Modal */
        .image-lightbox-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 99999;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
            box-sizing: border-box;
            animation: fadeIn 0.2s ease;
        }
        .lightbox-toolbar {
            position: absolute;
            top: 20px;
            right: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 100000;
        }
        .lightbox-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }
        .lightbox-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.04);
        }
        .lightbox-close-btn {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            color: #ef4444;
            width: 36px;
            height: 36px;
            padding: 0;
            justify-content: center;
            font-size: 18px;
        }
        .lightbox-close-btn:hover {
            background: #ef4444;
            color: #fff;
        }
        .lightbox-img-wrapper {
            max-width: 90vw;
            max-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .lightbox-full-img {
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            transition: transform 0.2s ease;
        }

        /* Member Management in Chat Header */
        .btn-manage-members {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-left: 10px;
            vertical-align: middle;
            transition: all 0.15s;
        }
        .btn-manage-members:hover {
            border-color: #00C853;
            color: #00C853;
            transform: translateY(-1px);
        }

        /* Member Management Modal Layout */
        .members-modal-tabs {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 16px;
            gap: 8px;
        }
        .members-tab-btn {
            background: transparent;
            border: none;
            padding: 8px 14px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.15s;
        }
        .members-tab-btn.active {
            color: #00C853;
            border-bottom-color: #00C853;
        }
        .member-list-scroll {
            max-height: 280px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding-right: 4px;
        }
        .member-item-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            transition: all 0.15s;
        }
        .member-item-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .member-item-info {
            display: flex;
            flex-direction: column;
        }
        .member-item-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
        }
        .member-item-pos {
            font-size: 11px;
            color: var(--text-secondary);
        }
        .member-role-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 12px;
            text-transform: uppercase;
        }
        .member-role-badge.admin {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .member-role-badge.member {
            background: rgba(0, 200, 83, 0.12);
            color: #00C853;
            border: 1px solid rgba(0, 200, 83, 0.25);
        }
        .btn-kick-member {
            background: transparent;
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #ef4444;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11.5px;
            cursor: pointer;
            transition: all 0.15s;
        }
        .btn-kick-member:hover {
            background: #ef4444;
            color: #fff;
        }

        /* Add Member Checkbox Row */
        .add-member-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.15s;
        }
        .add-member-item:hover {
            border-color: #00C853;
            background: var(--bg-card);
        }

        /* Highlight flash when jumping to a referenced message */
        @keyframes flashMessage {
            0% { background: rgba(0, 200, 83, 0.3); }
            100% { background: transparent; }
        }
        .flash-target {
            animation: flashMessage 1.5s ease-out;
            border-radius: 12px;
        }

        /* Direct Messages Sidebar items */
        .dm-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.18s ease;
            text-decoration: none;
            color: var(--text-primary);
        }
        .dm-item:hover {
            background: rgba(255,255,255,0.05);
        }
        .dm-item.active {
            background: rgba(56, 189, 248, 0.1);
        }
        .dm-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .dm-avatar-fallback {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(30, 30, 35, 0.9);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 2px solid rgba(255,255,255,0.12);
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            letter-spacing: 0;
        }
        .dm-info {
            display: flex;
            flex-direction: column;
            min-width: 0;
            flex: 1;
            gap: 3px;
        }
        .dm-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text-primary);
            line-height: 1.2;
        }
        .dm-item.active .dm-name {
            color: #38bdf8;
        }
        .dm-role-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1;
            padding: 2px 7px;
            border-radius: 20px;
            border: 1px solid currentColor;
            opacity: 0.85;
            max-width: 100%;
        }

        /* Collapsible Section & Sleek Scrollbar */
        .collapsible-list {
            max-height: 240px;
            overflow-y: auto;
            transition: max-height 0.25s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.2s ease;
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding-right: 2px;
        }

        .collapsible-list.collapsed {
            display: none !important;
            max-height: 0 !important;
            height: 0 !important;
            min-height: 0 !important;
            overflow: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding: 0 !important;
            visibility: hidden !important;
        }

        .collapse-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            color: var(--text-muted);
            transition: transform 0.2s ease;
            width: 14px;
            height: 14px;
            user-select: none;
            flex-shrink: 0;
        }

        .collapse-arrow.rotated {
            transform: rotate(-90deg);
        }

        .section-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 4px 6px;
            border-radius: 6px;
            margin-bottom: 4px;
            transition: background 0.15s ease;
        }

        .section-header-row:hover {
            background: var(--bg-surface-hover);
        }

        .btn-section-add {
            background: transparent;
            border: none;
            color: #00C853;
            cursor: pointer;
            font-size: 12.5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            transition: all 0.15s ease;
            font-family: inherit;
        }

        .btn-section-add:hover {
            background: rgba(0, 200, 83, 0.12);
            transform: translateY(-1px);
        }

        /* Custom Sleek Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(148, 163, 184, 0.25);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(148, 163, 184, 0.45);
        }

        /* Sidebar Search Box */
        .sidebar-search-box {
            position: relative;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }
        .sidebar-search-input {
            width: 100%;
            height: 34px;
            padding: 0 28px 0 30px;
            font-size: 12.5px;
            border-radius: 8px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-family: inherit;
            outline: none;
            transition: all 0.18s ease;
        }
        .sidebar-search-input:focus {
            border-color: #00C853;
            box-shadow: 0 0 0 2px rgba(0, 200, 83, 0.15);
            background: var(--bg-card);
        }
        .sidebar-search-icon {
            position: absolute;
            left: 9px;
            color: var(--text-muted);
            pointer-events: none;
        }
        .sidebar-search-clear {
            position: absolute;
            right: 6px;
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
        .sidebar-search-clear:hover {
            color: var(--text-primary);
        }

        /* DM Row with Close (✕) */
        .dm-row-wrap {
            display: flex;
            align-items: center;
            position: relative;
            border-radius: 10px;
            margin-bottom: 2px;
            transition: all 0.15s ease;
        }
        .dm-row-wrap .dm-item {
            flex: 1;
            min-width: 0;
        }
        .dm-row-wrap.active {
            background: rgba(56, 189, 248, 0.12);
            border: 1px solid rgba(56, 189, 248, 0.25);
        }
        .dm-close-btn {
            opacity: 0;
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 11px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s ease;
            margin-right: 6px;
            flex-shrink: 0;
        }
        .dm-row-wrap:hover .dm-close-btn {
            opacity: 0.6;
        }
        .dm-close-btn:hover {
            opacity: 1 !important;
            color: #ef4444;
            background: rgba(239, 68, 68, 0.12);
        }

        /* Sidebar Empty Hint */
        .sidebar-empty-hint {
            padding: 10px;
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
            background: var(--bg-surface);
            border-radius: 8px;
            border: 1px dashed var(--border-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .sidebar-empty-hint:hover {
            border-color: #00C853;
            color: #00C853;
        }
        .btn-hint-add {
            font-weight: 600;
            font-size: 11.5px;
            color: #00C853;
        }

        .dm-select-card:hover {
            border-color: #00C853 !important;
            background: var(--bg-surface-hover) !important;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="app">

    <!-- Unified Top Header (Full Width - YouTube Style) -->
    <header class="top-header">

        <!-- Left: Logo & Mobile Toggle -->
        <div class="header-brand">
            <button type="button" id="sidebarToggle" class="mobile-toggle-btn" aria-label="เปิดเมนู">
                ☰
            </button>
            <div class="logo-icon">
                <img src="{{ asset('logo.png') }}" alt="CompanyChat" class="app-logo-img">
            </div>
            <div class="logo-text">CompanyChat</div>
        </div>

        <!-- Center: Room Title / Active View Title -->
        <div class="header-center">
            <!-- Chat Room Title -->
            <div id="titleChat" class="room-title-area" style="{{ $currentView === 'chat' ? 'display:flex;' : 'display:none;' }}">
                @if(isset($selectedRoomModel) && $selectedRoomModel->is_direct)
                    @php
                        $dmOther = $selectedRoomModel->getOtherUser(auth()->id());
                        $dmOtherName = $dmOther?->name ?? 'แชตส่วนตัว';
                        $dmOtherPos = $dmOther?->position ?? 'พนักงาน';
                        $dmOtherColor = $dmOther?->position_color ?? '#38bdf8';
                    @endphp
                    <h2>
                        <span id="chatRoomHeaderTitle">แชตส่วนตัว: {{ $dmOtherName }}</span>
                        <span class="role-pill" id="chatRoomHeaderRole" style="font-size: 10.5px; margin-left: 6px; padding: 1px 7px; vertical-align: middle; color: {{ $dmOtherColor }};">{{ $dmOtherPos }}</span>
                    </h2>
                    <div style="font-size: 12px; color: var(--text-secondary); display: flex; align-items: center; gap: 6px;">
                        <span>แชตส่วนตัว</span>
                    </div>
                @else
                    @php
                        $curRoom = $rooms->firstWhere('id', $selectedRoom);
                        $curRoomMemberCount = $curRoom ? $curRoom->members()->count() : 0;
                        // ห้องสาธารณะ: นับทุก users ในระบบ
                        if ($curRoom && !$curRoom->is_private) {
                            $curRoomMemberCount = \App\Models\User::count();
                        }
                    @endphp
                    <h2>
                        <span id="chatRoomHeaderTitle">{{ $curRoom?->name ?? 'ไม่มีห้อง' }}</span>
                        @if($curRoom && $curRoom->is_private)
                            <span class="role-pill" style="font-size: 10px; margin-left: 6px; padding: 2px 7px; color: #f59e0b; border-color: rgba(245, 158, 11, 0.3); background: rgba(245, 158, 11, 0.12);">เฉพาะกลุ่ม</span>
                        @endif
                        @if($curRoom)
                            <button type="button" class="btn-manage-members" onclick="openRoomMembersModal({{ $curRoom->id }})" title="จัดการสมาชิกในห้อง">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span id="headerMembersCountText">{{ $curRoomMemberCount }} สมาชิก</span>
                            </button>
                        @endif
                    </h2>
                    <div style="font-size: 12px; color: var(--text-secondary); display: flex; align-items: center; gap: 6px;">
                        <span>{{ $curRoom?->description ? $curRoom->description : ($curRoom && $curRoom->is_private ? 'ห้องแชตเฉพาะกลุ่ม' : 'ห้องแชตสาธารณะ') }}</span>
                    </div>
                @endif
                {{-- socketStatus hidden สำหรับ JS --}}
                <span id="socketStatus" style="display:none;"></span>
            </div>

            <!-- My Tasks Title -->
            <div id="titleMyTasks" class="room-title-area" style="{{ $currentView === 'my-tasks' ? 'display:flex;' : 'display:none;' }}">
                <h2>
                    <span>งานของฉัน</span>
                </h2>
                <div style="font-size: 12px; color: var(--text-secondary); display: flex; align-items: center; gap: 6px;">
                    <span>งานที่ได้รับมอบหมาย</span>
                    <span class="nav-badge badge-blue" style="font-size: 10.5px;">{{ $myTasksCount }} รายการ</span>
                </div>
            </div>

            <!-- All Tasks Title -->
            <div id="titleAllTasks" class="room-title-area" style="{{ $currentView === 'all-tasks' ? 'display:flex;' : 'display:none;' }}">
                <h2>
                    <span>จัดการงานทั้งหมด</span>
                </h2>
                <div style="font-size: 12px; color: var(--text-secondary); display: flex; align-items: center; gap: 6px;">
                    <span>งานทั้งหมดในระบบ</span>
                    <span class="nav-badge" id="headerAllTasksCountBadge" style="background: var(--bg-surface); color: var(--text-secondary); font-size: 10.5px;">{{ $allTasks->count() }} รายการ</span>
                </div>
            </div>

            <!-- News & Announcements Title -->
            <div id="titleNews" class="room-title-area" style="{{ $currentView === 'news' ? 'display:flex;' : 'display:none;' }}">
                <h2>
                    <span>ข่าวสารและประกาศ</span>
                </h2>
                <div style="font-size: 12px; color: var(--text-secondary); display: flex; align-items: center; gap: 6px;">
                    <span>ข่าวสารองค์กร</span>
                    <span class="nav-badge" id="headerNewsCountBadge" style="background: rgba(0, 200, 83, 0.15); color: #00C853; border: 1px solid rgba(0, 200, 83, 0.3); font-size: 10.5px;">{{ $newsCount }} รายการ</span>
                </div>
            </div>
        </div>

        <!-- Right: Header Actions (Notification Bell & Theme Toggle) -->
        <div class="header-right">
            <!-- Notification Bell -->
            <div style="position: relative;" id="notificationContainer">
                <button type="button"
                        id="notificationBellBtn"
                        class="bell-btn"
                        title="แจ้งเตือนงานสำคัญ"
                        aria-label="แจ้งเตือนงานสำคัญ"
                        onclick="toggleNotificationDropdown(event)">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <span class="bell-badge" id="headerBellBadge" style="{{ (isset($notifications) && $notifications > 0) ? '' : 'display:none;' }}">{{ ($notifications ?? 0) > 9 ? '9+' : ($notifications ?? 0) }}</span>
                </button>

                <!-- Notification Dropdown Menu -->
                <div id="notificationDropdown" class="notification-dropdown">
                    <div class="notification-header">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 700; font-size: 14px; color: var(--text-primary);">แจ้งเตือนงานสำคัญ</span>
                        </div>
                    <span class="nav-badge badge-amber" id="notificationDropdownCount" style="{{ (isset($notifications) && $notifications > 0) ? '' : 'display:none;' }}">{{ $notifications ?? 0 }} งาน</span>
                </div>

                <div class="notification-body" id="notificationDropdownBody">
                    @forelse($urgentTasks as $task)
                        <div class="notification-item" onclick="openTaskFromNotification('{{ $task->id }}')">
                            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px; margin-bottom: 4px;">
                                <span class="notification-item-title">{{ $task->title }}</span>
                                @php
                                    $pClass = match($task->priority) {
                                        'ด่วน' => 'badge-red',
                                        'สูง' => 'badge-amber',
                                        default => 'badge-blue',
                                    };
                                @endphp
                                <span class="nav-badge {{ $pClass }}" style="font-size: 10px; flex-shrink: 0;">{{ $task->priority }}</span>
                            </div>
                            <div class="notification-item-meta">
                                <span>{{ $task->assignee?->name ?? 'ยังไม่ระบุ' }}</span>
                                @if($task->due_at)
                                    <span>•</span>
                                    @if($task->due_at->isPast())
                                        <span style="color: #ef4444; font-weight: 600;">เกินกำหนด</span>
                                    @else
                                        <span style="color: #f59e0b; font-weight: 500;">{{ $task->due_at->diffForHumans() }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="notification-empty">
                            <div style="font-size: 13.5px; font-weight: 600; color: var(--text-primary);">ไม่มีงานสำคัญเร่งด่วนในขณะนี้</div>
                            <div style="font-size: 12px; color: var(--text-muted); margin-top: 3px;">คุณและทีมงานจัดการภารกิจได้อย่างยอดเยี่ยม!</div>
                        </div>
                    @endforelse
                </div>

                <div class="notification-footer">
                    <a href="{{ url('/dashboard?view=my-tasks') }}" onclick="switchDashboardView('my-tasks', event); closeNotificationDropdown();" class="notification-view-all">
                        ดูงานของฉันทั้งหมด →
                    </a>
                </div>
            </div>
        </div>

            <!-- Theme Toggle Button (Login/Register Style) -->
            <button type="button" 
                    class="theme-toggle-btn" 
                    id="themeToggleBtn" 
                    onclick="toggleTheme()" 
                    aria-label="สลับธีม" 
                    title="สลับโหมดมืด/สว่าง">
                <span id="themeIcon">☀️</span>
            </button>
        </div>

    </header>

    <!-- App Body (Underneath Unified Header) -->
    <div class="app-body">

        <!-- Sidebar -->
        <aside class="sidebar">

            <!-- Mobile Drawer Header (Only visible on mobile) -->
            <div class="sidebar-mobile-header">
                <div style="display: flex; align-items: center; gap: 9px;">
                    <img src="{{ asset('logo.png') }}" alt="CompanyChat" style="width: 28px; height: 28px; object-fit: contain; border-radius: 7px;">
                    <span style="font-weight: 700; font-size: 16px; color: var(--text-primary); letter-spacing: -0.3px;">CompanyChat</span>
                </div>
                <button type="button" id="sidebarCloseBtn" class="sidebar-close-btn" aria-label="ปิดเมนู">✕</button>
            </div>

            <div class="sidebar-scroll">

            <!-- News & Announcements Navigation -->
            <div style="margin-bottom: 14px;">
                <div class="nav-section-title">ข่าวสารและประกาศ</div>
                <a href="{{ url('/dashboard?view=news') }}"
                   id="navBtnNews"
                   class="nav-button {{ $currentView === 'news' ? 'active' : '' }}"
                   onclick="switchDashboardView('news', event)">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        ข่าวสารองค์กร
                    </span>
                    <span class="nav-badge" id="sidebarNewsCountBadge" style="background: rgba(0, 200, 83, 0.15); color: #00C853; border: 1px solid rgba(0, 200, 83, 0.3); {{ (isset($newsCount) && $newsCount > 0) ? '' : 'display:none;' }}">{{ $newsCount ?? 0 }}</span>
                </a>
            </div>

            <!-- Tasks Navigation -->
            <div id="navTasksSection">
                <div class="nav-section-title">งานและภารกิจ</div>

                <!-- งานของฉัน (My Tasks) -->
                <a href="{{ url('/dashboard?view=my-tasks') }}"
                   id="navBtnMyTasks"
                   class="nav-button {{ $currentView === 'my-tasks' ? 'active' : '' }}"
                   onclick="switchDashboardView('my-tasks', event)">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        งานของฉัน
                    </span>
                    <span class="nav-badge badge-blue" id="sidebarMyTasksBadge" style="{{ (isset($myTasksCount) && $myTasksCount > 0) ? '' : 'display:none;' }}">{{ $myTasksCount ?? 0 }}</span>
                </a>

                <!-- งานทั้งหมด (All Tasks) -->
                <a href="{{ url('/dashboard?view=all-tasks') }}"
                   id="navBtnAllTasks"
                   class="nav-button {{ $currentView === 'all-tasks' ? 'active' : '' }}"
                   onclick="switchDashboardView('all-tasks', event)">
                    <span style="display: flex; align-items: center; gap: 8px;">
                        จัดการงานทั้งหมด
                    </span>
                    <span class="nav-badge" id="sidebarAllTasksCountBadge" style="background: rgba(255,255,255,0.1); color: #94a3b8;">{{ $allTasks->count() }}</span>
                </a>

                <div id="sidebarUrgentNavWrap" style="{{ (isset($notifications) && $notifications > 0) ? '' : 'display:none;' }}">
                    <a href="{{ url('/dashboard?view=my-tasks') }}"
                       id="navBtnUrgentTasks"
                       class="nav-button"
                       onclick="switchDashboardView('my-tasks', event)"
                       style="background: rgba(245, 158, 11, 0.15); border-color: rgba(245, 158, 11, 0.35);">
                        <span style="color: #fbbf24; font-size: 13px;">
                            ⏰ ใกล้ครบกำหนด
                        </span>
                        <span class="nav-badge badge-amber" id="sidebarUrgentCountBadge">{{ $notifications ?? 0 }}</span>
                    </a>
                </div>
            </div>

            <!-- Sidebar Quick Search (ค้นหาห้องและเพื่อนร่วมงาน) -->
            <div class="sidebar-search-box">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="sidebar-search-icon"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text"
                       id="sidebarFilterInput"
                       class="sidebar-search-input"
                       placeholder="ค้นหาห้องหรือเพื่อนร่วมงาน..."
                       oninput="filterSidebarLists(this.value)">
                <button type="button" 
                        id="sidebarFilterClearBtn" 
                        class="sidebar-search-clear" 
                        onclick="clearSidebarFilter()" 
                        style="display: none;" 
                        title="ล้างคำค้นหา">✕</button>
            </div>

            <!-- Chat Rooms Section -->
            <div class="sidebar-section-wrap" style="margin-bottom: 12px;">
                <div class="section-header-row" onclick="toggleSection('rooms')" style="cursor: pointer; user-select: none;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span id="roomsCollapseArrow" class="collapse-arrow">▾</span>
                        <div class="nav-section-title" id="sidebarRoomsCountTitle" style="margin-bottom: 0;">
                            ห้องแชต (<span id="sidebarRoomsCount">{{ $rooms->count() }}</span>)
                        </div>
                    </div>

                    {{-- ปุ่มสร้างห้อง --}}
                    <button type="button"
                            onclick="event.stopPropagation(); document.getElementById('createRoomModal').style.display='flex';"
                            class="btn-section-add"
                            title="เพิ่มห้องแชตใหม่">
                        ＋ สร้าง
                    </button>
                </div>

                <div id="sidebarRoomsList" class="collapsible-list custom-scrollbar">
                    @foreach($rooms as $room)
                        <div class="room-item {{ ($currentView === 'chat' && $selectedRoom == $room->id) ? 'active' : '' }}" 
                             data-room-id="{{ $room->id }}"
                             data-search-text="{{ mb_strtolower($room->name) }}">
                            <a href="{{ url('/dashboard?room=' . $room->id) }}"
                               class="room-link"
                               onclick="handleRoomClick({{ $room->id }}, event)">
                                <span class="room-name-text">{{ $room->name }}@if($room->is_private)<span style="font-size: 10px; color: #f59e0b; margin-left: 5px; vertical-align: middle;">🔒</span>@endif</span>
                            </a>

                            <div class="room-actions">
                                {{-- แก้ไขชื่อห้อง --}}
                                @if(in_array(auth()->user()->position, ['ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin']) || ($room->is_private && $room->isMember(auth()->id())))
                                    <button type="button"
                                            class="room-edit-btn"
                                            title="แก้ไขชื่อห้อง"
                                            onclick="event.stopPropagation(); openEditRoomModal({{ $room->id }}, @js($room->name), @js($room->description ?? ''))">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>
                                @endif

                                {{-- ลบห้อง (ผู้ดูแลระบบ หรือ ผู้สร้างห้องเฉพาะกลุ่ม) --}}
                                @if(auth()->user()->position === 'ผู้ดูแลระบบ' || ($room->is_private && $room->created_by === auth()->id()))
                                    <form method="POST"
                                          action="{{ route('rooms.destroy', $room->id) }}"
                                          onsubmit="return confirm('ต้องการลบห้อง {{ $room->name }} ใช่หรือไม่?')"
                                          style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="room-delete-btn" title="ลบห้องนี้">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path>
                                                <path d="M4 6h16"></path>
                                                <path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path>
                                                <line x1="10" y1="10" x2="10" y2="17"></line>
                                                <line x1="14" y1="10" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Direct Messages Section (แชตส่วนตัว 1-ต่อ-1 เฉพาะคนที่เริ่มคุย) -->
            <div class="sidebar-section-wrap" style="margin-bottom: 14px;">
                <div class="section-header-row" onclick="toggleSection('dm')" style="cursor: pointer; user-select: none;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span id="dmCollapseArrow" class="collapse-arrow">▾</span>
                        <div class="nav-section-title" id="sidebarDmCountTitle" style="margin-bottom: 0;">
                            ข้อความส่วนตัว (<span id="sidebarDmCount">{{ $dmRooms->count() }}</span>)
                        </div>
                    </div>

                    <button type="button"
                            onclick="event.stopPropagation(); openNewDmModal();"
                            class="btn-section-add"
                            title="เริ่มแชตกับเพื่อนร่วมงานใหม่">
                        ＋ เพิ่มแชต
                    </button>
                </div>

                <div id="sidebarDmList" class="collapsible-list custom-scrollbar">
                    @forelse($dmRooms as $dm)
                        @php
                            $u = $dm->getOtherUser(auth()->id());
                        @endphp
                        @if($u)
                            @php
                                $isActiveDm = ($currentView === 'chat' && $selectedRoom == $dm->id);
                                $uFirst = $u->resolved_first_name ?? explode(' ', $u->name)[0];
                            @endphp
                            <div class="dm-row-wrap {{ $isActiveDm ? 'active' : '' }}" 
                                 data-search-text="{{ mb_strtolower($u->name . ' ' . ($u->position ?? '') . ' ' . $uFirst) }}"
                                 data-dm-user-id="{{ $u->id }}"
                                 data-dm-room-id="{{ $dm->id }}">
                                <a href="{{ url('/dashboard?room=' . $dm->id) }}"
                                   class="dm-item {{ $isActiveDm ? 'active' : '' }}"
                                   title="แชตส่วนตัวกับ {{ $u->name }}">
                                    @if($u->avatar)
                                        <img src="{{ $u->avatar }}" class="dm-avatar" alt="{{ $u->name }}">
                                    @else
                                        @php $dmColor = $u->position_color ?? '#00C853'; @endphp
                                        <div class="dm-avatar-fallback" style="color: {{ $dmColor }}; border-color: rgba(255,255,255,0.15);">
                                            {{ strtoupper(mb_substr($uFirst, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="dm-info">
                                        <span class="dm-name">{{ $uFirst }}</span>
                                        <span class="dm-role-tag" style="color: {{ $u->position_color ?? '#00C853' }}; background: {{ $u->position_color ?? '#00C853' }}22; border-color: {{ $u->position_color ?? '#00C853' }}55;">{{ $u->position ?? 'พนักงาน' }}</span>
                                    </div>
                                </a>

                                {{-- ปุ่มปิดแชต (✕) --}}
                                <form method="POST"
                                      action="{{ route('rooms.destroy', $dm->id) }}"
                                      onsubmit="return confirm('ต้องการปิดแชตส่วนตัวกับ {{ $u->name }} ใช่หรือไม่?')"
                                      style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dm-close-btn" title="ปิดแชตนี้">✕</button>
                                </form>
                            </div>
                        @endif
                    @empty
                        <div class="sidebar-empty-hint" onclick="openNewDmModal()">
                            <span>ยังไม่มีแชตส่วนตัว</span>
                            <span class="btn-hint-add">＋ เริ่มคุยกับเพื่อนร่วมงาน</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Admin Area -->
            @if(auth()->user()->position === 'ผู้ดูแลระบบ')
                <div>
                    <div class="nav-section-title">การจัดการระบบ</div>
                    <a href="{{ route('users.index') }}" class="nav-button" style="background: rgba(99, 102, 241, 0.15); border-color: rgba(99, 102, 241, 0.35);">
                        <span>จัดการสิทธิ์ผู้ใช้</span>
                        <span style="font-size: 11px; color: #a5b4fc;">Admin</span>
                    </a>
                    <a href="{{ route('admin.database') }}" class="nav-button" style="background: rgba(16, 185, 129, 0.15); border-color: rgba(16, 185, 129, 0.35);">
                        <span>ดูข้อมูลสด (Database)</span>
                        <span style="font-size: 11px; color: #6ee7b7;">DB</span>
                    </a>
                </div>
            @endif

        </div>

        <!-- Sidebar Footer (Bottom Left): User Profile & Settings -->
        @php
            $roleClass = match(auth()->user()->position) {
                'ผู้ดูแลระบบ', 'แอดมิน', 'Admin' => 'role-admin',
                'ผู้บริหาร', 'ผู้จัดการ', 'Manager', 'Executive' => 'role-manager',
                'หัวหน้างาน', 'Supervisor' => 'role-supervisor',
                default => 'role-staff',
            };
        @endphp
        <div class="sidebar-footer">
            <div class="user-footer-info">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1px solid var(--border-color);" alt="{{ auth()->user()->name }}">
                @else
                    <div class="user-avatar" style="width: 36px; height: 36px; font-size: 14px; border-radius: 50%; flex-shrink: 0;">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="user-footer-meta">
                    <span class="user-footer-name">{{ auth()->user()->name }}</span>
                    <span class="role-pill {{ $roleClass }}" style="font-size: 10px; padding: 1px 6px; width: fit-content;">
                        {{ auth()->user()->position ?? 'พนักงาน' }}
                    </span>
                </div>
            </div>
            <button type="button" class="settings-icon-btn" onclick="openSettingsModal()" title="การตั้งค่าและออกจากระบบ">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            </button>
        </div>

    </aside>

    <!-- Mobile Drawer Backdrop -->
    <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

    <!-- Main Workspace -->
    <main class="main">

        <!-- Views -->

        <!-- 1) VIEW: CHAT ROOM -->
        <div id="viewChat" style="{{ $currentView === 'chat' ? 'display:flex;' : 'display:none;' }} flex-direction: column; flex: 1; min-height: 0;">

            <!-- Chat Container -->
            <div class="chat-container" id="chatContainer">
                @php
                    $myUserId = auth()->id();
                    $myFullName = auth()->user()->name;
                    $myFirstName = auth()->user()->resolved_first_name ?? explode(' ', $myFullName)[0];
                    $isAdmin = auth()->user()->position === 'ผู้ดูแลระบบ';
                @endphp
                @foreach($messages as $message)
                    @php
                        $isMe = $message->user_id === $myUserId;
                        $sender = $message->user;
                        $firstName = $sender?->resolved_first_name ?? 'User';
                        $position = $sender?->position ?? 'พนักงาน';
                        $senderDisplay = "{$firstName} ({$position})";
                        $positionColor = $sender?->position_color ?? '#00C853';
                        $avatarUrl = $sender?->avatar;
                        $initial = strtoupper(mb_substr($firstName, 0, 1));

                        $text = $message->message ?? '';
                        $isMentioned = str_contains($text, '@ทุกคน') || str_contains($text, '@' . $myFirstName) || str_contains($text, '@' . $myFullName);
                    @endphp
                    <div class="message-row {{ $isMe ? 'my-message' : 'other-message' }} {{ $isMentioned ? 'is-mentioned' : '' }}" data-message-id="{{ $message->id }}">
                        
                        {{-- Hover Action Toolbar (Reactions / Reply / Edit / Delete) --}}
                        <div class="message-action-toolbar">
                            {{-- Reaction Emoji Quick Picker --}}
                            <div class="msg-reaction-picker">
                                <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax({{ $message->id }}, '👍')" title="กดถูกใจ">👍</button>
                                <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax({{ $message->id }}, '❤️')" title="หัวใจ">❤️</button>
                                <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax({{ $message->id }}, '😂')" title="หัวเราะ">😂</button>
                                <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax({{ $message->id }}, '🎉')" title="ยินดีด้วย">🎉</button>
                                <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax({{ $message->id }}, '🙏')" title="ขอบคุณ">🙏</button>
                            </div>

                            {{-- Reply Button --}}
                            <button type="button" class="btn-msg-tool" onclick="setReplyMessage({{ $message->id }}, @js($firstName), @js(mb_substr($message->message ?? ($message->image ? 'รูปภาพ' : ($message->file_name ? 'ไฟล์: ' . $message->file_name : 'ข้อความ')), 0, 50)))" title="ตอบกลับข้อความนี้">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 17 4 12 9 7"></polyline><path d="M20 18v-2a4 4 0 0 0-4-4H4"></path></svg>
                                <span>ตอบกลับ</span>
                            </button>

                            @if($isMe)
                                <button type="button" class="btn-msg-tool" onclick="startEditMessage({{ $message->id }}, this)" title="แก้ไขข้อความ">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    <span>แก้ไข</span>
                                </button>
                            @endif

                            @if($isMe || $isAdmin)
                                <button type="button" class="btn-msg-tool danger" onclick="deleteMessageAjax({{ $message->id }})" title="ลบข้อความ">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path><path d="M4 6h16"></path><path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path><line x1="10" y1="10" x2="10" y2="17"></line><line x1="14" y1="10" x2="14" y2="17"></line></svg>
                                    <span>ลบ</span>
                                </button>
                            @endif
                        </div>

                        @if($isMe)
                            <div class="message-content-wrap">
                                <div class="message-header-line">
                                    <span class="message-time">{{ $message->created_at ? $message->created_at->format('H:i') : '' }}</span>
                                    <span class="message-sender-name" style="color: {{ $positionColor }} !important;">{{ $senderDisplay }}</span>
                                </div>
                                <div class="message-bubble">
                                    @if($message->replyTo)
                                        <div class="message-reply-quote" onclick="scrollToMessage({{ $message->replyTo->id }})">
                                            <div class="reply-quote-sender">↩ {{ $message->replyTo->user?->resolved_first_name ?? 'User' }}</div>
                                            <div class="reply-quote-snippet">{{ mb_substr($message->replyTo->message ?? ($message->replyTo->image ? '📷 รูปภาพ' : ($message->replyTo->file_name ? '📎 ไฟล์เอกสาร' : 'เสียงข้อความ')), 0, 80) }}</div>
                                        </div>
                                    @endif

                                    @if($message->image)
                                        <div class="message-image-wrap">
                                            <img src="{{ $message->image }}" class="message-chat-image" onclick="openChatImage(this.src)" alt="รูปภาพแชต">
                                        </div>
                                    @endif
                                    @if($message->audio)
                                        <div class="message-audio-wrap">
                                            <audio controls class="message-audio-player" preload="metadata" src="{{ $message->audio }}">
                                                เบราว์เซอร์ของคุณไม่รองรับการเล่นเสียง
                                            </audio>
                                        </div>
                                    @endif
                                    @if(!empty($message->file_data))
                                        @php
                                            $fExt = strtolower(pathinfo($message->file_name ?? '', PATHINFO_EXTENSION));
                                            $fIcon = match(true) {
                                                $fExt === 'pdf' => '📄',
                                                in_array($fExt, ['xls', 'xlsx', 'csv']) => '📊',
                                                in_array($fExt, ['doc', 'docx', 'txt']) => '📝',
                                                in_array($fExt, ['zip', 'rar', '7z', 'tar', 'gz']) => '🗜️',
                                                in_array($fExt, ['ppt', 'pptx']) => '📑',
                                                default => '📁',
                                            };
                                        @endphp
                                        <div class="chat-file-card">
                                            <div class="chat-file-icon">{{ $fIcon }}</div>
                                            <div class="chat-file-info">
                                                <span class="chat-file-name" title="{{ $message->file_name }}">{{ $message->file_name }}</span>
                                                <span class="chat-file-size">{{ $message->formatted_file_size ?? 'เอกสาร' }}</span>
                                            </div>
                                            <a href="{{ $message->file_data }}" download="{{ $message->file_name }}" class="chat-file-download-btn">
                                                <span>📥 ดาวน์โหลด</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if(!empty($message->message))
                                        @php
                                            $msgRaw = $message->message;
                                            $hasNewsLink = preg_match('/view=news#newsCard(\d+)/i', $msgRaw, $matches);
                                            $newsId = $hasNewsLink ? $matches[1] : null;
                                            $escaped = e($msgRaw);
                                            $escaped = preg_replace('/@ทุกคน/', '<span class="mention-badge mention-all">@ทุกคน</span>', $escaped);
                                            $escaped = preg_replace('/@([^\s<]+)/', '<span class="mention-badge">@$1</span>', $escaped);
                                            $linked = preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" rel="noopener noreferrer" class="chat-link">$1</a>', $escaped);
                                        @endphp
                                        <div class="message-text" id="msgText{{ $message->id }}">
                                            {!! $linked !!}
                                            @if($message->is_edited)
                                                <span class="message-edited-badge">(แก้ไขแล้ว)</span>
                                            @endif
                                            @if($newsId)
                                                <div class="chat-news-card" onclick="window.switchDashboardView('news'); setTimeout(() => { const c = document.getElementById('newsCard{{ $newsId }}'); if (c) c.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);">
                                                    <div style="font-weight: 700; font-size: 13px; color: #00C853; display: flex; align-items: center; gap: 6px;">
                                                        <span>📰</span> <span>ประกาศข่าวสารองค์กร</span>
                                                    </div>
                                                    <div style="font-size: 12px; color: var(--text-secondary); margin-top: 3px;">
                                                        คลิกที่นี่เพื่อเปิดดูข่าวสารนี้ใน CompanyChat ➔
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                {{-- Reactions Badges Row --}}
                                @php
                                    $groupedRx = $message->getGroupedReactions($myUserId);
                                @endphp
                                <div class="message-reactions-row" id="reactionsRow{{ $message->id }}">
                                    @foreach($groupedRx as $rx)
                                        <button type="button" class="reaction-badge {{ $rx['has_me'] ? 'active' : '' }}" onclick="toggleReactionAjax({{ $message->id }}, '{{ $rx['emoji'] }}')" title="{{ implode(', ', $rx['users']) }}">
                                            <span class="rx-emoji">{{ $rx['emoji'] }}</span>
                                            <span class="rx-count">{{ $rx['count'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="message-avatar-wrap">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" class="chat-avatar-img" alt="{{ $senderDisplay }}">
                                @else
                                    <div class="chat-avatar-fallback">{{ $initial }}</div>
                                @endif
                            </div>
                        @else
                            <div class="message-avatar-wrap">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" class="chat-avatar-img" alt="{{ $senderDisplay }}">
                                @else
                                    <div class="chat-avatar-fallback">{{ $initial }}</div>
                                @endif
                            </div>
                            <div class="message-content-wrap">
                                <div class="message-header-line">
                                    <span class="message-sender-name" style="color: {{ $positionColor }} !important;">{{ $senderDisplay }}</span>
                                    <span class="message-time">{{ $message->created_at ? $message->created_at->format('H:i') : '' }}</span>
                                </div>
                                <div class="message-bubble">
                                    @if($message->replyTo)
                                        <div class="message-reply-quote" onclick="scrollToMessage({{ $message->replyTo->id }})">
                                            <div class="reply-quote-sender">↩ {{ $message->replyTo->user?->resolved_first_name ?? 'User' }}</div>
                                            <div class="reply-quote-snippet">{{ mb_substr($message->replyTo->message ?? ($message->replyTo->image ? '📷 รูปภาพ' : ($message->replyTo->file_name ? '📎 ไฟล์เอกสาร' : 'เสียงข้อความ')), 0, 80) }}</div>
                                        </div>
                                    @endif

                                    @if($message->image)
                                        <div class="message-image-wrap">
                                            <img src="{{ $message->image }}" class="message-chat-image" onclick="openChatImage(this.src)" alt="รูปภาพแชต">
                                        </div>
                                    @endif
                                    @if($message->audio)
                                        <div class="message-audio-wrap">
                                            <audio controls class="message-audio-player" preload="metadata" src="{{ $message->audio }}">
                                                เบราว์เซอร์ของคุณไม่รองรับการเล่นเสียง
                                            </audio>
                                        </div>
                                    @endif
                                    @if(!empty($message->file_data))
                                        @php
                                            $fExt = strtolower(pathinfo($message->file_name ?? '', PATHINFO_EXTENSION));
                                            $fIcon = match(true) {
                                                $fExt === 'pdf' => '📄',
                                                in_array($fExt, ['xls', 'xlsx', 'csv']) => '📊',
                                                in_array($fExt, ['doc', 'docx', 'txt']) => '📝',
                                                in_array($fExt, ['zip', 'rar', '7z', 'tar', 'gz']) => '🗜️',
                                                in_array($fExt, ['ppt', 'pptx']) => '📑',
                                                default => '📁',
                                            };
                                        @endphp
                                        <div class="chat-file-card">
                                            <div class="chat-file-icon">{{ $fIcon }}</div>
                                            <div class="chat-file-info">
                                                <span class="chat-file-name" title="{{ $message->file_name }}">{{ $message->file_name }}</span>
                                                <span class="chat-file-size">{{ $message->formatted_file_size ?? 'เอกสาร' }}</span>
                                            </div>
                                            <a href="{{ $message->file_data }}" download="{{ $message->file_name }}" class="chat-file-download-btn">
                                                <span>📥 ดาวน์โหลด</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if(!empty($message->message))
                                        @php
                                            $msgRaw = $message->message;
                                            $hasNewsLink = preg_match('/view=news#newsCard(\d+)/i', $msgRaw, $matches);
                                            $newsId = $hasNewsLink ? $matches[1] : null;
                                            $escaped = e($msgRaw);
                                            $escaped = preg_replace('/@ทุกคน/', '<span class="mention-badge mention-all">@ทุกคน</span>', $escaped);
                                            $escaped = preg_replace('/@([^\s<]+)/', '<span class="mention-badge">@$1</span>', $escaped);
                                            $linked = preg_replace('/(https?:\/\/[^\s]+)/', '<a href="$1" target="_blank" rel="noopener noreferrer" class="chat-link">$1</a>', $escaped);
                                        @endphp
                                        <div class="message-text" id="msgText{{ $message->id }}">
                                            {!! $linked !!}
                                            @if($message->is_edited)
                                                <span class="message-edited-badge">(แก้ไขแล้ว)</span>
                                            @endif
                                            @if($newsId)
                                                <div class="chat-news-card" onclick="window.switchDashboardView('news'); setTimeout(() => { const c = document.getElementById('newsCard{{ $newsId }}'); if (c) c.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);">
                                                    <div style="font-weight: 700; font-size: 13px; color: #00C853; display: flex; align-items: center; gap: 6px;">
                                                        <span>📰</span> <span>ประกาศข่าวสารองค์กร</span>
                                                    </div>
                                                    <div style="font-size: 12px; color: var(--text-secondary); margin-top: 3px;">
                                                        คลิกที่นี่เพื่อเปิดดูข่าวสารนี้ใน CompanyChat ➔
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                {{-- Reactions Badges Row --}}
                                @php
                                    $groupedRx = $message->getGroupedReactions($myUserId);
                                @endphp
                                <div class="message-reactions-row" id="reactionsRow{{ $message->id }}">
                                    @foreach($groupedRx as $rx)
                                        <button type="button" class="reaction-badge {{ $rx['has_me'] ? 'active' : '' }}" onclick="toggleReactionAjax({{ $message->id }}, '{{ $rx['emoji'] }}')" title="{{ implode(', ', $rx['users']) }}">
                                            <span class="rx-emoji">{{ $rx['emoji'] }}</span>
                                            <span class="rx-count">{{ $rx['count'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Input Bar -->
            <div class="input-bar" style="position: relative;">

                <!-- Mention Autocomplete Popup -->
                <div id="mentionAutocomplete" class="mention-autocomplete-dropdown"></div>

                <!-- Attached Media Preview Bar (Floating above input) -->
                <!-- Reply Preview Bar (Floating above input) -->
                <div id="chatReplyPreview" class="chat-reply-preview-bar" style="display: none;">
                    <div class="chat-reply-preview-indicator"></div>
                    <div class="chat-reply-preview-content">
                        <div class="chat-reply-preview-header">
                            <span class="chat-reply-preview-title">ตอบกลับ</span>
                            <span id="replyPreviewSender" class="chat-reply-preview-sender">คุณ</span>
                        </div>
                        <div id="replyPreviewText" class="chat-reply-preview-snippet">ข้อความที่ตอบกลับ...</div>
                    </div>
                    <button type="button" class="chat-reply-preview-close" onclick="cancelReplyMessage()" title="ยกเลิกการตอบกลับ">✕</button>
                </div>

                <div id="chatMediaPreview" class="chat-media-preview-bar">
                    <!-- Image Preview Item -->
                    <div id="imagePreviewItem" class="media-preview-card" style="display: none;">
                        <img id="imagePreviewThumb" src="" alt="ตัวอย่างรูปภาพ" class="media-preview-thumb">
                        <div class="media-preview-meta">
                            <span class="media-preview-title">รูปภาพที่แนบ</span>
                            <span class="media-preview-subtitle">พร้อมส่ง</span>
                        </div>
                        <button type="button" class="media-preview-close" onclick="removeAttachedImage()" aria-label="ลบรูปภาพ" title="ลบรูปภาพ">✕</button>
                    </div>

                    <!-- Document Preview Item -->
                    <div id="documentPreviewItem" class="media-preview-card" style="display: none;">
                        <div id="docPreviewIcon" style="font-size: 24px; margin-right: 6px;">📄</div>
                        <div class="media-preview-meta">
                            <span id="docPreviewName" class="media-preview-title" style="max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">เอกสาร</span>
                            <span id="docPreviewSubtitle" class="media-preview-subtitle">พร้อมส่ง</span>
                        </div>
                        <button type="button" class="media-preview-close" onclick="removeAttachedDocument()" aria-label="ลบไฟล์" title="ลบไฟล์">✕</button>
                    </div>

                    <!-- Voice Recording / Recorded Item -->
                    <div id="voicePreviewItem" class="media-preview-card" style="display: none;">
                        <!-- While Recording -->
                        <div id="voiceRecordingStatus" class="voice-recording-box" style="display: none;">
                            <div class="voice-live-dot"></div>
                            <span class="voice-status-label">กำลังบันทึกเสียง...</span>
                            <span id="recordingTimerText" class="voice-timer">00:00</span>
                            <button type="button" class="btn-voice-stop" id="stopRecordBtn" onclick="stopVoiceRecording()" title="เสร็จสิ้นการบันทึก">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><rect x="4" y="4" width="16" height="16" rx="2"/></svg>
                                <span>หยุด</span>
                            </button>
                        </div>
                        <!-- After Recorded (Playback) -->
                        <div id="voicePlaybackWrap" class="voice-playback-box" style="display: none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-secondary);flex-shrink:0;">
                                <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            </svg>
                            <audio id="voicePreviewAudio" controls class="media-preview-audio"></audio>
                            <button type="button" class="media-preview-close" onclick="removeAttachedVoice()" aria-label="ลบเสียง" title="ลบเสียง">✕</button>
                        </div>
                    </div>
                </div>

                <form id="chatForm" method="POST" action="/messages" class="input-form">
                    @csrf
                    <input type="hidden" id="roomIdInput" name="room_id" value="{{ $selectedRoom }}">
                    <input type="hidden" id="replyToIdInput" name="reply_to_id" value="">
                    
                    <!-- Hidden File Inputs -->
                    <input type="file" id="chatFileInput" accept="image/*" style="display:none;" onchange="handleChatImageSelect(event)">
                    <input type="file" id="chatDocumentInput" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar,.7z,.csv" style="display:none;" onchange="handleChatDocumentSelect(event)">
                    
                    <input type="hidden" id="chatImageData" name="image" value="">
                    <input type="hidden" id="chatAudioData" name="audio" value="">
                    <input type="hidden" id="chatAudioDuration" name="audio_duration" value="">
                    <input type="hidden" id="chatFileData" name="file_data" value="">
                    <input type="hidden" id="chatFileName" name="file_name" value="">
                    <input type="hidden" id="chatFileSize" name="file_size" value="">
                    <input type="hidden" id="chatFileType" name="file_type" value="">

                    <!-- Attach Document Button (📎) -->
                    <button type="button" class="chat-tool-btn" id="attachDocumentBtn" title="แนบไฟล์เอกสาร (PDF, Word, Excel, ZIP)" onclick="document.getElementById('chatDocumentInput').click()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                        </svg>
                    </button>

                    <!-- Attach Image Button (🖼️) -->
                    <button type="button" class="chat-tool-btn" id="attachImageBtn" title="แนบรูปภาพ" onclick="document.getElementById('chatFileInput').click()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                    </button>

                    <!-- Record Voice Button (🎙️) -->
                    <button type="button" class="chat-tool-btn" id="recordVoiceBtn" title="บันทึกเสียง" onclick="toggleVoiceRecording()">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"/>
                            <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
                            <line x1="12" x2="12" y1="19" y2="22"/>
                        </svg>
                    </button>

                    <input
                        type="text"
                        id="messageInput"
                        name="message"
                        class="chat-input"
                        placeholder="พิมพ์ข้อความ... หรือพิมพ์ @ เพื่อแท็กเพื่อนร่วมงาน (Enter เพื่อส่ง)"
                        autocomplete="off"
                    >

                    <button class="send-button" id="sendBtn" type="submit">
                        <span>ส่ง</span>
                        <span>➔</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- 2) VIEW: MY TASKS (งานของฉัน) -->
        <div id="viewMyTasks" class="task-workspace" style="{{ $currentView === 'my-tasks' ? 'display:flex;' : 'display:none;' }}">
            <div class="task-content-inner">
                @forelse($myTasks as $task)
                    <div class="task-card" data-my-task-id="{{ $task->id }}">
                        <div class="task-top">
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
                                {{ $task->priority }}
                            </span>
                        </div>

                        @if($task->description)
                            <div class="task-desc">{{ $task->description }}</div>
                        @endif

                        <div class="badges-row">
                            <span class="badge status-badge">
                                {{ $task->status }}
                            </span>

                            @if($task->due_at)
                                @php
                                    $diffMin = now()->diffInMinutes($task->due_at, false);
                                @endphp
                                @if($diffMin < 0)
                                    <span class="badge due-overdue">งานนี้เกินกำหนดแล้ว ({{ $task->due_at->format('d/m/Y H:i') }})</span>
                                @elseif($diffMin <= 60)
                                    <span class="badge due-warning">ใกล้ครบกำหนด (เหลือ {{ $task->due_at->diffForHumans() }})</span>
                                @else
                                    <span class="badge due-normal">เหลือเวลา: {{ $task->due_at->diffForHumans() }}</span>
                                @endif
                            @endif
                        </div>

                        <div class="meta-line">
                            <span>กำหนดส่ง: <strong>{{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่ระบุ' }}</strong></span>
                            @if($task->creator)
                                <span>• มอบหมายโดย: <strong>{{ $task->creator->name }}</strong></span>
                            @endif
                        </div>

                        {{-- Quick status changer form --}}
                        <form method="POST" action="{{ route('my.tasks.status', $task->id) }}" class="status-form" onsubmit="return false;">
                            @csrf
                            @method('PUT')

                            <span style="font-size: 13px; color: var(--text-secondary); font-weight: 500;">
                                อัปเดตสถานะงาน:
                            </span>

                            <select name="status" class="status-select" onchange="updateTaskStatusAjax(this, {{ $task->id }}, 'my')">
                                <option value="ยังไม่เริ่ม" {{ $task->status === 'ยังไม่เริ่ม' ? 'selected' : '' }}>ยังไม่เริ่ม</option>
                                <option value="รับงานแล้ว" {{ $task->status === 'รับงานแล้ว' ? 'selected' : '' }}>รับงานแล้ว</option>
                                <option value="กำลังดำเนินการ" {{ $task->status === 'กำลังดำเนินการ' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                                <option value="เสร็จแล้ว">เสร็จแล้ว</option>
                            </select>
                        </form>

                        {{-- History of status changes --}}
                        @if($task->histories->count() > 0)
                            <div class="history-box">
                                <div class="history-title">ประวัติการเปลี่ยนสถานะ</div>
                                @foreach($task->histories as $history)
                                    <div class="history-item">
                                        <span>{{ $history->user?->name ?? 'User' }}: <strong>{{ $history->old_status }}</strong> → <strong>{{ $history->new_status }}</strong></span>
                                        <span style="color: var(--text-secondary);">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="background: var(--bg-card); padding: 60px 20px; text-align: center; border-radius: 14px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
                        <div style="font-size: 19px; font-weight: 700; color: var(--text-primary);">ไม่มีงานคั่งค้างในขณะนี้</div>
                        <div style="font-size: 14px; color: var(--text-secondary); margin-top: 6px;">คุณได้จัดการงานที่ได้รับมอบหมายเสร็จสิ้นทั้งหมดแล้ว</div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 3) VIEW: ALL TASKS (จัดการงานทั้งหมด) -->
        <div id="viewAllTasks" class="task-workspace" style="{{ $currentView === 'all-tasks' ? 'display:flex;' : 'display:none;' }}">
            <div class="task-content-inner">

                {{-- Create Task Form (Executive, Manager, Admin only) --}}
                @if(auth()->user()->canManageTasks())
                    <div class="create-card">
                        <div class="card-header-title">
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
                                    <textarea name="description" rows="2" placeholder="ระบุขั้นตอน หรือสิ่งที่ต้องส่งมอบ..."></textarea>
                                </div>

                                <div>
                                    <label>มอบหมายให้</label>
                                    <select name="assigned_to">
                                        <option value="">-- ยังไม่มอบหมาย --</option>
                                        @foreach($allUsers->where('position', '!=', 'ผู้ดูแลระบบ') as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} ({{ $user->position }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label>ระดับความสำคัญ <span style="color: #f87171;">*</span></label>
                                    <select name="priority" required>
                                        <option value="ต่ำ">ต่ำ</option>
                                        <option value="ปกติ" selected>ปกติ</option>
                                        <option value="สูง">สูง</option>
                                        <option value="ด่วน">ด่วน</option>
                                    </select>
                                </div>

                                <div class="form-full">
                                    <label>กำหนดส่ง (วัน/เวลา)</label>
                                    <input type="datetime-local" name="due_at">
                                </div>
                            </div>

                            <div style="margin-top: 16px; display: flex; justify-content: flex-end;">
                                <button type="submit" class="btn-submit">
                                    ＋ ยืนยันการสร้างงาน
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- Quick Filter Pills --}}
                <div class="filter-pills-bar">
                    <button type="button" class="filter-pill active" onclick="filterAllTasks('all', this)">ทั้งหมด ({{ $allTasks->count() }})</button>
                    <button type="button" class="filter-pill" onclick="filterAllTasks('ยังไม่เริ่ม', this)">ยังไม่เริ่ม ({{ $allTasks->where('status', 'ยังไม่เริ่ม')->count() }})</button>
                    <button type="button" class="filter-pill" onclick="filterAllTasks('รับงานแล้ว', this)">รับงานแล้ว ({{ $allTasks->where('status', 'รับงานแล้ว')->count() }})</button>
                    <button type="button" class="filter-pill" onclick="filterAllTasks('กำลังดำเนินการ', this)">กำลังทำ ({{ $allTasks->where('status', 'กำลังดำเนินการ')->count() }})</button>
                    <button type="button" class="filter-pill" onclick="filterAllTasks('เสร็จแล้ว', this)">เสร็จแล้ว ({{ $allTasks->where('status', 'เสร็จแล้ว')->count() }})</button>
                    <button type="button" class="filter-pill" onclick="filterAllTasks('ด่วน', this)">งานด่วน ({{ $allTasks->where('priority', 'ด่วน')->count() }})</button>
                </div>

                {{-- Task Cards List --}}
                <div id="allTasksList" style="display: flex; flex-direction: column; gap: 14px;">
                    @forelse($allTasks as $task)
                        <div class="task-card all-task-item"
                             data-task-id="{{ $task->id }}"
                             data-status="{{ $task->status }}"
                             data-priority="{{ $task->priority }}">

                            <div class="task-top">
                                <div>
                                    <div class="task-title">{{ $task->title }}</div>
                                    <div style="font-size: 12.5px; color: var(--text-secondary); margin-top: 3px;">
                                        ผู้รับผิดชอบ: <strong style="color: #93c5fd;">{{ $task->assignee?->name ?? 'ยังไม่มอบหมาย' }}</strong>
                                        &nbsp;•&nbsp; ผู้สร้าง: <span>{{ $task->creator?->name ?? '-' }}</span>
                                    </div>
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
                                    {{ $task->priority }}
                                </span>
                            </div>

                            @if($task->description)
                                <div class="task-desc">{{ $task->description }}</div>
                            @endif

                            <div class="badges-row">
                                <span class="badge status-badge">
                                    {{ $task->status }}
                                </span>

                                @if($task->due_at)
                                    @php
                                        $diffMin = now()->diffInMinutes($task->due_at, false);
                                    @endphp
                                    @if($diffMin < 0)
                                        <span class="badge due-overdue">เกินกำหนดแล้ว</span>
                                    @elseif($diffMin <= 60)
                                        <span class="badge due-warning">ใกล้ครบกำหนด</span>
                                    @else
                                        <span class="badge due-normal">เหลือเวลา: {{ $task->due_at->diffForHumans() }}</span>
                                    @endif
                                @endif
                            </div>

                            <div class="meta-line">
                                <span>กำหนดส่ง: <strong>{{ $task->due_at?->format('d/m/Y H:i') ?? 'ไม่ระบุ' }}</strong></span>
                                <span>• สร้างเมื่อ: {{ $task->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            {{-- Task Actions (Status changer, Edit, Delete) --}}
                            @php
                                $canChangeStatus =
                                    $task->assigned_to == auth()->id() ||
                                    auth()->user()->canManageTasks();
                            @endphp

                            <div class="task-actions">
                                @if($canChangeStatus)
                                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" style="display: flex; align-items: center; gap: 8px; margin: 0;" onsubmit="return false;">
                                        @csrf
                                        @method('PUT')
                                        <span style="font-size: 12.5px; color: var(--text-secondary);">เปลี่ยนสถานะ:</span>
                                        <select name="status" class="status-select" onchange="updateTaskStatusAjax(this, {{ $task->id }}, 'all')">
                                            <option value="ยังไม่เริ่ม" {{ $task->status === 'ยังไม่เริ่ม' ? 'selected' : '' }}>ยังไม่เริ่ม</option>
                                            <option value="รับงานแล้ว" {{ $task->status === 'รับงานแล้ว' ? 'selected' : '' }}>รับงานแล้ว</option>
                                            <option value="กำลังดำเนินการ" {{ $task->status === 'กำลังดำเนินการ' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                                            <option value="เสร็จแล้ว" {{ $task->status === 'เสร็จแล้ว' ? 'selected' : '' }}>เสร็จแล้ว</option>
                                        </select>
                                    </form>
                                @endif

                                <div style="display: flex; align-items: center; gap: 8px; margin-left: auto;">
                                    @if(auth()->user()->canManageTasks())
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action-edit">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>แก้ไข</span>
                                        </a>
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" onsubmit="return handleDeleteTaskAjax(event, {{ $task->id }})" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path><path d="M4 6h16"></path><path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path><line x1="10" y1="10" x2="10" y2="17"></line><line x1="14" y1="10" x2="14" y2="17"></line></svg>
                                                <span>ลบ</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            {{-- History log --}}
                            @if($task->histories->count() > 0)
                                <div class="history-box">
                                    <div class="history-title">ประวัติการเปลี่ยนสถานะ</div>
                                    @foreach($task->histories as $history)
                                        <div class="history-item">
                                            <span>{{ $history->user?->name ?? 'User' }}: <strong>{{ $history->old_status }}</strong> → <strong>{{ $history->new_status }}</strong></span>
                                            <span style="color: var(--text-secondary);">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="background: var(--bg-card); padding: 60px 20px; text-align: center; border-radius: 14px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
                            <div style="font-size: 19px; font-weight: 700; color: var(--text-primary);">ยังไม่มีงานในระบบ</div>
                            <div style="font-size: 14px; color: var(--text-secondary); margin-top: 6px;">คุณสามารถสร้างงานใหม่และมอบหมายให้ทีมงานได้จากฟอร์มด้านบน</div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- 4) VIEW: COMPANY NEWS & ANNOUNCEMENTS (ข่าวสารองค์กร) -->
        <div id="viewNews" class="news-workspace" style="{{ $currentView === 'news' ? 'display:flex;' : 'display:none;' }}">
            <div class="news-container">

                <!-- Header Actions / Quick Creator Banner (For Executives / Admins) -->
                @if(auth()->user()->canManageNews())
                    <div style="background: linear-gradient(135deg, rgba(0, 200, 83, 0.12) 0%, rgba(0, 176, 255, 0.08) 100%); border: 1px solid rgba(0, 200, 83, 0.3); border-radius: 16px; padding: 18px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 14px;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: linear-gradient(135deg, #00C853, #00a844); display: flex; align-items: center; justify-content: center; font-size: 22px; color: #fff; box-shadow: 0 4px 12px rgba(0,200,83,0.3); flex-shrink: 0;">
                                📢
                            </div>
                            <div>
                                <div style="font-weight: 700; font-size: 16px; color: var(--text-primary);">ศูนย์เผยแพร่ข่าวสารองค์กร (Executive Broadcast)</div>
                                <div style="font-size: 13px; color: var(--text-secondary); margin-top: 2px;">คุณมีสิทธิ์ผู้บริหาร/ผู้ดูแลระบบ สามารถสร้างประกาศ แนบรูปภาพ และบันทึกเสียงแถลงการณ์ได้</div>
                            </div>
                        </div>
                        <button type="button" onclick="openCreateNewsModal()" class="btn-create-task" style="background: linear-gradient(135deg, #00C853 0%, #00a844 100%); font-weight: 600; padding: 9px 20px; border-radius: 10px; border: none; color: #fff; cursor: pointer; display: flex; align-items: center; gap: 6px; box-shadow: 0 4px 14px rgba(0, 200, 83, 0.35);">
                            <span style="font-size: 16px;">＋</span>
                            <span>เขียนประกาศข่าวใหม่</span>
                        </button>
                    </div>
                @endif

                <!-- Filter Chips -->
                <div class="news-filter-bar">
                    <button type="button" class="news-filter-chip active" onclick="filterNewsCategory('all', this)">
                        ทั้งหมด ({{ $newsList->count() }})
                    </button>
                    <button type="button" class="news-filter-chip" onclick="filterNewsCategory('pinned', this)">
                        ปักหมุด ({{ $newsList->where('is_pinned', true)->count() }})
                    </button>
                    <button type="button" class="news-filter-chip" onclick="filterNewsCategory('ประกาศสำคัญ', this)">
                        ประกาศสำคัญ
                    </button>
                    <button type="button" class="news-filter-chip" onclick="filterNewsCategory('กิจกรรม', this)">
                        กิจกรรมบริษัท
                    </button>
                    <button type="button" class="news-filter-chip" onclick="filterNewsCategory('สวัสดิการ', this)">
                        สวัสดิการ
                    </button>
                    <button type="button" class="news-filter-chip" onclick="filterNewsCategory('ทั่วไป', this)">
                        ข่าวทั่วไป
                    </button>
                </div>

                <!-- News Cards Feed -->
                <div id="newsFeedList" style="display: flex; flex-direction: column; gap: 18px;">
                    @forelse($newsList as $item)
                        @php
                            $isLiked = $item->isLikedBy(auth()->user());
                            $likesCount = $item->likes->count();
                            $authorRoleClass = match($item->user?->position) {
                                'ผู้บริหาร', 'ผู้จัดการ', 'Executive', 'Manager' => 'role-executive',
                                'แอดมิน', 'ผู้ดูแลระบบ', 'Admin' => 'role-admin',
                                'หัวหน้างาน', 'Supervisor' => 'role-supervisor',
                                default => 'role-employee',
                            };
                        @endphp
                        <article class="news-card {{ $item->is_pinned ? 'is-pinned' : '' }}" 
                                 data-category="{{ $item->category }}" 
                                 data-is-pinned="{{ $item->is_pinned ? '1' : '0' }}"
                                 data-news-id="{{ $item->id }}"
                                 id="newsCard{{ $item->id }}">
                            
                            <div class="news-card-header">
                                <div class="news-author-group">
                                    @if($item->user?->avatar)
                                        <img src="{{ $item->user->avatar }}" class="news-author-avatar" alt="{{ $item->user->name }}">
                                    @else
                                        <div class="news-author-initial" style="background: {{ $item->user?->position_color ?? '#00C853' }};">
                                            {{ strtoupper(mb_substr($item->user?->name ?? 'U', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="news-author-meta">
                                        <div class="news-author-name">
                                            <span>{{ $item->user?->name ?? 'ผู้ดูแลระบบ' }}</span>
                                            <span class="role-pill {{ $authorRoleClass }}" style="font-size: 10.5px; padding: 1px 8px;">
                                                {{ $item->user?->position ?? 'ผู้บริหาร' }}
                                            </span>
                                            @if($item->is_pinned)
                                                <span class="news-badge-pinned">
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg>
                                                    <span>ปักหมุด</span>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="news-timestamp">
                                            <span>{{ $item->created_at->format('d/m/Y H:i') }} น.</span>
                                            <span style="margin: 0 4px; opacity: 0.5;">•</span>
                                            <span style="color: {{ $item->category_color }}; font-weight: 600;">{{ $item->category }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Management Actions for Executives / Admins --}}
                                @if(auth()->user()->canManageNews())
                                    <div class="news-admin-actions">
                                        <form method="POST" action="{{ route('news.pin', $item->id) }}" onsubmit="return handlePinNewsAjax(event, {{ $item->id }})" style="display:inline; margin:0;">
                                            @csrf
                                            <button type="submit" class="btn-news-action {{ $item->is_pinned ? 'pinned' : '' }}" title="{{ $item->is_pinned ? 'ยกเลิกการปักหมุด' : 'ปักหมุดข่าวนี้' }}">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="{{ $item->is_pinned ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg>
                                                <span>{{ $item->is_pinned ? 'เลิกปักหมุด' : 'ปักหมุด' }}</span>
                                            </button>
                                        </form>

                                        <button type="button" class="btn-news-action" onclick="openEditNewsModal({{ json_encode([
                                            'id' => $item->id,
                                            'title' => $item->title,
                                            'category' => $item->category,
                                            'content' => $item->content,
                                            'is_pinned' => $item->is_pinned,
                                            'has_cover' => !empty($item->cover_image),
                                            'has_audio' => !empty($item->audio_file),
                                        ]) }})" title="แก้ไขข่าว">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            <span>แก้ไข</span>
                                        </button>

                                        <form method="POST" action="{{ route('news.destroy', $item->id) }}" onsubmit="return handleDeleteNewsAjax(event, {{ $item->id }})" style="display:inline; margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-news-action danger" title="ลบประกาศข่าว">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path><path d="M4 6h16"></path><path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path><line x1="10" y1="10" x2="10" y2="17"></line><line x1="14" y1="10" x2="14" y2="17"></line></svg>
                                                <span>ลบ</span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <!-- News Title -->
                            <h2 class="news-title">{{ $item->title }}</h2>

                            <!-- Cover Image (If exists) -->
                            @if($item->cover_image)
                                <div class="news-cover-wrap" onclick="openImageModal('{{ $item->cover_image }}')">
                                    <img src="{{ $item->cover_image }}" class="news-cover-img" alt="{{ $item->title }}" loading="lazy">
                                </div>
                            @endif

                            <!-- Audio Announcement Player (If exists) -->
                            @if($item->audio_file)
                                <div class="news-audio-player">
                                    <div class="news-audio-icon">🎙️</div>
                                    <div class="news-audio-info">
                                        <div class="news-audio-title">🔊 คลิปเสียงแถลงการณ์ / ประกาศเสียง</div>
                                        <audio controls class="news-audio-element" src="{{ $item->audio_file }}"></audio>
                                    </div>
                                </div>
                            @endif

                            <!-- News Content -->
                            <div class="news-content">{!! nl2br(e($item->content)) !!}</div>

                            <!-- Footer Reaction Bar -->
                            <div class="news-footer">
                                <button type="button" 
                                        class="news-like-btn {{ $isLiked ? 'liked' : '' }}" 
                                        onclick="toggleNewsLike({{ $item->id }}, this)">
                                    <span class="like-icon">{{ $isLiked ? '❤️' : '🤍' }}</span>
                                    <span class="like-label">{{ $isLiked ? 'ถูกใจแล้ว' : 'ถูกใจ' }}</span>
                                    <span class="like-counter" style="margin-left: 2px;">({{ $likesCount }})</span>
                                </button>

                                <button type="button" 
                                        class="btn-news-action" 
                                        onclick="copyNewsLink({{ $item->id }})">
                                    🔗 คัดลอกลิงก์
                                </button>
                            </div>

                        </article>
                    @empty
                        <div style="background: var(--bg-card); padding: 70px 20px; text-align: center; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
                            <div style="font-size: 38px; margin-bottom: 10px;">📰</div>
                            <div style="font-size: 18px; font-weight: 700; color: var(--text-primary);">ยังไม่มีข่าวสารหรือประกาศในขณะนี้</div>
                            <div style="font-size: 14px; color: var(--text-secondary); margin-top: 6px;">
                                @if(auth()->user()->canManageNews())
                                    คุณสามารถคลิกปุ่ม <strong>"เขียนประกาศข่าวใหม่"</strong> ด้านบนเพื่อเริ่มเผยแพร่ข่าวสาร ภาพ หรือเสียงให้กับองค์กรได้ทันที
                                @else
                                    เมื่อผู้บริหารหรือฝ่ายจัดการเผยแพร่ประกาศ ข้อมูลจะแสดงขึ้นที่นี่โดยอัตโนมัติ
                                @endif
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </main>
    </div>

    <!-- Settings Modal (Account Profile & Password & Logout) -->
    <div id="settingsModal" class="modal-overlay">
        <div class="modal-card" style="width: 480px; max-width: 95vw; max-height: 90vh; overflow-y: auto;">
            <div class="modal-title" style="justify-content: space-between; margin-bottom: 18px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('logo.png') }}" alt="CompanyChat" style="width: 24px; height: 24px; object-fit: contain; border-radius: 6px; flex-shrink: 0;">
                    <span>การตั้งค่าบัญชีผู้ใช้</span>
                </div>
                <button type="button" onclick="closeSettingsModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 2px 6px; border-radius: 6px;" aria-label="ปิดหน้าต่าง">✕</button>
            </div>

            <!-- Profile Summary Card -->
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px; padding: 14px; background: var(--bg-surface); border-radius: 12px; border: 1px solid var(--border-color);">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1px solid var(--border-color);" alt="{{ auth()->user()->name }}">
                @else
                    <div class="user-avatar" style="width: 48px; height: 48px; font-size: 18px; border-radius: 50%; flex-shrink: 0;">
                        {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div style="display: flex; flex-direction: column; min-width: 0;">
                    <span style="font-weight: 700; font-size: 15px; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ auth()->user()->name }}</span>
                    <div style="display: flex; align-items: center; gap: 8px; margin-top: 4px;">
                        <span class="role-pill {{ $roleClass }}" style="font-size: 11px; padding: 2px 8px; width: fit-content;">
                            {{ auth()->user()->position ?? 'พนักงาน' }}
                        </span>
                        <span style="font-size: 12px; color: var(--text-secondary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar Upload Section -->
                <div class="avatar-uploader-card">
                    <div class="settings-avatar-preview-wrap">
                        @if(auth()->user()->avatar)
                            <img id="settingsAvatarPreview" src="{{ auth()->user()->avatar }}" class="settings-avatar-preview-img" alt="Avatar">
                            <div id="settingsAvatarFallback" class="settings-avatar-fallback-text" style="display: none;">
                                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @else
                            <img id="settingsAvatarPreview" src="" class="settings-avatar-preview-img" style="display: none;" alt="Avatar">
                            <div id="settingsAvatarFallback" class="settings-avatar-fallback-text">
                                {{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size: 13.5px; font-weight: 700; color: var(--text-primary); margin-bottom: 3px;">
                            รูปภาพโปรไฟล์ (Profile Picture)
                        </div>
                        <div style="font-size: 11.5px; color: var(--text-secondary); margin-bottom: 10px;">
                            เลือกรูปจากเครื่องหรือคลังรูปภาพในโทรศัพท์ (JPG, PNG)
                        </div>
                        <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
                            <button type="button" class="btn-avatar-pick" onclick="document.getElementById('avatarFileInput').click()">
                                <span>เลือกรูปจากเครื่อง / คลังรูป</span>
                            </button>
                            <button type="button"
                                    id="btnRemoveAvatar"
                                    class="btn-avatar-remove"
                                    onclick="removeAvatarPhoto()"
                                    style="{{ auth()->user()->avatar ? 'display:inline-flex;' : 'display:none;' }}">
                                <span>ลบรูป</span>
                            </button>
                        </div>
                        <!-- Hidden File & Data Inputs -->
                        <input type="file" id="avatarFileInput" accept="image/*" style="display: none;" onchange="handleAvatarFileSelect(event)">
                        <input type="hidden" name="avatar" id="avatarDataInput">
                        <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                        <input type="file" name="avatar_file" id="avatarFormFileInput" style="display: none;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label class="form-label">ชื่อจริง</label>
                        <input type="text"
                               name="first_name"
                               class="form-input"
                               value="{{ old('first_name', auth()->user()->first_name ?? (explode(' ', trim(auth()->user()->name))[0] ?? '')) }}"
                               required
                               placeholder="ชื่อจริง">
                    </div>
                    <div>
                        <label class="form-label">นามสกุล</label>
                        <input type="text"
                               name="last_name"
                               class="form-input"
                               value="{{ old('last_name', auth()->user()->last_name ?? (explode(' ', trim(auth()->user()->name))[1] ?? '')) }}"
                               required
                               placeholder="นามสกุล">
                    </div>
                </div>

                <div style="margin-bottom: 18px;">
                    <label class="form-label">อีเมลบัญชีผู้ใช้</label>
                    <input type="email"
                           class="form-input"
                           value="{{ auth()->user()->email }}"
                           disabled
                           style="opacity: 0.7; cursor: not-allowed; background: var(--bg-surface); color: var(--text-secondary); border: 1px solid var(--border-color);"
                           title="ยังไม่เปิดให้แก้ไขอีเมลในขณะนี้">
                    <span style="font-size: 11.5px; color: var(--text-secondary);">* อีเมลใช้สำหรับการเข้าสู่ระบบ ไม่สามารถเปลี่ยนได้</span>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 18px;">
                    <button type="button"
                            onclick="closeSettingsModal()"
                            style="padding: 9px 16px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-family: inherit; font-size: 13px;">
                        ยกเลิก
                    </button>
                    <button type="submit"
                            class="btn-submit"
                            style="padding: 9px 22px; font-size: 13px;">
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </form>

            <!-- Logout Section inside Settings Modal -->
            <div style="margin-top: 22px; padding-top: 18px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
                <div>
                    <div style="font-size: 13.5px; font-weight: 600; color: #dc2626;">ออกจากระบบ (Sign Out)</div>
                    <div style="font-size: 12px; color: var(--text-secondary); margin-top: 2px;">สิ้นสุดการใช้งานบัญชีของคุณบนอุปกรณ์นี้</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn" style="padding: 9px 18px; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                        <span>ออกจากระบบ</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Start New Direct Message Modal -->
    <div id="newDmModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" style="width: 480px; max-width: 95vw; max-height: 85vh; display: flex; flex-direction: column;">
            <div class="modal-title" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span>เริ่มแชตส่วนตัวใหม่</span>
                </div>
                <button type="button" onclick="closeNewDmModal()" style="background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer;">✕</button>
            </div>
            
            <p style="font-size: 13px; color: var(--text-secondary); margin: -4px 0 14px 0;">
                เลือกเพื่อนร่วมงานที่ต้องการสนทนาแบบตัวต่อตัว
            </p>

            <div style="position: relative; margin-bottom: 12px;">
                <input type="text" 
                       id="dmModalSearchInput"
                       class="form-input" 
                       placeholder="พิมพ์ชื่อเพื่อนร่วมงาน หรือตำแหน่ง..." 
                       oninput="filterDmModalUsers(this.value)"
                       autocomplete="off"
                       style="padding: 10px 14px;">
            </div>

            <div id="dmModalUserList" style="flex: 1; overflow-y: auto; max-height: 340px; display: flex; flex-direction: column; gap: 6px; padding-right: 4px;">
                <!-- Empty Search Prompt -->
                <div id="dmModalEmptyPrompt" style="padding: 36px 16px; text-align: center; color: var(--text-muted); font-size: 13px;">
                    พิมพ์ชื่อหรือตำแหน่งเพื่อนร่วมงานในช่องด้านบน เพื่อค้นหา
                </div>

                <!-- No Results State -->
                <div id="dmModalNoResults" style="display: none; padding: 36px 16px; text-align: center; color: var(--text-muted); font-size: 13px;">
                    ไม่พบเพื่อนร่วมงานที่ใกล้เคียงกับชื่อที่พิมพ์
                </div>

                @foreach($allUsers->where('id', '!=', auth()->id()) as $colleague)
                    @php
                        $colFirstName = $colleague->resolved_first_name ?? explode(' ', $colleague->name)[0];
                    @endphp
                    <a href="{{ route('messages.directChat', $colleague->id) }}" 
                       class="dm-select-card"
                       data-user-name="{{ mb_strtolower($colleague->name) }}"
                       data-user-pos="{{ mb_strtolower($colleague->position ?? '') }}"
                       data-user-email="{{ mb_strtolower($colleague->email ?? '') }}"
                       style="display: none; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 10px; background: var(--bg-surface); border: 1px solid var(--border-color); text-decoration: none; transition: all 0.15s ease;">
                        <div style="display: flex; align-items: center; gap: 10px; min-width: 0;">
                            @if($colleague->avatar)
                                <img src="{{ $colleague->avatar }}" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; flex-shrink: 0;" alt="{{ $colleague->name }}">
                            @else
                                <div class="dm-avatar-fallback" style="width: 38px; height: 38px; font-size: 14px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(0,200,83,0.1); color: {{ $colleague->position_color ?? '#00C853' }}; font-weight: 700;">
                                    {{ strtoupper(mb_substr($colFirstName, 0, 1)) }}
                                </div>
                            @endif
                            <div style="display: flex; flex-direction: column; min-width: 0;">
                                <span style="font-weight: 600; font-size: 13.5px; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $colleague->name }}</span>
                                <span style="font-size: 11.5px; color: var(--text-secondary);">{{ $colleague->email }}</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                            <span class="role-pill" style="font-size: 10.5px; padding: 2px 8px; color: {{ $colleague->position_color ?? '#00C853' }};">
                                {{ $colleague->position ?? 'พนักงาน' }}
                            </span>
                            <span style="font-size: 13px; color: #00C853; font-weight: 600;">คุยแชต →</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--border-color);">
                <button type="button" 
                        onclick="closeNewDmModal()" 
                        style="padding: 8px 18px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-size: 13px;">
                    ปิดหน้าต่าง
                </button>
            </div>
        </div>
    </div>

    <!-- Create Room Modal -->
    <div id="createRoomModal" class="modal-overlay">
        <div class="modal-card" style="max-width: 480px; width: 95%;">
            <div class="modal-title" style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #00C853;">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span>สร้างห้องแชตใหม่</span>
                </div>
                <button type="button" onclick="document.getElementById('createRoomModal').style.display='none'" style="background: transparent; border: none; color: var(--text-muted); font-size: 18px; cursor: pointer; padding: 2px 6px;">✕</button>
            </div>

            <form method="POST" action="{{ route('rooms.store') }}">
                @csrf

                <div style="display: flex; justify-content: space-between; align-items: baseline;">
                    <label class="form-label">ชื่อห้องแชต (สูงสุด 30 ตัวอักษร)</label>
                    <span id="createRoomNameCount" style="font-size: 11px; color: var(--text-muted);">0/30</span>
                </div>
                <input type="text"
                       name="name"
                       id="createRoomNameInput"
                       class="form-input"
                       maxlength="30"
                       oninput="document.getElementById('createRoomNameCount').textContent = this.value.length + '/30'"
                       placeholder="เช่น แผนกการตลาด, โปรเจกต์ Alpha"
                       required>

                <label class="form-label">รายละเอียดห้อง (ถ้ามี)</label>
                <textarea name="description"
                          class="form-textarea"
                          rows="2"
                          maxlength="500"
                          placeholder="อธิบายวัตถุประสงค์ของห้องแชตนี้..."></textarea>

                <!-- Room Privacy Type -->
                <div style="margin-top: 10px; margin-bottom: 12px;">
                    <label class="form-label" style="margin-bottom: 6px;">ประเภทห้องแชต</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <label class="room-type-radio-label" id="roomTypePublicLabel" style="display: flex; align-items: center; gap: 8px; padding: 10px 12px; border: 1.5px solid #3b82f6; border-radius: 8px; cursor: pointer; background: rgba(59, 130, 246, 0.08);">
                            <input type="radio" name="is_private" value="0" checked onchange="toggleCreateRoomPrivacy(false)">
                            <div>
                                <div style="font-weight: 600; font-size: 13px; color: var(--text-primary);">🌐 สาธารณะ</div>
                                <div style="font-size: 11px; color: var(--text-secondary);">ทุกคนในองค์กรเข้าได้</div>
                            </div>
                        </label>
                        <label class="room-type-radio-label" id="roomTypePrivateLabel" style="display: flex; align-items: center; gap: 8px; padding: 10px 12px; border: 1px solid var(--border-color); border-radius: 8px; cursor: pointer; background: var(--bg-surface);">
                            <input type="radio" name="is_private" value="1" onchange="toggleCreateRoomPrivacy(true)">
                            <div>
                                <div style="font-weight: 600; font-size: 13px; color: var(--text-primary);">🔒 เฉพาะกลุ่ม</div>
                                <div style="font-size: 11px; color: var(--text-secondary);">เลือกสมาชิกที่เข้าร่วม</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Searchable Member Selection for Private Group -->
                <div id="createRoomMembersBox" style="display: none; margin-bottom: 14px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <label class="form-label" style="margin-bottom: 0;">เลือกสมาชิกในกลุ่ม</label>
                        <span id="selectedMembersCount" style="font-size: 12px; color: #3b82f6; font-weight: 600;">เลือกแล้ว 0 คน</span>
                    </div>
                    <div style="position: relative; margin-bottom: 8px;">
                        <input type="text" id="createRoomMemberSearch" class="form-input" placeholder="พิมพ์ชื่อเพื่อค้นหาสมาชิก..." style="padding-left: 32px;" oninput="filterCreateRoomMembers(this.value)">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-muted);">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <div id="createRoomMemberList" style="max-height: 180px; overflow-y: auto; border: 1px solid var(--border-color); border-radius: 8px; padding: 6px; display: flex; flex-direction: column; gap: 4px; background: var(--bg-input);">
                        @foreach($allUsers as $u)
                            @if($u->id !== auth()->id())
                                <label class="create-member-item" data-name="{{ mb_strtolower($u->name) }}" data-pos="{{ mb_strtolower($u->position ?? '') }}" style="display: flex; align-items: center; gap: 10px; padding: 6px 8px; border-radius: 6px; cursor: pointer; transition: background 0.15s ease;">
                                    <input type="checkbox" name="member_ids[]" value="{{ $u->id }}" onchange="updateSelectedMembersCount()" style="width: 16px; height: 16px; cursor: pointer;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; overflow: hidden; flex-shrink: 0;">
                                        @if($u->avatar)
                                            <img src="{{ $u->avatar }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            {{ mb_substr($u->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <div style="font-size: 13px; font-weight: 500; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $u->name }}</div>
                                    </div>
                                    <span style="font-size: 11px; padding: 2px 8px; border-radius: 10px; background: {{ $u->position_color ?? '#e2e8f0' }}22; color: {{ $u->position_color ?? '#64748b' }}; font-weight: 500;">
                                        {{ $u->position ?: 'พนักงาน' }}
                                    </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 14px;">
                    <button type="button"
                            onclick="document.getElementById('createRoomModal').style.display='none'"
                            style="padding: 9px 16px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer;">
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

    <!-- Edit Room Modal -->
    <div id="editRoomModal" class="modal-overlay" style="display: none;">
        <div class="modal-card">
            <div class="modal-title" style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    <span>แก้ไขชื่อห้องแชต</span>
                </div>
                <button type="button" onclick="closeEditRoomModal()" style="background: transparent; border: none; color: var(--text-muted); font-size: 18px; cursor: pointer; padding: 2px 6px;">✕</button>
            </div>

            <form id="editRoomForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div style="display: flex; justify-content: space-between; align-items: baseline;">
                    <label class="form-label">ชื่อห้องแชต (สูงสุด 30 ตัวอักษร)</label>
                    <span id="editRoomNameCount" style="font-size: 11px; color: var(--text-muted);">0/30</span>
                </div>
                <input type="text"
                       name="name"
                       id="editRoomNameInput"
                       class="form-input"
                       maxlength="30"
                       oninput="document.getElementById('editRoomNameCount').textContent = this.value.length + '/30'"
                       placeholder="เช่น แผนกการตลาด"
                       required>

                <label class="form-label">รายละเอียดห้อง (ถ้ามี)</label>
                <textarea name="description"
                          id="editRoomDescInput"
                          class="form-textarea"
                          rows="3"
                          maxlength="500"
                          placeholder="อธิบายวัตถุประสงค์ของห้องแชตนี้..."></textarea>

                <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 14px;">
                    <button type="button"
                            onclick="closeEditRoomModal()"
                            style="padding: 9px 16px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer;">
                        ยกเลิก
                    </button>

                    <button type="submit"
                            style="padding: 9px 20px; border: none; background: var(--accent-gradient); color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        บันทึกการแก้ไข
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Room Members Modal -->
    <div id="roomMembersModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" style="max-width: 480px; width: 95%;">
            <div class="modal-title" style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span id="manageMembersModalTitle">จัดการสมาชิกห้องแชต</span>
                </div>
                <button type="button" onclick="closeRoomMembersModal()" style="background: transparent; border: none; color: var(--text-muted); font-size: 18px; cursor: pointer; padding: 2px 6px;">✕</button>
            </div>

            <!-- Tabs: สมาชิกปัจจุบัน / เพิ่มสมาชิกใหม่ -->
            <div class="members-modal-tabs" style="display: flex; gap: 8px; border-bottom: 1px solid var(--border-color); margin-bottom: 12px;">
                <button type="button" class="tab-btn active" id="tabCurrentMembers" onclick="switchMembersTab('current')">
                    สมาชิกปัจจุบัน (<span id="membersCountBadge">0</span>)
                </button>
                <button type="button" class="tab-btn" id="tabAddMembers" onclick="switchMembersTab('add')">
                    ➕ เพิ่มสมาชิก
                </button>
            </div>

            <!-- Tab 1: Current Members -->
            <div id="panelCurrentMembers">
                <div style="position: relative; margin-bottom: 10px;">
                    <input type="text" id="searchCurrentMembersInput" class="form-input" placeholder="ค้นหาสมาชิกปัจจุบัน..." style="padding-left: 32px;" oninput="filterCurrentMembers(this.value)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-muted);">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <div id="currentMembersList" style="max-height: 280px; overflow-y: auto; display: flex; flex-direction: column; gap: 6px; padding-right: 4px;">
                    <!-- Rendered dynamically via JS -->
                </div>
            </div>

            <!-- Tab 2: Add Members -->
            <div id="panelAddMembers" style="display: none;">
                <div style="position: relative; margin-bottom: 10px;">
                    <input type="text" id="searchNonMembersInput" class="form-input" placeholder="พิมพ์ชื่อเพื่อนร่วมงานที่ต้องการเพิ่ม..." style="padding-left: 32px;" oninput="filterNonMembers(this.value)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-muted);">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <div id="nonMembersList" style="max-height: 230px; overflow-y: auto; display: flex; flex-direction: column; gap: 6px; padding-right: 4px; border: 1px solid var(--border-color); border-radius: 8px; padding: 8px; background: var(--bg-input);">
                    <!-- Rendered dynamically via JS -->
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px;">
                    <span id="selectedNewMembersCount" style="font-size: 12px; color: #3b82f6; font-weight: 600;">เลือก 0 คน</span>
                    <button type="button" id="btnSubmitAddMembers" onclick="submitAddRoomMembers()" style="padding: 8px 18px; border: none; background: #3b82f6; color: white; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        ยืนยันการเพิ่ม
                    </button>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 14px; border-top: 1px solid var(--border-color); padding-top: 12px;">
                <button type="button" onclick="closeRoomMembersModal()" style="padding: 8px 16px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer;">
                    ปิด
                </button>
            </div>
        </div>
    </div>

    @if(auth()->user()->canManageNews())
    <!-- Create News Modal -->
    <div id="createNewsModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" style="width: 620px; max-width: 95vw; max-height: 90vh; overflow-y: auto;">
            <div class="modal-title" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 20px;">📢</span>
                    <span>เขียนประกาศข่าวใหม่</span>
                </div>
                <button type="button" onclick="closeCreateNewsModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 2px 6px;" aria-label="ปิด">✕</button>
            </div>

            <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" id="createNewsForm">
                @csrf

                <!-- Title -->
                <div style="margin-bottom: 14px;">
                    <label class="form-label" for="news_title">หัวข้อประกาศข่าว <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="news_title" name="title" class="form-input" placeholder="ระบุหัวข้อข่าว เช่น แจ้งกำหนดการวันหยุด, ประกาศผลงานประจำไตรมาส" required>
                </div>

                <!-- Category & Pin -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label class="form-label" for="news_category">หมวดหมู่</label>
                        <select id="news_category" name="category" class="form-select">
                            <option value="ประกาศสำคัญ">🚨 ประกาศสำคัญ</option>
                            <option value="กิจกรรม">🎉 กิจกรรมบริษัท</option>
                            <option value="สวัสดิการ">🎁 สวัสดิการ</option>
                            <option value="ทั่วไป" selected>💬 ข่าวทั่วไป</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">การปักหมุด</label>
                        <label style="display: flex; align-items: center; gap: 8px; height: 42px; cursor: pointer; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 0 12px;">
                            <input type="checkbox" name="is_pinned" value="1" style="width: 16px; height: 16px; accent-color: #00C853;">
                            <span style="font-size: 13px; font-weight: 500; color: var(--text-primary); display: inline-flex; align-items: center; gap: 6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg>
                                <span>ปักหมุดไว้บนสุด</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Content -->
                <div style="margin-bottom: 14px;">
                    <label class="form-label" for="news_content">เนื้อหาประกาศ <span style="color: #ef4444;">*</span></label>
                    <textarea id="news_content" name="content" class="form-textarea" rows="5" placeholder="พิมพ์รายละเอียดเนื้อหาข่าวที่ต้องการแจ้งให้ทุกคนในบริษัททราบ..." required></textarea>
                </div>

                <!-- Cover Image Upload -->
                <div style="margin-bottom: 16px; padding: 12px; border: 1px dashed var(--border-color); border-radius: 10px; background: var(--bg-surface);">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>🖼️ รูปภาพหน้าปก / แบนเนอร์ (ถ้ามี)</span>
                        <span style="font-size: 11px; color: var(--text-secondary);">JPG, PNG, WebP (สูงสุด 10MB)</span>
                    </label>
                    <input type="file" id="newsCoverInput" name="cover_file" accept="image/*" class="form-input" style="padding: 6px;" onchange="previewNewsCover(this, 'createNewsCoverPreview')">
                    <div id="createNewsCoverPreview" style="display: none; margin-top: 10px; position: relative;">
                        <img src="" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                        <button type="button" onclick="clearNewsCover('newsCoverInput', 'createNewsCoverPreview')" style="position: absolute; top: 6px; right: 6px; background: rgba(0,0,0,0.65); color: #fff; border: none; border-radius: 50%; width: 26px; height: 26px; cursor: pointer;">✕</button>
                    </div>
                </div>

                <!-- Audio Announcement File -->
                <div style="margin-bottom: 20px; padding: 12px; border: 1px dashed var(--border-color); border-radius: 10px; background: var(--bg-surface);">
                    <label class="form-label" style="display: flex; align-items: center; justify-content: space-between;">
                        <span>🎙️ คลิปเสียงแถลงการณ์ / ประกาศเสียง (ถ้ามี)</span>
                        <span style="font-size: 11px; color: var(--text-secondary);">MP3, WAV, M4A, WebM (สูงสุด 20MB)</span>
                    </label>
                    <input type="file" id="newsAudioInput" name="audio_upload" accept="audio/*" class="form-input" style="padding: 6px;">
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeCreateNewsModal()" style="padding: 9px 18px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-size: 13.5px;">
                        ยกเลิก
                    </button>
                    <button type="submit" style="padding: 9px 24px; border: none; background: linear-gradient(135deg, #00C853 0%, #00a844 100%); color: white; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13.5px; box-shadow: 0 4px 14px rgba(0, 200, 83, 0.35);">
                        🚀 เผยแพร่ข่าวสาร
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit News Modal -->
    <div id="editNewsModal" class="modal-overlay" style="display: none;">
        <div class="modal-card" style="width: 620px; max-width: 95vw; max-height: 90vh; overflow-y: auto;">
            <div class="modal-title" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #3b82f6;"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    <span>แก้ไขประกาศข่าว</span>
                </div>
                <button type="button" onclick="closeEditNewsModal()" style="background: transparent; border: none; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 2px 6px;" aria-label="ปิด">✕</button>
            </div>

            <form method="POST" action="" enctype="multipart/form-data" id="editNewsForm">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div style="margin-bottom: 14px;">
                    <label class="form-label" for="edit_news_title">หัวข้อประกาศข่าว <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="edit_news_title" name="title" class="form-input" required>
                </div>

                <!-- Category & Pin -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label class="form-label" for="edit_news_category">หมวดหมู่</label>
                        <select id="edit_news_category" name="category" class="form-select">
                            <option value="ประกาศสำคัญ">🚨 ประกาศสำคัญ</option>
                            <option value="กิจกรรม">🎉 กิจกรรมบริษัท</option>
                            <option value="สวัสดิการ">🎁 สวัสดิการ</option>
                            <option value="ทั่วไป">💬 ข่าวทั่วไป</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">การปักหมุด</label>
                        <label style="display: flex; align-items: center; gap: 8px; height: 42px; cursor: pointer; background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: 8px; padding: 0 12px;">
                            <input type="checkbox" id="edit_news_pinned" name="is_pinned" value="1" style="width: 16px; height: 16px; accent-color: #00C853;">
                            <span style="font-size: 13px; font-weight: 500; color: var(--text-primary); display: inline-flex; align-items: center; gap: 6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: #f59e0b;"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg>
                                <span>ปักหมุดไว้บนสุด</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Content -->
                <div style="margin-bottom: 14px;">
                    <label class="form-label" for="edit_news_content">เนื้อหาประกาศ <span style="color: #ef4444;">*</span></label>
                    <textarea id="edit_news_content" name="content" class="form-textarea" rows="5" required></textarea>
                </div>

                <!-- Cover Image Upload -->
                <div style="margin-bottom: 16px; padding: 12px; border: 1px dashed var(--border-color); border-radius: 10px; background: var(--bg-surface);">
                    <label class="form-label">🖼️ เปลี่ยนรูปภาพหน้าปก</label>
                    <input type="file" id="editNewsCoverInput" name="cover_file" accept="image/*" class="form-input" style="padding: 6px;">
                    <div id="editNewsCoverExisting" style="display: none; margin-top: 8px;">
                        <label style="font-size: 12px; color: #ef4444; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                            <input type="checkbox" name="remove_cover" value="1"> ลบรูปภาพหน้าปกเดิมออก
                        </label>
                    </div>
                </div>

                <!-- Audio Announcement File -->
                <div style="margin-bottom: 20px; padding: 12px; border: 1px dashed var(--border-color); border-radius: 10px; background: var(--bg-surface);">
                    <label class="form-label">🎙️ เปลี่ยนคลิปเสียงประกาศ</label>
                    <input type="file" id="editNewsAudioInput" name="audio_upload" accept="audio/*" class="form-input" style="padding: 6px;">
                    <div id="editNewsAudioExisting" style="display: none; margin-top: 8px;">
                        <label style="font-size: 12px; color: #ef4444; display: flex; align-items: center; gap: 6px; cursor: pointer;">
                            <input type="checkbox" name="remove_audio" value="1"> ลบคลิปเสียงเดิมออก
                        </label>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeEditNewsModal()" style="padding: 9px 18px; border: 1px solid var(--border-color); background: var(--bg-surface); color: var(--text-primary); border-radius: 8px; cursor: pointer; font-size: 13.5px;">
                        ยกเลิก
                    </button>
                    <button type="submit" style="padding: 9px 24px; border: none; background: linear-gradient(135deg, #00C853 0%, #00a844 100%); color: white; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13.5px;">
                        บันทึกการแก้ไข
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Chat Image Lightbox Modal -->
    <div id="chatImageModal" class="chat-image-modal-overlay" style="display: none;" role="dialog" aria-modal="true" aria-label="ดูรูปภาพ">
        <div class="chat-image-modal-backdrop" onclick="closeChatImage()"></div>
        <div class="chat-image-modal-dialog">
            <div class="chat-image-modal-header">
                <span class="chat-image-modal-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                        <circle cx="9" cy="9" r="2"/>
                        <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                    </svg>
                    <span>รูปภาพ</span>
                </span>
                <div class="chat-image-modal-actions">
                    <button type="button" id="chatModalNewTabBtn" class="chat-image-action-btn" title="เปิดในแท็บใหม่">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                        <span>เปิดในแท็บใหม่</span>
                    </button>
                    <button type="button" id="chatModalDownloadBtn" class="chat-image-action-btn" title="ดาวน์โหลดรูปภาพ">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        <span>ดาวน์โหลด</span>
                    </button>
                    <button type="button" class="chat-image-close-btn" onclick="closeChatImage()" title="ปิด" aria-label="ปิด">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="chat-image-modal-body">
                <!-- Loading Spinner -->
                <div id="chatModalImageLoader" class="chat-image-loader" style="display: none;">
                    <div class="chat-image-spinner"></div>
                    <span>กำลังโหลดรูปภาพ...</span>
                </div>
                <!-- Error State -->
                <div id="chatModalImageError" class="chat-image-error" style="display: none;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <p class="chat-image-error-title">ไม่สามารถเปิดดูรูปภาพนี้ได้</p>
                    <p class="chat-image-error-subtitle">ไฟล์รูปภาพอาจเสียหาย ถูกลบ หรือรูปแบบไม่ถูกต้อง</p>
                    <button type="button" class="chat-image-retry-btn" onclick="closeChatImage()">ปิดหน้าต่าง</button>
                </div>
                <!-- Main Image -->
                <img id="chatModalImage" class="chat-modal-view-img" src="" alt="รูปภาพแชตขยายใหญ่" style="display: none;">
            </div>
        </div>
    </div>

</div>

<script>
    // Global Collapsible Sections Toggle & State Restore
    window.toggleSection = function(section) {
        const list = document.getElementById(section === 'rooms' ? 'sidebarRoomsList' : 'sidebarDmList');
        const arrow = document.getElementById(section === 'rooms' ? 'roomsCollapseArrow' : 'dmCollapseArrow');
        if (!list) return;

        const isCurrentlyCollapsed = list.classList.contains('collapsed');
        const willBeCollapsed = !isCurrentlyCollapsed;

        if (willBeCollapsed) {
            list.classList.add('collapsed');
            if (arrow) {
                arrow.classList.add('rotated');
                arrow.textContent = '▸';
            }
        } else {
            list.classList.remove('collapsed');
            if (arrow) {
                arrow.classList.remove('rotated');
                arrow.textContent = '▾';
            }
        }

        try {
            localStorage.setItem(`companychat_${section}_collapsed`, willBeCollapsed ? '1' : '0');
        } catch(e) {}
    };

    window.restoreCollapsibleSections = function() {
        try {
            if (localStorage.getItem('companychat_rooms_collapsed') === '1') {
                const roomsList = document.getElementById('sidebarRoomsList');
                const roomsArrow = document.getElementById('roomsCollapseArrow');
                if (roomsList) roomsList.classList.add('collapsed');
                if (roomsArrow) {
                    roomsArrow.classList.add('rotated');
                    roomsArrow.textContent = '▸';
                }
            }
            if (localStorage.getItem('companychat_dm_collapsed') === '1') {
                const dmList = document.getElementById('sidebarDmList');
                const dmArrow = document.getElementById('dmCollapseArrow');
                if (dmList) dmList.classList.add('collapsed');
                if (dmArrow) {
                    dmArrow.classList.add('rotated');
                    dmArrow.textContent = '▸';
                }
            }
        } catch(e) {}
    };

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

        const currentUserAvatar = @json(auth()->user()->avatar);
        const currentUserName = @json(auth()->user()->name);
        const currentUserFirstName = @json(auth()->user()->resolved_first_name);
        const currentUserPosition = @json(auth()->user()->position ?? 'พนักงาน');
        const currentUserPositionColor = @json(auth()->user()->position_color ?? '#00C853');
        const currentUserDisplayName = `${currentUserFirstName} (${currentUserPosition})`;
        const isAdminUser = @json(auth()->user()->position === 'ผู้ดูแลระบบ');

        const mentionUsersList = @json($mentionUsers ?? []);

        function getPositionColor(position) {
            const pos = (position || '').toString().toLowerCase().trim();
            if (pos.includes('แอดมิน') || pos.includes('ผู้ดูแลระบบ') || pos.includes('admin')) {
                return '#FF3D00';
            }
            if (pos.includes('ผู้บริหาร') || pos.includes('ผู้จัดการ') || pos.includes('manager') || pos.includes('executive')) {
                return '#FFB300';
            }
            if (pos.includes('หัวหน้างาน') || pos.includes('supervisor')) {
                return '#00B0FF';
            }
            return '#00C853';
        }

        function formatChatMessage(text, isEdited = false) {
            if (!text) return '';
            let escaped = escapeHtml(text);
            
            // Mentions highlighting
            escaped = escaped.replace(/@ทุกคน/g, '<span class="mention-badge mention-all">@ทุกคน</span>');
            escaped = escaped.replace(/@([^\s<]+)/g, '<span class="mention-badge">@$1</span>');

            const newsMatch = text.match(/(https?:\/\/[^\s]+view=news#newsCard(\d+)[^\s]*)/i);
            let newsPreview = '';
            if (newsMatch) {
                const newsId = newsMatch[2];
                newsPreview = `
                    <div class="chat-news-card" onclick="window.switchDashboardView('news'); setTimeout(() => { const c = document.getElementById('newsCard${newsId}'); if (c) c.scrollIntoView({ behavior: 'smooth', block: 'center' }); }, 150);">
                        <div style="font-weight: 700; font-size: 13px; color: #00C853; display: flex; align-items: center; gap: 6px;">
                            <span>📰</span> <span>ประกาศข่าวสารองค์กร</span>
                        </div>
                        <div style="font-size: 12px; color: var(--text-secondary); margin-top: 3px;">
                            คลิกที่นี่เพื่อเปิดดูข่าวสารนี้ใน CompanyChat ➔
                        </div>
                    </div>
                `;
            }

            const urlRegex = /(https?:\/\/[^\s]+)/g;
            const linked = escaped.replace(urlRegex, url => `<a href="${url}" target="_blank" rel="noopener noreferrer" class="chat-link">${url}</a>`);
            
            const editedHtml = isEdited ? '<span class="message-edited-badge">(แก้ไขแล้ว)</span>' : '';
            return linked + editedHtml + newsPreview;
        }

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
            
            // Check if current user is mentioned
            const textContent = data.message || '';
            const isMentioned = textContent.includes('@ทุกคน') || 
                                textContent.includes('@' + currentUserFirstName) || 
                                textContent.includes('@' + currentUserName);

            msgEl.className = `message-row ${isMe ? 'my-message' : 'other-message'} ${isMentioned ? 'is-mentioned' : ''}`;
            if (data.id) msgEl.setAttribute('data-message-id', data.id);

            const senderDisplay = data.user_display_name || (data.user_first_name 
                ? `${data.user_first_name} (${data.user_position || 'พนักงาน'})` 
                : (data.user_name ? `${data.user_name.split(' ')[0]} (${data.user_position || 'พนักงาน'})` : (isMe ? currentUserDisplayName : 'User')));

            const positionColor = data.user_position_color || (isMe ? currentUserPositionColor : getPositionColor(data.user_position));

            const firstName = data.user_first_name || (data.user_name ? data.user_name.split(' ')[0] : (isMe ? currentUserFirstName : 'U'));
            const initial = firstName.charAt(0).toUpperCase();
            const time = data.created_at || '';
            const avatarSrc = (isMe && currentUserAvatar) ? currentUserAvatar : (data.user_avatar || null);

            // Message Action Toolbar (Reactions / Reply / Edit / Delete)
            let actionsToolbarHtml = '';
            if (data.id) {
                const snippet = (data.message || (data.image ? 'รูปภาพ' : (data.file_name ? 'ไฟล์: ' + data.file_name : 'ข้อความ'))).substring(0, 50);
                actionsToolbarHtml = `
                    <div class="message-action-toolbar">
                        <div class="msg-reaction-picker">
                            <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax(${data.id}, '👍')" title="ถูกใจ">👍</button>
                            <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax(${data.id}, '❤️')" title="รักเลย">❤️</button>
                            <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax(${data.id}, '😂')" title="หัวเราะ">😂</button>
                            <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax(${data.id}, '🎉')" title="ยินดีด้วย">🎉</button>
                            <button type="button" class="btn-reaction-emoji" onclick="toggleReactionAjax(${data.id}, '🙏')" title="ขอบคุณ">🙏</button>
                        </div>
                        <button type="button" class="btn-msg-tool" onclick="setReplyMessage(${data.id}, '${escapeHtml(firstName)}', '${escapeHtml(snippet)}')" title="ตอบกลับข้อความนี้">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 17 4 12 9 7"></polyline><path d="M20 18v-2a4 4 0 0 0-4-4H4"></path></svg>
                            <span>ตอบกลับ</span>
                        </button>
                        ${isMe ? `<button type="button" class="btn-msg-tool" onclick="startEditMessage(${data.id}, this)" title="แก้ไขข้อความ"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg><span>แก้ไข</span></button>` : ''}
                        ${(isMe || isAdminUser) ? `<button type="button" class="btn-msg-tool danger" onclick="deleteMessageAjax(${data.id})" title="ลบข้อความ"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path><path d="M4 6h16"></path><path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path><line x1="10" y1="10" x2="10" y2="17"></line><line x1="14" y1="10" x2="14" y2="17"></line></svg><span>ลบ</span></button>` : ''}
                    </div>
                `;
            }

            const avatarHtml = `
                <div class="message-avatar-wrap">
                    ${avatarSrc 
                        ? `<img src="${avatarSrc}" class="chat-avatar-img" alt="${escapeHtml(senderDisplay)}">` 
                        : `<div class="chat-avatar-fallback">${escapeHtml(initial)}</div>`
                    }
                </div>
            `;

            const headerLineHtml = `
                <div class="message-header-line">
                    ${isMe ? `<span class="message-time">${escapeHtml(time)}</span><span class="message-sender-name" style="color: ${positionColor} !important;">${escapeHtml(senderDisplay)}</span>` 
                           : `<span class="message-sender-name" style="color: ${positionColor} !important;">${escapeHtml(senderDisplay)}</span><span class="message-time">${escapeHtml(time)}</span>`
                    }
                </div>
            `;

            let bubbleContent = '';
            if (data.reply_to) {
                const replySender = data.reply_to.user_first_name || (data.reply_to.user ? data.reply_to.user.resolved_first_name : (data.reply_to.user_name || 'User'));
                const replyText = (data.reply_to.message || (data.reply_to.image ? '📷 รูปภาพ' : (data.reply_to.file_name ? '📎 ไฟล์เอกสาร' : 'ข้อความ'))).substring(0, 80);
                bubbleContent += `
                    <div class="message-reply-quote" onclick="scrollToMessage(${data.reply_to.id})">
                        <div class="reply-quote-sender">↩ ${escapeHtml(replySender)}</div>
                        <div class="reply-quote-snippet">${escapeHtml(replyText)}</div>
                    </div>
                `;
            }
            if (data.image) {
                bubbleContent += `
                    <div class="message-image-wrap">
                        <img src="${data.image}" class="message-chat-image" onclick="openChatImage(this.src)" alt="รูปภาพแชต">
                    </div>
                `;
            }
            if (data.audio) {
                bubbleContent += `
                    <div class="message-audio-wrap">
                        <audio controls class="message-audio-player" preload="metadata" src="${data.audio}">
                            เบราว์เซอร์ของคุณไม่รองรับการเล่นเสียง
                        </audio>
                    </div>
                `;
            }
            if (data.file_data) {
                const ext = (data.file_name || '').split('.').pop().toLowerCase();
                let fIcon = '📁';
                if (ext === 'pdf') fIcon = '📄';
                else if (['xls', 'xlsx', 'csv'].includes(ext)) fIcon = '📊';
                else if (['doc', 'docx', 'txt'].includes(ext)) fIcon = '📝';
                else if (['zip', 'rar', '7z', 'tar', 'gz'].includes(ext)) fIcon = '🗜️';
                else if (['ppt', 'pptx'].includes(ext)) fIcon = '📑';

                const fSize = data.file_formatted_size || (data.file_size ? (data.file_size < 1048576 ? `${Math.round(data.file_size / 1024)} KB` : `${(data.file_size / 1048576).toFixed(1)} MB`) : 'เอกสาร');
                bubbleContent += `
                    <div class="chat-file-card">
                        <div class="chat-file-icon">${fIcon}</div>
                        <div class="chat-file-info">
                            <span class="chat-file-name" title="${escapeHtml(data.file_name)}">${escapeHtml(data.file_name)}</span>
                            <span class="chat-file-size">${escapeHtml(fSize)}</span>
                        </div>
                        <a href="${data.file_data}" download="${escapeHtml(data.file_name)}" class="chat-file-download-btn">
                            <span>📥 ดาวน์โหลด</span>
                        </a>
                    </div>
                `;
            }
            if (data.message && data.message.trim()) {
                bubbleContent += `<div class="message-text" id="msgText${data.id}">${formatChatMessage(data.message, data.is_edited)}</div>`;
            }

            let reactionsHtml = `<div class="message-reactions-row" id="reactionsRow${data.id}">`;
            if (data.reactions && Array.isArray(data.reactions)) {
                reactionsHtml += data.reactions.map(rx => {
                    const hasMe = (rx.user_ids && rx.user_ids.map(Number).includes(Number(currentUserId))) || rx.has_me;
                    const usersStr = (rx.users && Array.isArray(rx.users)) ? rx.users.join(', ') : '';
                    return `<button type="button" class="reaction-badge ${hasMe ? 'active' : ''}" onclick="toggleReactionAjax(${data.id}, '${rx.emoji}')" title="${escapeHtml(usersStr)}">
                        <span class="rx-emoji">${rx.emoji}</span>
                        <span class="rx-count">${rx.count}</span>
                    </button>`;
                }).join('');
            }
            reactionsHtml += `</div>`;

            const contentWrapHtml = `
                <div class="message-content-wrap">
                    ${headerLineHtml}
                    <div class="message-bubble">${bubbleContent}</div>
                    ${reactionsHtml}
                </div>
            `;

            if (isMe) {
                msgEl.innerHTML = actionsToolbarHtml + contentWrapHtml + avatarHtml;
            } else {
                msgEl.innerHTML = actionsToolbarHtml + avatarHtml + contentWrapHtml;
            }

            chatContainer.appendChild(msgEl);
            scrollToBottom();
        }

        // ==========================================
        // LEVEL 1: DOCUMENT ATTACHMENT HANDLERS
        // ==========================================
        window.handleChatDocumentSelect = function(event) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;

            if (file.size > 20 * 1024 * 1024) {
                alert('ขนาดไฟล์เอกสารเกิน 20MB กรุณาเลือกไฟล์ที่มีขนาดไม่เกิน 20MB');
                event.target.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const chatFileData = document.getElementById('chatFileData');
                const chatFileName = document.getElementById('chatFileName');
                const chatFileSize = document.getElementById('chatFileSize');
                const chatFileType = document.getElementById('chatFileType');
                const docPreviewName = document.getElementById('docPreviewName');
                const docPreviewSubtitle = document.getElementById('docPreviewSubtitle');
                const docPreviewIcon = document.getElementById('docPreviewIcon');
                const documentPreviewItem = document.getElementById('documentPreviewItem');
                const chatMediaPreview = document.getElementById('chatMediaPreview');

                if (chatFileData) chatFileData.value = e.target.result;
                if (chatFileName) chatFileName.value = file.name;
                if (chatFileSize) chatFileSize.value = file.size;
                if (chatFileType) chatFileType.value = file.type || '';

                const ext = file.name.split('.').pop().toLowerCase();
                let icon = '📁';
                if (ext === 'pdf') icon = '📄';
                else if (['xls', 'xlsx', 'csv'].includes(ext)) icon = '📊';
                else if (['doc', 'docx', 'txt'].includes(ext)) icon = '📝';
                else if (['zip', 'rar', '7z'].includes(ext)) icon = '🗜️';
                else if (['ppt', 'pptx'].includes(ext)) icon = '📑';

                if (docPreviewIcon) docPreviewIcon.textContent = icon;
                if (docPreviewName) docPreviewName.textContent = file.name;
                if (docPreviewSubtitle) {
                    const sz = file.size < 1048576 ? `${Math.round(file.size / 1024)} KB` : `${(file.size / 1048576).toFixed(1)} MB`;
                    docPreviewSubtitle.textContent = `ขนาด ${sz}`;
                }

                if (documentPreviewItem) documentPreviewItem.style.display = 'flex';
                if (chatMediaPreview) chatMediaPreview.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        };

        window.removeAttachedDocument = function() {
            const chatFileData = document.getElementById('chatFileData');
            const chatFileName = document.getElementById('chatFileName');
            const chatFileSize = document.getElementById('chatFileSize');
            const chatFileType = document.getElementById('chatFileType');
            const chatDocumentInput = document.getElementById('chatDocumentInput');
            const documentPreviewItem = document.getElementById('documentPreviewItem');
            const chatMediaPreview = document.getElementById('chatMediaPreview');
            const imagePreviewItem = document.getElementById('imagePreviewItem');
            const voicePreviewItem = document.getElementById('voicePreviewItem');

            if (chatFileData) chatFileData.value = '';
            if (chatFileName) chatFileName.value = '';
            if (chatFileSize) chatFileSize.value = '';
            if (chatFileType) chatFileType.value = '';
            if (chatDocumentInput) chatDocumentInput.value = '';
            if (documentPreviewItem) documentPreviewItem.style.display = 'none';

            const hasImage = imagePreviewItem && imagePreviewItem.style.display !== 'none';
            const hasVoice = voicePreviewItem && voicePreviewItem.style.display !== 'none';
            if (chatMediaPreview && !hasImage && !hasVoice) {
                chatMediaPreview.style.display = 'none';
            }
        };

        // ==========================================
        // LEVEL 1: @MENTION AUTOCOMPLETE SYSTEM
        // ==========================================
        const mentionPopup = document.getElementById('mentionAutocomplete');
        let mentionSelectedIndex = 0;
        let mentionActiveMatches = [];

        window.closeMentionPopup = function() {
            if (mentionPopup) {
                mentionPopup.style.display = 'none';
                mentionPopup.innerHTML = '';
                mentionActiveMatches = [];
                mentionSelectedIndex = 0;
            }
        };

        window.insertMention = function(name) {
            if (!messageInput) return;
            const val = messageInput.value;
            const caret = messageInput.selectionStart;
            const lastAt = val.lastIndexOf('@', caret - 1);
            if (lastAt !== -1) {
                const before = val.substring(0, lastAt);
                const after = val.substring(caret);
                messageInput.value = `${before}@${name} ${after}`;
                const nextCaret = before.length + name.length + 2;
                messageInput.setSelectionRange(nextCaret, nextCaret);
            }
            window.closeMentionPopup();
            messageInput.focus();
        };

        if (messageInput) {
            messageInput.addEventListener('input', () => {
                const val = messageInput.value;
                const caret = messageInput.selectionStart;
                const lastAt = val.lastIndexOf('@', caret - 1);

                if (lastAt !== -1 && (lastAt === 0 || /\s/.test(val[lastAt - 1]))) {
                    const query = val.substring(lastAt + 1, caret).toLowerCase().trim();
                    
                    mentionActiveMatches = [];
                    if ('ทุกคน'.includes(query) || query === '') {
                        mentionActiveMatches.push({ name: 'ทุกคน', first_name: 'ทุกคน', position: 'สมาชิกทุกคนในห้อง', isAll: true });
                    }
                    mentionUsersList.forEach(u => {
                        if (u.id === currentUserId) return;
                        if (u.name.toLowerCase().includes(query) || u.first_name.toLowerCase().includes(query)) {
                            mentionActiveMatches.push(u);
                        }
                    });

                    if (mentionActiveMatches.length > 0) {
                        mentionSelectedIndex = 0;
                        renderMentionPopup();
                        mentionPopup.style.display = 'block';
                    } else {
                        window.closeMentionPopup();
                    }
                } else {
                    window.closeMentionPopup();
                }
            });

            messageInput.addEventListener('keydown', (e) => {
                if (!mentionPopup || mentionPopup.style.display === 'none' || mentionActiveMatches.length === 0) return;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    mentionSelectedIndex = (mentionSelectedIndex + 1) % mentionActiveMatches.length;
                    renderMentionPopup();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    mentionSelectedIndex = (mentionSelectedIndex - 1 + mentionActiveMatches.length) % mentionActiveMatches.length;
                    renderMentionPopup();
                } else if (e.key === 'Enter' || e.key === 'Tab') {
                    e.preventDefault();
                    const selected = mentionActiveMatches[mentionSelectedIndex];
                    if (selected) {
                        window.insertMention(selected.first_name || selected.name);
                    }
                } else if (e.key === 'Escape') {
                    window.closeMentionPopup();
                }
            });
        }

        function renderMentionPopup() {
            if (!mentionPopup) return;
            let html = '';
            mentionActiveMatches.forEach((item, idx) => {
                const isSel = idx === mentionSelectedIndex;
                const isAll = item.isAll;
                const avatarHtml = isAll 
                    ? `<div class="mention-item-fallback" style="background: linear-gradient(135deg, #f59e0b, #ef4444);">📢</div>`
                    : (item.avatar ? `<img src="${item.avatar}" class="mention-item-avatar">` : `<div class="mention-item-fallback" style="background: ${item.position_color || '#3b82f6'};">${item.first_name.charAt(0).toUpperCase()}</div>`);

                html += `
                    <div class="mention-item ${isSel ? 'selected' : ''}" onmousedown="window.insertMention('${escapeHtml(item.first_name || item.name)}')">
                        ${avatarHtml}
                        <div style="flex: 1; min-width: 0;">
                            <span style="font-weight: 600; font-size: 13px;">@${escapeHtml(item.first_name || item.name)}</span>
                            <span style="font-size: 11px; color: var(--text-muted); margin-left: 6px;">${escapeHtml(item.position || '')}</span>
                        </div>
                    </div>
                `;
            });
            mentionPopup.innerHTML = html;
        }

        // Close mention popup if clicking outside
        document.addEventListener('click', (e) => {
            if (mentionPopup && !mentionPopup.contains(e.target) && e.target !== messageInput) {
                window.closeMentionPopup();
            }
        });

        // ==========================================
        // LEVEL 1: EDIT & DELETE MESSAGE HANDLERS
        // ==========================================
        window.startEditMessage = function(msgId, btn) {
            const row = document.querySelector(`.message-row[data-message-id="${msgId}"]`);
            if (!row) return;
            const msgTextEl = row.querySelector('.message-text');
            if (!msgTextEl) return;

            if (msgTextEl.querySelector('.msg-edit-box')) return;

            const clone = msgTextEl.cloneNode(true);
            clone.querySelectorAll('.chat-news-card, .message-edited-badge, .chat-file-card').forEach(e => e.remove());
            const rawText = clone.textContent.trim();

            msgTextEl.setAttribute('data-original-html', msgTextEl.innerHTML);
            msgTextEl.innerHTML = `
                <div class="msg-edit-box">
                    <textarea class="msg-edit-textarea" rows="2" id="editInput${msgId}">${escapeHtml(rawText)}</textarea>
                    <div class="msg-edit-btn-row">
                        <button type="button" class="btn-cancel-edit" onclick="cancelEditMessage(${msgId})">ยกเลิก</button>
                        <button type="button" class="btn-save-edit" onclick="saveEditMessage(${msgId})">บันทึก</button>
                    </div>
                </div>
            `;
            const ta = document.getElementById(`editInput${msgId}`);
            if (ta) {
                ta.focus();
                ta.setSelectionRange(ta.value.length, ta.value.length);
            }
        };

        window.cancelEditMessage = function(msgId) {
            const row = document.querySelector(`.message-row[data-message-id="${msgId}"]`);
            if (!row) return;
            const msgTextEl = row.querySelector('.message-text');
            if (!msgTextEl) return;
            const orig = msgTextEl.getAttribute('data-original-html');
            if (orig) {
                msgTextEl.innerHTML = orig;
            }
        };

        window.saveEditMessage = async function(msgId) {
            const ta = document.getElementById(`editInput${msgId}`);
            if (!ta) return;
            const newText = ta.value.trim();
            if (!newText) {
                alert('ข้อความไม่สามารถเว้นว่างได้');
                return;
            }

            try {
                const res = await fetch(`/messages/${msgId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: newText })
                });

                if (res.ok) {
                    const json = await res.json();
                    if (json.success) {
                        const row = document.querySelector(`.message-row[data-message-id="${msgId}"]`);
                        if (row) {
                            const msgTextEl = row.querySelector('.message-text');
                            if (msgTextEl) {
                                msgTextEl.innerHTML = formatChatMessage(newText, true);
                            }
                        }
                    }
                } else {
                    alert('ไม่สามารถแก้ไขข้อความได้');
                }
            } catch (err) {
                alert('เกิดข้อผิดพลาดในการแก้ไข: ' + err.message);
            }
        };

        window.deleteMessageAjax = async function(msgId) {
            if (!confirm('ต้องการลบข้อความนี้ใช่หรือไม่?')) return;

            try {
                const res = await fetch(`/messages/${msgId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (res.ok) {
                    const row = document.querySelector(`.message-row[data-message-id="${msgId}"]`);
                    if (row) {
                        row.style.transition = 'opacity 0.25s, transform 0.25s';
                        row.style.opacity = '0';
                        row.style.transform = 'scale(0.95)';
                        setTimeout(() => row.remove(), 260);
                    }
                } else {
                    alert('ไม่สามารถลบข้อความได้');
                }
            } catch (err) {
                alert('เกิดข้อผิดพลาดในการลบ: ' + err.message);
            }
        };

        // Avatar Upload Handlers with Automatic Canvas Resizing
        window.handleAvatarFileSelect = function(event) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;

            // Also attach to form input for native multipart fallback
            try {
                const dt = new DataTransfer();
                dt.items.add(file);
                const formInput = document.getElementById('avatarFormFileInput');
                if (formInput) formInput.files = dt.files;
            } catch(e) {}

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    // Resize to 300x300 square center-crop
                    const canvas = document.createElement('canvas');
                    const size = 300;
                    canvas.width = size;
                    canvas.height = size;
                    const ctx = canvas.getContext('2d');

                    const minDim = Math.min(img.width, img.height);
                    const sx = (img.width - minDim) / 2;
                    const sy = (img.height - minDim) / 2;

                    ctx.drawImage(img, sx, sy, minDim, minDim, 0, 0, size, size);

                    const compressedDataUrl = canvas.toDataURL('image/jpeg', 0.88);
                    const preview = document.getElementById('settingsAvatarPreview');
                    const fallback = document.getElementById('settingsAvatarFallback');
                    const dataInput = document.getElementById('avatarDataInput');
                    const removeInput = document.getElementById('removeAvatarInput');
                    const removeBtn = document.getElementById('btnRemoveAvatar');

                    if (preview) {
                        preview.src = compressedDataUrl;
                        preview.style.display = 'block';
                    }
                    if (fallback) {
                        fallback.style.display = 'none';
                    }
                    if (dataInput) dataInput.value = compressedDataUrl;
                    if (removeInput) removeInput.value = '0';
                    if (removeBtn) removeBtn.style.display = 'inline-flex';
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        };

        window.removeAvatarPhoto = function() {
            const dataInput = document.getElementById('avatarDataInput');
            const removeInput = document.getElementById('removeAvatarInput');
            const fileInput = document.getElementById('avatarFileInput');
            const formInput = document.getElementById('avatarFormFileInput');
            const preview = document.getElementById('settingsAvatarPreview');
            const fallback = document.getElementById('settingsAvatarFallback');
            const removeBtn = document.getElementById('btnRemoveAvatar');

            if (dataInput) dataInput.value = '';
            if (removeInput) removeInput.value = '1';
            if (fileInput) fileInput.value = '';
            if (formInput) formInput.value = '';
            if (preview) preview.style.display = 'none';
            if (fallback) fallback.style.display = 'flex';
            if (removeBtn) removeBtn.style.display = 'none';
        };

        // Chat Image Handlers
        window.handleChatImageSelect = function(event) {
            const file = event.target.files && event.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('กรุณาเลือกไฟล์รูปภาพเท่านั้น');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    let width = img.width;
                    let height = img.height;
                    const maxDim = 1200;

                    if (width > maxDim || height > maxDim) {
                        if (width > height) {
                            height = Math.round((height * maxDim) / width);
                            width = maxDim;
                        } else {
                            width = Math.round((width * maxDim) / height);
                            height = maxDim;
                        }
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    const compressedDataUrl = canvas.toDataURL('image/jpeg', 0.82);
                    window.setAttachedImage(compressedDataUrl);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        };

        window.setAttachedImage = function(dataUrl) {
            const chatImageData = document.getElementById('chatImageData');
            const imagePreviewThumb = document.getElementById('imagePreviewThumb');
            const imagePreviewItem = document.getElementById('imagePreviewItem');
            const chatMediaPreview = document.getElementById('chatMediaPreview');

            if (chatImageData) chatImageData.value = dataUrl;
            if (imagePreviewThumb) imagePreviewThumb.src = dataUrl;
            if (imagePreviewItem) imagePreviewItem.style.display = 'flex';
            if (chatMediaPreview) chatMediaPreview.style.display = 'flex';
        };

        window.removeAttachedImage = function() {
            const chatImageData = document.getElementById('chatImageData');
            const chatFileInput = document.getElementById('chatFileInput');
            const imagePreviewThumb = document.getElementById('imagePreviewThumb');
            const imagePreviewItem = document.getElementById('imagePreviewItem');
            const chatMediaPreview = document.getElementById('chatMediaPreview');
            const voicePreviewItem = document.getElementById('voicePreviewItem');

            if (chatImageData) chatImageData.value = '';
            if (chatFileInput) chatFileInput.value = '';
            if (imagePreviewThumb) imagePreviewThumb.src = '';
            if (imagePreviewItem) imagePreviewItem.style.display = 'none';

            if (chatMediaPreview && (!voicePreviewItem || voicePreviewItem.style.display === 'none')) {
                chatMediaPreview.style.display = 'none';
            }
        };

        // Chat Image Modal View Handlers
        window.openChatImage = function(src) {
            if (!src || src === 'about:blank' || src === 'null' || src === 'undefined') {
                alert('ไม่พบรูปภาพหรือลิงก์รูปภาพไม่ถูกต้อง');
                return;
            }

            const modal = document.getElementById('chatImageModal');
            const imgEl = document.getElementById('chatModalImage');
            const errorEl = document.getElementById('chatModalImageError');
            const loaderEl = document.getElementById('chatModalImageLoader');
            const downloadBtn = document.getElementById('chatModalDownloadBtn');
            const newTabBtn = document.getElementById('chatModalNewTabBtn');

            if (!modal || !imgEl) return;

            // Reset states
            if (errorEl) errorEl.style.display = 'none';
            if (loaderEl) loaderEl.style.display = 'flex';
            imgEl.style.display = 'none';
            imgEl.src = '';

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';

            imgEl.onload = function() {
                if (loaderEl) loaderEl.style.display = 'none';
                imgEl.style.display = 'block';
            };

            imgEl.onerror = function() {
                if (loaderEl) loaderEl.style.display = 'none';
                imgEl.style.display = 'none';
                if (errorEl) errorEl.style.display = 'flex';
            };

            imgEl.src = src;

            if (newTabBtn) {
                newTabBtn.onclick = function(e) {
                    e.stopPropagation();
                    window.openImageInNewTab(src);
                };
            }

            if (downloadBtn) {
                downloadBtn.onclick = function(e) {
                    e.stopPropagation();
                    window.downloadChatImage(src);
                };
            }
        };

        window.closeChatImage = function() {
            const modal = document.getElementById('chatImageModal');
            const imgEl = document.getElementById('chatModalImage');
            if (modal) modal.style.display = 'none';
            if (imgEl) imgEl.src = '';
            document.body.style.overflow = '';
        };

        window.openImageInNewTab = function(src) {
            if (!src || src === 'about:blank') {
                alert('ไม่พบรูปภาพที่ต้องการเปิด');
                return;
            }

            if (src.startsWith('data:')) {
                try {
                    const arr = src.split(',');
                    const mimeMatch = arr[0].match(/:(.*?);/);
                    const mime = mimeMatch ? mimeMatch[1] : 'image/jpeg';
                    const bstr = atob(arr[1]);
                    let n = bstr.length;
                    const u8arr = new Uint8Array(n);
                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }
                    const blob = new Blob([u8arr], { type: mime });
                    const blobUrl = URL.createObjectURL(blob);
                    const win = window.open(blobUrl, '_blank');
                    if (!win) {
                        alert('เบราว์เซอร์บล็อกหน้าต่างใหม่ กรุณาอนุญาตป๊อปอัป');
                    }
                } catch (e) {
                    console.error('Error creating Blob URL for image:', e);
                    const win = window.open('', '_blank');
                    if (win) {
                        win.document.write('<!DOCTYPE html><html><head><title>ดูรูปภาพ</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><style>body{margin:0;background:#0b0f19;display:flex;align-items:center;justify-content:center;min-height:100vh;}img{max-width:100%;max-height:100vh;object-fit:contain;}</style></head><body><img src="' + src + '"></body></html>');
                        win.document.close();
                    }
                }
            } else {
                const win = window.open(src, '_blank');
                if (!win) {
                    alert('เบราว์เซอร์บล็อกหน้าต่างใหม่ กรุณาอนุญาตป๊อปอัป');
                }
            }
        };

        window.downloadChatImage = function(src) {
            if (!src) return;
            try {
                const a = document.createElement('a');
                a.href = src;
                a.download = `chat-image-${Date.now()}.jpg`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            } catch (e) {
                console.error('Download error:', e);
            }
        };

        // Modal backdrop and ESC key listener for Chat Image
        document.getElementById('chatImageModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'chatImageModal' || e.target.classList.contains('chat-image-modal-backdrop')) {
                window.closeChatImage();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const modal = document.getElementById('chatImageModal');
                if (modal && modal.style.display === 'flex') {
                    window.closeChatImage();
                }
            }
        });

        // Voice Message Recording Handlers (Cross-browser & Robust)
        let mediaRecorder = null;
        let audioChunks = [];
        let voiceRecordingTimer = null;
        let recordingSeconds = 0;
        let isVoiceRecording = false;
        let audioStream = null;
        let stopRecordingPromiseResolve = null;

        function getSupportedMimeType() {
            if (typeof MediaRecorder === 'undefined') return '';
            const types = [
                'audio/webm;codecs=opus',
                'audio/webm',
                'audio/mp4',
                'audio/aac',
                'audio/ogg;codecs=opus',
                'audio/wav'
            ];
            for (const t of types) {
                if (MediaRecorder.isTypeSupported && MediaRecorder.isTypeSupported(t)) {
                    return t;
                }
            }
            return '';
        }

        function blobToBase64(blob) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onloadend = () => resolve(reader.result);
                reader.onerror = reject;
                reader.readAsDataURL(blob);
            });
        }

        window.toggleVoiceRecording = async function() {
            if (isVoiceRecording) {
                await window.stopVoiceRecording();
            } else {
                await window.startVoiceRecording();
            }
        };

        window.startVoiceRecording = async function() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('เบราว์เซอร์ของคุณไม่รองรับการบันทึกเสียง หรือต้องเปิดใช้งานผ่าน HTTPS');
                return;
            }

            try {
                audioStream = await navigator.mediaDevices.getUserMedia({
                    audio: {
                        echoCancellation: true,
                        noiseSuppression: true,
                        autoGainControl: true
                    }
                });
            } catch (err) {
                console.error('Microphone permission error:', err);
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    alert('คุณไม่อนุญาตให้ใช้งานไมโครโฟน กรุณาอนุญาตสิทธิ์ไมโครโฟนในการตั้งค่าเบราว์เซอร์');
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    alert('ไม่พบอุปกรณ์ไมโครโฟนบนอุปกรณ์นี้ กรุณาเชื่อมต่อไมโครโฟน');
                } else {
                    alert('ไม่สามารถเข้าถึงไมโครโฟนได้: ' + (err.message || 'ข้อผิดพลาดไม่ทราบสาเหตุ'));
                }
                return;
            }

            audioChunks = [];
            recordingSeconds = 0;
            const mimeType = getSupportedMimeType();
            const options = mimeType ? { mimeType } : {};

            try {
                mediaRecorder = new MediaRecorder(audioStream, options);
            } catch (e) {
                try {
                    mediaRecorder = new MediaRecorder(audioStream);
                } catch (e2) {
                    console.error('Cannot create MediaRecorder:', e2);
                    alert('อุปกรณ์หรือเบราว์เซอร์นี้ไม่รองรับการบันทึกเสียง');
                    return;
                }
            }

            mediaRecorder.ondataavailable = (e) => {
                if (e.data && e.data.size > 0) {
                    audioChunks.push(e.data);
                }
            };

            mediaRecorder.onstop = async () => {
                try {
                    const actualMime = (mediaRecorder && mediaRecorder.mimeType) || mimeType || 'audio/webm';
                    const audioBlob = new Blob(audioChunks, { type: actualMime });

                    if (audioBlob.size < 200) {
                        alert('ไม่พบข้อมูลเสียงที่บันทึก กรุณาตรวจสอบไมโครโฟนและลองบันทึกใหม่อีกครั้ง');
                        window.removeAttachedVoice();
                        if (stopRecordingPromiseResolve) {
                            stopRecordingPromiseResolve();
                            stopRecordingPromiseResolve = null;
                        }
                        return;
                    }

                    // Create Blob URL for instant audio testing in preview
                    const blobUrl = URL.createObjectURL(audioBlob);
                    const voicePreviewAudio = document.getElementById('voicePreviewAudio');
                    const voiceRecordingStatus = document.getElementById('voiceRecordingStatus');
                    const voicePlaybackWrap = document.getElementById('voicePlaybackWrap');
                    const chatAudioDuration = document.getElementById('chatAudioDuration');
                    const chatAudioData = document.getElementById('chatAudioData');

                    if (voicePreviewAudio) {
                        voicePreviewAudio.src = blobUrl;
                        voicePreviewAudio.load(); // Required for Safari / iOS
                    }
                    if (chatAudioDuration) {
                        chatAudioDuration.value = Math.max(1, recordingSeconds);
                    }
                    if (voiceRecordingStatus) voiceRecordingStatus.style.display = 'none';
                    if (voicePlaybackWrap) voicePlaybackWrap.style.display = 'flex';

                    // Convert to Base64 data URL for sending
                    const base64Audio = await blobToBase64(audioBlob);
                    if (chatAudioData) {
                        chatAudioData.value = base64Audio;
                    }
                } catch (err) {
                    console.error('Error in mediaRecorder onstop:', err);
                    alert('เกิดข้อผิดพลาดในการประมวลผลไฟล์เสียง');
                } finally {
                    if (audioStream) {
                        audioStream.getTracks().forEach(track => track.stop());
                        audioStream = null;
                    }
                    if (stopRecordingPromiseResolve) {
                        stopRecordingPromiseResolve();
                        stopRecordingPromiseResolve = null;
                    }
                }
            };

            mediaRecorder.start(100); // 100ms time slice for continuous data emission
            isVoiceRecording = true;

            const recordBtn = document.getElementById('recordVoiceBtn');
            if (recordBtn) recordBtn.classList.add('active-recording');

            const chatMediaPreview = document.getElementById('chatMediaPreview');
            const voicePreviewItem = document.getElementById('voicePreviewItem');
            const voiceRecordingStatus = document.getElementById('voiceRecordingStatus');
            const voicePlaybackWrap = document.getElementById('voicePlaybackWrap');
            const timerText = document.getElementById('recordingTimerText');

            if (chatMediaPreview) chatMediaPreview.style.display = 'flex';
            if (voicePreviewItem) voicePreviewItem.style.display = 'flex';
            if (voiceRecordingStatus) voiceRecordingStatus.style.display = 'flex';
            if (voicePlaybackWrap) voicePlaybackWrap.style.display = 'none';

            if (timerText) timerText.textContent = '00:00';

            if (voiceRecordingTimer) clearInterval(voiceRecordingTimer);
            voiceRecordingTimer = setInterval(() => {
                recordingSeconds++;
                const mins = String(Math.floor(recordingSeconds / 60)).padStart(2, '0');
                const secs = String(recordingSeconds % 60).padStart(2, '0');
                if (timerText) {
                    timerText.textContent = `${mins}:${secs}`;
                }
                if (recordingSeconds >= 300) {
                    window.stopVoiceRecording();
                }
            }, 1000);
        };

        window.stopVoiceRecording = function() {
            if (voiceRecordingTimer) {
                clearInterval(voiceRecordingTimer);
                voiceRecordingTimer = null;
            }

            const recordBtn = document.getElementById('recordVoiceBtn');
            if (recordBtn) recordBtn.classList.remove('active-recording');

            if (!isVoiceRecording || !mediaRecorder) {
                return Promise.resolve();
            }

            return new Promise((resolve) => {
                isVoiceRecording = false;
                stopRecordingPromiseResolve = resolve;

                if (mediaRecorder.state !== 'inactive') {
                    try {
                        // Request any remaining buffered data
                        mediaRecorder.requestData();
                    } catch (e) {}
                    mediaRecorder.stop();
                } else {
                    resolve();
                }
            });
        };

        window.stopVoiceRecordingPromise = function() {
            return window.stopVoiceRecording();
        };

        window.removeAttachedVoice = function() {
            if (voiceRecordingTimer) {
                clearInterval(voiceRecordingTimer);
                voiceRecordingTimer = null;
            }
            isVoiceRecording = false;

            const recordBtn = document.getElementById('recordVoiceBtn');
            if (recordBtn) recordBtn.classList.remove('active-recording');

            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                try { mediaRecorder.stop(); } catch(e) {}
            }
            if (audioStream) {
                audioStream.getTracks().forEach(track => track.stop());
                audioStream = null;
            }
            stopRecordingPromiseResolve = null;

            const chatAudioData = document.getElementById('chatAudioData');
            const chatAudioDuration = document.getElementById('chatAudioDuration');
            const voicePreviewAudio = document.getElementById('voicePreviewAudio');
            const voicePreviewItem = document.getElementById('voicePreviewItem');
            const voicePlaybackWrap = document.getElementById('voicePlaybackWrap');
            const voiceRecordingStatus = document.getElementById('voiceRecordingStatus');
            const chatMediaPreview = document.getElementById('chatMediaPreview');
            const imagePreviewItem = document.getElementById('imagePreviewItem');

            if (chatAudioData) chatAudioData.value = '';
            if (chatAudioDuration) chatAudioDuration.value = '';
            if (voicePreviewAudio) {
                voicePreviewAudio.pause();
                voicePreviewAudio.removeAttribute('src');
                voicePreviewAudio.load();
            }
            if (voiceRecordingStatus) voiceRecordingStatus.style.display = 'none';
            if (voicePlaybackWrap) voicePlaybackWrap.style.display = 'none';
            if (voicePreviewItem) voicePreviewItem.style.display = 'none';

            if (chatMediaPreview && (!imagePreviewItem || imagePreviewItem.style.display === 'none')) {
                chatMediaPreview.style.display = 'none';
            }
        };

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Draft Auto-Save
        const draftKey = `company_chat_draft_${currentRoomId}`;
        if (messageInput && currentRoomId) {
            const savedDraft = localStorage.getItem(draftKey);
            if (savedDraft) {
                messageInput.value = savedDraft;
            }

            messageInput.addEventListener('input', () => {
                if (messageInput.value.trim()) {
                    localStorage.setItem(draftKey, messageInput.value);
                } else {
                    localStorage.removeItem(draftKey);
                }
            });
        }

        if (chatForm && messageInput) {
            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (isVoiceRecording) {
                    await window.stopVoiceRecordingPromise();
                }

                const chatImageData = document.getElementById('chatImageData');
                const chatAudioData = document.getElementById('chatAudioData');
                const chatAudioDuration = document.getElementById('chatAudioDuration');
                const chatFileData = document.getElementById('chatFileData');
                const chatFileName = document.getElementById('chatFileName');
                const chatFileSize = document.getElementById('chatFileSize');
                const chatFileType = document.getElementById('chatFileType');
                const replyToIdInput = document.getElementById('replyToIdInput');

                const text = messageInput.value.trim();
                const image = chatImageData ? chatImageData.value : '';
                const audio = chatAudioData ? chatAudioData.value : '';
                const audioDuration = chatAudioDuration ? (parseInt(chatAudioDuration.value, 10) || null) : null;
                const fileData = chatFileData ? chatFileData.value : '';
                const fileName = chatFileName ? chatFileName.value : '';
                const fileSize = chatFileSize ? (parseInt(chatFileSize.value, 10) || null) : null;
                const fileType = chatFileType ? chatFileType.value : '';
                const replyToId = replyToIdInput ? replyToIdInput.value : '';

                if (!text && !image && !audio && !fileData) {
                    messageInput.focus();
                    return;
                }
                if (!currentRoomId) return;

                const sendBtn = document.getElementById('sendBtn');
                if (sendBtn) sendBtn.disabled = true;

                const oldText = text;
                const oldImage = image;
                const oldAudio = audio;
                const oldAudioDuration = audioDuration;
                const oldFileData = fileData;
                const oldFileName = fileName;
                const oldFileSize = fileSize;
                const oldFileType = fileType;
                const oldReplyToId = replyToId;

                messageInput.value = '';
                window.removeAttachedImage();
                window.removeAttachedVoice();
                window.removeAttachedDocument();
                window.cancelReplyMessage();

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
                            message: oldText || null,
                            image: oldImage || null,
                            audio: oldAudio || null,
                            audio_duration: oldAudioDuration,
                            file_data: oldFileData || null,
                            file_name: oldFileName || null,
                            file_size: oldFileSize || null,
                            file_type: oldFileType || null,
                            reply_to_id: oldReplyToId ? (parseInt(oldReplyToId, 10) || null) : null
                        })
                    });

                    if (res.ok) {
                        const json = await res.json();
                        if (json.success && json.message) {
                            localStorage.removeItem(draftKey);
                            appendMessage(json.message);
                        }
                    } else {
                        const err = await res.text();
                        console.error('Send error:', err);
                        messageInput.value = oldText;
                        if (oldImage) window.setAttachedImage(oldImage);
                        if (oldReplyToId) {
                            const replyToInput = document.getElementById('replyToIdInput');
                            if (replyToInput) replyToInput.value = oldReplyToId;
                        }
                        alert('ไม่สามารถส่งข้อความได้ กรุณาลองใหม่อีกครั้ง');
                    }
                } catch (err) {
                    console.error('Fetch error:', err);
                    messageInput.value = oldText;
                    if (oldImage) window.setAttachedImage(oldImage);
                    alert('เกิดข้อผิดพลาดในการเชื่อมต่อ: ' + (err.message || err));
                } finally {
                    if (sendBtn) sendBtn.disabled = false;
                    messageInput.focus();
                }
            });
        }

        // ==========================================
        // CHAT EXPERIENCE 1: REPLY / QUOTE MESSAGE
        // ==========================================
        window.setReplyMessage = function(msgId, senderName, snippet) {
            const replyPreview = document.getElementById('chatReplyPreview');
            const replyToIdInput = document.getElementById('replyToIdInput');
            const senderEl = document.getElementById('replyPreviewSender');
            const textEl = document.getElementById('replyPreviewText');
            const messageInput = document.getElementById('messageInput');

            if (replyPreview && replyToIdInput) {
                replyToIdInput.value = msgId;
                if (senderEl) senderEl.textContent = senderName || 'เพื่อนร่วมงาน';
                if (textEl) textEl.textContent = snippet || 'ข้อความ';
                replyPreview.style.display = 'flex';
                if (messageInput) {
                    messageInput.focus();
                }
            }
        };

        window.cancelReplyMessage = function() {
            const replyPreview = document.getElementById('chatReplyPreview');
            const replyToIdInput = document.getElementById('replyToIdInput');
            if (replyToIdInput) replyToIdInput.value = '';
            if (replyPreview) replyPreview.style.display = 'none';
        };

        window.scrollToMessage = function(msgId) {
            const el = document.querySelector(`.message-row[data-message-id="${msgId}"]`);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.classList.add('flash-target');
                setTimeout(() => el.classList.remove('flash-target'), 2000);
            }
        };

        // ==========================================
        // CHAT EXPERIENCE 2: EMOJI REACTIONS
        // ==========================================
        window.toggleReactionAjax = async function(messageId, emoji) {
            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                              '{{ csrf_token() }}';
                const res = await fetch(`/messages/${messageId}/reactions`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ emoji: emoji })
                });
                const data = await res.json();
                if (data.success && data.reactions) {
                    window.renderReactionsRow(messageId, data.reactions);
                }
            } catch (err) {
                console.error('Reaction toggle error:', err);
            }
        };

        window.renderReactionsRow = function(messageId, reactions) {
            const row = document.getElementById(`reactionsRow${messageId}`);
            if (!row) return;
            if (!reactions || !Array.isArray(reactions) || reactions.length === 0) {
                row.innerHTML = '';
                return;
            }
            const currentUserIdNum = Number(currentUserId);
            row.innerHTML = reactions.map(rx => {
                const hasMe = (rx.user_ids && rx.user_ids.map(Number).includes(currentUserIdNum)) || rx.has_me;
                const usersStr = (rx.users && Array.isArray(rx.users)) ? rx.users.join(', ') : '';
                return `<button type="button" class="reaction-badge ${hasMe ? 'active' : ''}" onclick="toggleReactionAjax(${messageId}, '${rx.emoji}')" title="${escapeHtml(usersStr)}">
                    <span class="rx-emoji">${rx.emoji}</span>
                    <span class="rx-count">${rx.count}</span>
                </button>`;
            }).join('');
        };

        window.handleReactionUpdatedRealtime = function(data) {
            if (!data || !data.message_id) return;
            window.renderReactionsRow(data.message_id, data.reactions);
        };

        // ==========================================
        // GROUP CHAT: CREATE ROOM PRIVACY & MEMBERS
        // ==========================================
        window.toggleCreateRoomPrivacy = function(isPrivate) {
            const membersBox = document.getElementById('createRoomMembersBox');
            if (membersBox) {
                membersBox.style.display = isPrivate ? 'block' : 'none';
            }
            const publicLabel = document.getElementById('roomTypePublicLabel');
            const privateLabel = document.getElementById('roomTypePrivateLabel');
            if (isPrivate) {
                if (privateLabel) {
                    privateLabel.style.border = '1.5px solid #3b82f6';
                    privateLabel.style.background = 'rgba(59, 130, 246, 0.08)';
                }
                if (publicLabel) {
                    publicLabel.style.border = '1px solid var(--border-color)';
                    publicLabel.style.background = 'var(--bg-surface)';
                }
            } else {
                if (publicLabel) {
                    publicLabel.style.border = '1.5px solid #3b82f6';
                    publicLabel.style.background = 'rgba(59, 130, 246, 0.08)';
                }
                if (privateLabel) {
                    privateLabel.style.border = '1px solid var(--border-color)';
                    privateLabel.style.background = 'var(--bg-surface)';
                }
            }
        };

        window.filterCreateRoomMembers = function(query) {
            const q = (query || '').toLowerCase().trim();
            document.querySelectorAll('#createRoomMemberList .create-member-item').forEach(el => {
                const name = el.getAttribute('data-name') || '';
                const pos = el.getAttribute('data-pos') || '';
                el.style.display = (name.includes(q) || pos.includes(q)) ? 'flex' : 'none';
            });
        };

        window.updateSelectedMembersCount = function() {
            const count = document.querySelectorAll('#createRoomMemberList input[type="checkbox"]:checked').length;
            const badge = document.getElementById('selectedMembersCount');
            if (badge) badge.textContent = `เลือกแล้ว ${count} คน`;
        };

        // ==========================================
        // GROUP CHAT: MANAGE ROOM MEMBERS MODAL
        // ==========================================
        let currentManagingRoomId = null;

        window.openRoomMembersModal = async function(roomId) {
            currentManagingRoomId = roomId;
            const modal = document.getElementById('roomMembersModal');
            if (!modal) return;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
            window.switchMembersTab('current');
            await window.loadRoomMembers(roomId);
        };

        window.closeRoomMembersModal = function() {
            const modal = document.getElementById('roomMembersModal');
            if (modal) modal.style.display = 'none';
            document.body.style.overflow = '';
        };

        window.switchMembersTab = function(tab) {
            const tabCurrent = document.getElementById('tabCurrentMembers');
            const tabAdd = document.getElementById('tabAddMembers');
            const panelCurrent = document.getElementById('panelCurrentMembers');
            const panelAdd = document.getElementById('panelAddMembers');

            if (tab === 'current') {
                tabCurrent?.classList.add('active');
                tabAdd?.classList.remove('active');
                if (panelCurrent) panelCurrent.style.display = 'block';
                if (panelAdd) panelAdd.style.display = 'none';
            } else {
                tabAdd?.classList.add('active');
                tabCurrent?.classList.remove('active');
                if (panelAdd) panelAdd.style.display = 'block';
                if (panelCurrent) panelCurrent.style.display = 'none';
            }
        };

        window.loadRoomMembers = async function(roomId) {
            try {
                const res = await fetch(`/rooms/${roomId}/members`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await res.json();
                if (data.success) {
                    const isPublicRoom = !data.is_private;

                    const badge = document.getElementById('membersCountBadge');
                    if (badge) badge.textContent = data.members.length;
                    const title = document.getElementById('manageMembersModalTitle');
                    if (title) title.textContent = `สมาชิกห้อง: ${data.room_name}`;

                    // อัปเดต header member count button
                    const headerCount = document.getElementById('headerMembersCountText');
                    if (headerCount) headerCount.textContent = `${data.members.length} สมาชิก`;
                    
                    // ห้องสาธารณะ: ซ่อนแท็บ "เพิ่มสมาชิก" เพราะทุกคนเป็นสมาชิกอยู่แล้ว
                    const tabAdd = document.getElementById('tabAddMembers');
                    if (tabAdd) {
                        tabAdd.style.display = (data.can_manage && !isPublicRoom) ? 'inline-flex' : 'none';
                    }

                    window.renderCurrentMembersList(data.members, data.can_manage && !isPublicRoom, data.created_by);
                    window.renderNonMembersList(data.non_members);
                }
            } catch (err) {
                console.error('Load room members error:', err);
            }
        };

        window.renderCurrentMembersList = function(members, canManage, createdById) {
            const list = document.getElementById('currentMembersList');
            if (!list) return;
            if (!members || members.length === 0) {
                list.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 13px;">ไม่มีสมาชิกในห้องนี้</div>';
                return;
            }

            list.innerHTML = members.map(m => {
                const isCreator = m.id === createdById || m.role === 'admin';
                const canRemove = canManage && !isCreator && m.id !== Number(currentUserId);
                const avatarHtml = m.avatar 
                    ? `<img src="${m.avatar}" style="width: 100%; height: 100%; object-fit: cover;">` 
                    : `${(m.first_name || m.name || 'U').charAt(0).toUpperCase()}`;

                return `
                    <div class="member-item-row" data-name="${escapeHtml((m.name || '').toLowerCase())}">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; overflow: hidden; flex-shrink: 0;">
                            ${avatarHtml}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                ${escapeHtml(m.name)} ${isCreator ? '<span style="font-size: 10px; color: #f59e0b; margin-left: 4px;">👑 ผู้ดูแลห้อง</span>' : ''}
                            </div>
                            <div style="font-size: 11px; color: var(--text-secondary);">${escapeHtml(m.position || 'พนักงาน')}</div>
                        </div>
                        ${canRemove ? `
                            <button type="button" class="btn-remove-member" onclick="removeRoomMember(${m.id}, '${escapeHtml(m.name)}')" title="นำออกจากห้อง">
                                ลบออก
                            </button>
                        ` : ''}
                    </div>
                `;
            }).join('');
        };

        window.renderNonMembersList = function(nonMembers) {
            const list = document.getElementById('nonMembersList');
            if (!list) return;
            if (!nonMembers || nonMembers.length === 0) {
                list.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-muted); font-size: 13px;">เพื่อนร่วมงานทุกคนเข้าร่วมห้องนี้แล้ว</div>';
                return;
            }

            list.innerHTML = nonMembers.map(u => {
                const avatarHtml = u.avatar 
                    ? `<img src="${u.avatar}" style="width: 100%; height: 100%; object-fit: cover;">` 
                    : `${(u.first_name || u.name || 'U').charAt(0).toUpperCase()}`;

                return `
                    <label class="add-member-item" data-name="${escapeHtml((u.name || '').toLowerCase())}" style="display: flex; align-items: center; gap: 10px; padding: 6px 8px; border-radius: 6px; cursor: pointer;">
                        <input type="checkbox" class="new-member-checkbox" value="${u.id}" onchange="updateNewMembersSelectedCount()" style="width: 16px; height: 16px; cursor: pointer;">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #3b82f6; color: white; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; overflow: hidden; flex-shrink: 0;">
                            ${avatarHtml}
                        </div>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-size: 13px; font-weight: 500; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${escapeHtml(u.name)}</div>
                        </div>
                        <span style="font-size: 11px; padding: 2px 8px; border-radius: 10px; background: ${u.position_color || '#e2e8f0'}22; color: ${u.position_color || '#64748b'}; font-weight: 500;">
                            ${escapeHtml(u.position || 'พนักงาน')}
                        </span>
                    </label>
                `;
            }).join('');
        };

        window.filterCurrentMembers = function(query) {
            const q = (query || '').toLowerCase().trim();
            document.querySelectorAll('#currentMembersList .member-item-row').forEach(el => {
                const name = el.getAttribute('data-name') || '';
                el.style.display = name.includes(q) ? 'flex' : 'none';
            });
        };

        window.filterNonMembers = function(query) {
            const q = (query || '').toLowerCase().trim();
            document.querySelectorAll('#nonMembersList .add-member-item').forEach(el => {
                const name = el.getAttribute('data-name') || '';
                el.style.display = name.includes(q) ? 'flex' : 'none';
            });
        };

        window.updateNewMembersSelectedCount = function() {
            const checked = document.querySelectorAll('#nonMembersList .new-member-checkbox:checked');
            const badge = document.getElementById('selectedNewMembersCount');
            if (badge) badge.textContent = `เลือก ${checked.length} คน`;
        };

        window.submitAddRoomMembers = async function() {
            if (!currentManagingRoomId) return;
            const checked = Array.from(document.querySelectorAll('#nonMembersList .new-member-checkbox:checked')).map(cb => Number(cb.value));
            if (checked.length === 0) {
                alert('กรุณาเลือกสมาชิกอย่างน้อย 1 คน');
                return;
            }

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                              '{{ csrf_token() }}';
                const res = await fetch(`/rooms/${currentManagingRoomId}/members`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ user_ids: checked })
                });
                const data = await res.json();
                if (data.success) {
                    await window.loadRoomMembers(currentManagingRoomId);
                    window.switchMembersTab('current');
                } else {
                    alert(data.message || 'เกิดข้อผิดพลาดในการเพิ่มสมาชิก');
                }
            } catch (err) {
                console.error('Add members error:', err);
                alert('เกิดข้อผิดพลาดในการส่งข้อมูล');
            }
        };

        window.removeRoomMember = async function(userId, userName) {
            if (!currentManagingRoomId) return;
            if (!confirm(`คุณแน่ใจหรือไม่ว่าต้องการนำ "${userName}" ออกจากห้องนี้?`)) return;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                              '{{ csrf_token() }}';
                const res = await fetch(`/rooms/${currentManagingRoomId}/members/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    }
                });
                const data = await res.json();
                if (data.success) {
                    await window.loadRoomMembers(currentManagingRoomId);
                } else {
                    alert(data.message || 'เกิดข้อผิดพลาดในการนำสมาชิกออก');
                }
            } catch (err) {
                console.error('Remove member error:', err);
                alert('เกิดข้อผิดพลาดในการส่งข้อมูล');
            }
        };

        window.handleMessageUpdatedRealtime = function(data) {
            if (!data || !data.id) return;
            const row = document.querySelector(`.message-row[data-message-id="${data.id}"]`);
            if (row) {
                const msgTextEl = document.getElementById(`msgText${data.id}`) || row.querySelector('.message-text');
                if (msgTextEl) {
                    msgTextEl.innerHTML = formatChatMessage(data.message || '', true);
                }
            }
        };

        window.handleMessageDeletedRealtime = function(data) {
            if (!data || !data.id) return;
            const row = document.querySelector(`.message-row[data-message-id="${data.id}"]`);
            if (row) {
                row.style.transition = 'opacity 0.25s, transform 0.25s';
                row.style.opacity = '0';
                row.style.transform = 'scale(0.95)';
                setTimeout(() => row.remove(), 260);
            }
        };

        if (window.Echo && currentRoomId) {
            const channel = window.Echo.channel(`chat.${currentRoomId}`);
            
            channel.listen('.MessageSent', (e) => {
                appendMessage(e);
            }).listen('MessageSent', (e) => {
                appendMessage(e);
            }).listen('.ReactionUpdated', (e) => {
                window.handleReactionUpdatedRealtime(e);
            }).listen('ReactionUpdated', (e) => {
                window.handleReactionUpdatedRealtime(e);
            }).listen('.MessageUpdated', (e) => {
                window.handleMessageUpdatedRealtime(e);
            }).listen('MessageUpdated', (e) => {
                window.handleMessageUpdatedRealtime(e);
            }).listen('.MessageDeleted', (e) => {
                window.handleMessageDeletedRealtime(e);
            }).listen('MessageDeleted', (e) => {
                window.handleMessageDeletedRealtime(e);
            });

            if (window.Echo.connector && window.Echo.connector.pusher) {
                window.Echo.connector.pusher.connection.bind('connected', () => {
                    if (socketStatus) {
                        socketStatus.textContent = 'Real-time (เชื่อมต่อแล้ว)';
                    }
                });
                window.Echo.connector.pusher.connection.bind('disconnected', () => {
                    if (socketStatus) {
                        socketStatus.textContent = 'Real-time (หลุดการเชื่อมต่อ)';
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

        // View switcher logic (SPA feel without page refresh)
        window.switchDashboardView = function(view, event) {
            if (event) {
                event.preventDefault();
            }

            // Remove active state from nav buttons and rooms
            document.querySelectorAll('.nav-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.room-item').forEach(item => item.classList.remove('active'));

            // View containers
            const viewChat = document.getElementById('viewChat');
            const viewMyTasks = document.getElementById('viewMyTasks');
            const viewAllTasks = document.getElementById('viewAllTasks');
            const viewNews = document.getElementById('viewNews');

            // Header title containers
            const titleChat = document.getElementById('titleChat');
            const titleMyTasks = document.getElementById('titleMyTasks');
            const titleAllTasks = document.getElementById('titleAllTasks');
            const titleNews = document.getElementById('titleNews');

            if (viewChat) viewChat.style.display = 'none';
            if (viewMyTasks) viewMyTasks.style.display = 'none';
            if (viewAllTasks) viewAllTasks.style.display = 'none';
            if (viewNews) viewNews.style.display = 'none';

            if (titleChat) titleChat.style.display = 'none';
            if (titleMyTasks) titleMyTasks.style.display = 'none';
            if (titleAllTasks) titleAllTasks.style.display = 'none';
            if (titleNews) titleNews.style.display = 'none';

            if (view === 'my-tasks') {
                if (viewMyTasks) viewMyTasks.style.display = 'flex';
                if (titleMyTasks) titleMyTasks.style.display = 'flex';
                const btn = document.getElementById('navBtnMyTasks');
                if (btn) btn.classList.add('active');
                window.history.pushState({ view: 'my-tasks' }, '', '/dashboard?view=my-tasks');
            } else if (view === 'all-tasks') {
                if (viewAllTasks) viewAllTasks.style.display = 'flex';
                if (titleAllTasks) titleAllTasks.style.display = 'flex';
                const btn = document.getElementById('navBtnAllTasks');
                if (btn) btn.classList.add('active');
                window.history.pushState({ view: 'all-tasks' }, '', '/dashboard?view=all-tasks');
            } else if (view === 'news') {
                if (viewNews) viewNews.style.display = 'flex';
                if (titleNews) titleNews.style.display = 'flex';
                const btn = document.getElementById('navBtnNews');
                if (btn) btn.classList.add('active');
                window.history.pushState({ view: 'news' }, '', '/dashboard?view=news');
            } else {
                // chat
                if (viewChat) viewChat.style.display = 'flex';
                if (titleChat) titleChat.style.display = 'flex';
                const activeRoomEl = document.querySelector(`.room-item[data-room-id="${currentRoomId}"]`);
                if (activeRoomEl) activeRoomEl.classList.add('active');
                scrollToBottom();
                window.history.pushState({ view: 'chat', room: currentRoomId }, '', `/dashboard?room=${currentRoomId}`);
            }

            // On mobile, close sidebar drawer
            if (window.innerWidth <= 768) {
                toggleSidebar(false);
            }
        };

        window.handleRoomClick = function(roomId, event) {
            if (roomId == currentRoomId) {
                // If already in DOM, simply switch to chat view
                window.switchDashboardView('chat', event);
            }
            // If different room, allow default link click to load the room's messages
        };

        window.filterAllTasks = function(status, btnEl) {
            document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
            if (btnEl) btnEl.classList.add('active');

            const items = document.querySelectorAll('.all-task-item');
            items.forEach(item => {
                const itemStatus = item.getAttribute('data-status');
                const itemPriority = item.getAttribute('data-priority');

                if (status === 'all') {
                    item.style.display = 'block';
                } else if (status === 'ด่วน') {
                    item.style.display = (itemPriority === 'ด่วน') ? 'block' : 'none';
                } else {
                    item.style.display = (itemStatus === status) ? 'block' : 'none';
                }
            });
        };

        // Settings Modal Controls

        // Theme Management (Top-Right Toggle & Global Theme Sync)
        window.updateThemeIcon = function(theme) {
            const icon = document.getElementById('themeIcon');
            if (icon) {
                icon.textContent = theme === 'dark' ? '☀️' : '🌙';
            }
            const btn = document.getElementById('themeToggleBtn');
            if (btn) {
                btn.title = theme === 'dark' ? 'เปลี่ยนเป็นโหมดสว่าง (Light Mode)' : 'เปลี่ยนเป็นโหมดมืด (Dark Mode)';
            }
        };

        window.toggleTheme = function() {
            try {
                const current = document.documentElement.getAttribute('data-theme') || 'dark';
                const next = current === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('companychat_theme', next);
                updateThemeIcon(next);
            } catch (err) {
                console.error("Theme toggle error:", err);
            }
        };

        window.setTheme = function(theme) {
            try {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem('companychat_theme', theme);
                updateThemeIcon(theme);
            } catch (err) {
                console.error("Theme set error:", err);
            }
        };

        // Collapsible sections handled by global window.toggleSection

        // Quick Search / Filter in Sidebar
        window.filterSidebarLists = function(rawQuery) {
            const query = (rawQuery || '').trim().toLowerCase();
            const clearBtn = document.getElementById('sidebarFilterClearBtn');
            if (clearBtn) {
                clearBtn.style.display = query.length > 0 ? 'block' : 'none';
            }

            const roomItems = document.querySelectorAll('#sidebarRoomsList .room-item');
            const dmItems = document.querySelectorAll('#sidebarDmList .dm-row-wrap');

            // Auto-expand sections if user searches
            if (query.length > 0) {
                const roomsList = document.getElementById('sidebarRoomsList');
                const dmList = document.getElementById('sidebarDmList');
                const roomsArrow = document.getElementById('roomsCollapseArrow');
                const dmArrow = document.getElementById('dmCollapseArrow');
                if (roomsList) roomsList.classList.remove('collapsed');
                if (dmList) dmList.classList.remove('collapsed');
                if (roomsArrow) {
                    roomsArrow.classList.remove('rotated');
                    roomsArrow.textContent = '▾';
                }
                if (dmArrow) {
                    dmArrow.classList.remove('rotated');
                    dmArrow.textContent = '▾';
                }
            }

            roomItems.forEach(el => {
                const text = el.getAttribute('data-search-text') || el.textContent.toLowerCase();
                el.style.display = (!query || text.includes(query)) ? 'flex' : 'none';
            });

            dmItems.forEach(el => {
                const text = el.getAttribute('data-search-text') || el.textContent.toLowerCase();
                el.style.display = (!query || text.includes(query)) ? 'flex' : 'none';
            });
        };

        window.clearSidebarFilter = function() {
            const input = document.getElementById('sidebarFilterInput');
            if (input) {
                input.value = '';
                filterSidebarLists('');
                input.focus();
            }
        };

        // Direct Message Modal
        window.openNewDmModal = function() {
            const modal = document.getElementById('newDmModal');
            if (modal) {
                modal.style.display = 'flex';
                const input = document.getElementById('dmModalSearchInput');
                if (input) {
                    input.value = '';
                    filterDmModalUsers('');
                    setTimeout(() => input.focus(), 100);
                }
            }
        };

        window.closeNewDmModal = function() {
            const modal = document.getElementById('newDmModal');
            if (modal) modal.style.display = 'none';
        };

        // Edit Room Modal
        window.openEditRoomModal = function(roomId, roomName, roomDesc) {
            const modal = document.getElementById('editRoomModal');
            const form = document.getElementById('editRoomForm');
            const nameInput = document.getElementById('editRoomNameInput');
            const descInput = document.getElementById('editRoomDescInput');
            const countSpan = document.getElementById('editRoomNameCount');

            if (!modal || !form || !nameInput) return;

            form.action = '/rooms/' + roomId;
            nameInput.value = roomName || '';
            if (descInput) descInput.value = roomDesc || '';
            if (countSpan) countSpan.textContent = (roomName || '').length + '/30';

            modal.style.display = 'flex';
            setTimeout(() => {
                nameInput.focus();
                nameInput.select();
            }, 100);
        };

        window.closeEditRoomModal = function() {
            const modal = document.getElementById('editRoomModal');
            if (modal) modal.style.display = 'none';
        };

        window.filterDmModalUsers = function(rawQuery) {
            const query = (rawQuery || '').trim().toLowerCase();
            const cards = Array.from(document.querySelectorAll('#dmModalUserList .dm-select-card'));
            const emptyPrompt = document.getElementById('dmModalEmptyPrompt');
            const noResults = document.getElementById('dmModalNoResults');
            const listContainer = document.getElementById('dmModalUserList');

            if (!query) {
                // ต้องพิมพ์ค้นหาก่อน จึงจะแสดงรายชื่อ
                cards.forEach(card => card.style.display = 'none');
                if (emptyPrompt) emptyPrompt.style.display = 'block';
                if (noResults) noResults.style.display = 'none';
                return;
            }

            if (emptyPrompt) emptyPrompt.style.display = 'none';

            let matchedCount = 0;
            const scoredCards = [];

            cards.forEach(card => {
                const name = (card.getAttribute('data-user-name') || '').toLowerCase();
                const pos = (card.getAttribute('data-user-pos') || '').toLowerCase();
                const email = (card.getAttribute('data-user-email') || '').toLowerCase();

                let score = 0;

                // ตรวจสอบความใกล้เคียงของชื่อและข้อมูลที่พิมพ์
                if (name === query) {
                    score = 100;
                } else if (name.startsWith(query)) {
                    score = 90;
                } else if (name.split(/\s+/).some(w => w.startsWith(query))) {
                    score = 80;
                } else if (name.includes(query)) {
                    score = 70;
                } else if (pos.startsWith(query)) {
                    score = 60;
                } else if (pos.includes(query)) {
                    score = 50;
                } else if (email.startsWith(query) || email.includes(query)) {
                    score = 40;
                } else {
                    // Subsequence / Fuzzy matching สำหรับชื่อที่ใกล้เคียง
                    let qIdx = 0;
                    for (let i = 0; i < name.length && qIdx < query.length; i++) {
                        if (name[i] === query[qIdx]) qIdx++;
                    }
                    if (qIdx === query.length && query.length >= 2) {
                        score = 30;
                    }
                }

                if (score > 0) {
                    matchedCount++;
                    card.style.display = 'flex';
                    scoredCards.push({ card, score });
                } else {
                    card.style.display = 'none';
                }
            });

            // เรียงลำดับชื่อที่ใกล้เคียงที่สุดขึ้นมาก่อน
            scoredCards.sort((a, b) => b.score - a.score);
            if (listContainer) {
                scoredCards.forEach(item => {
                    listContainer.appendChild(item.card);
                });
            }

            if (noResults) {
                if (matchedCount === 0) {
                    noResults.innerHTML = `ไม่พบเพื่อนร่วมงานที่ใกล้เคียงกับ "<strong>${escapeHtml(rawQuery)}</strong>"`;
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }
            }
        };

        // Initialize UI & state on load
        try {
            const currentTheme = document.documentElement.getAttribute('data-theme') || localStorage.getItem('companychat_theme') || 'dark';
            if (typeof window.updateThemeIcon === 'function') {
                window.updateThemeIcon(currentTheme);
            }
        } catch (e) {}

        // Restore collapsible section state on load
        window.restoreCollapsibleSections();

        // Close modals when clicking backdrop
        const editRoomModal = document.getElementById('editRoomModal');
        if (editRoomModal) {
            editRoomModal.addEventListener('click', function(e) {
                if (e.target === this) closeEditRoomModal();
            });
        }
        const createRoomModal = document.getElementById('createRoomModal');
        if (createRoomModal) {
            createRoomModal.addEventListener('click', function(e) {
                if (e.target === this) this.style.display = 'none';
            });
        }

        window.openSettingsModal = function() {
            const modal = document.getElementById('settingsModal');
            if (modal) {
                modal.style.display = 'flex';
            }
        };

        window.closeSettingsModal = function() {
            const modal = document.getElementById('settingsModal');
            if (modal) {
                modal.style.display = 'none';
            }
        };

        document.getElementById('settingsModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'settingsModal') {
                closeSettingsModal();
            }
        });

        // Notification Bell & Dropdown Controls
        window.toggleNotificationDropdown = function(event) {
            if (event) {
                event.stopPropagation();
            }
            const dropdown = document.getElementById('notificationDropdown');
            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        };

        window.closeNotificationDropdown = function() {
            const dropdown = document.getElementById('notificationDropdown');
            if (dropdown) {
                dropdown.classList.remove('show');
            }
        };

        window.openTaskFromNotification = function(taskId) {
            closeNotificationDropdown();
            window.switchDashboardView('my-tasks');
            setTimeout(() => {
                const taskCard = document.querySelector(`.task-card[data-task-id="${taskId}"]`) || 
                                 document.querySelector(`.all-task-item[data-task-id="${taskId}"]`);
                if (taskCard) {
                    taskCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    taskCard.style.outline = '2px solid #10b981';
                    taskCard.style.boxShadow = '0 0 20px rgba(16, 185, 129, 0.4)';
                    setTimeout(() => {
                        taskCard.style.outline = '';
                        taskCard.style.boxShadow = '';
                    }, 2500);
                }
            }, 150);
        };

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const container = document.getElementById('notificationContainer');
            if (container && !container.contains(e.target)) {
                closeNotificationDropdown();
            }
        });

        // ==========================================
        // NEWS & ANNOUNCEMENTS JAVASCRIPT LOGIC
        // ==========================================
        window.openCreateNewsModal = function() {
            const modal = document.getElementById('createNewsModal');
            if (modal) {
                modal.style.display = 'flex';
                const titleInput = document.getElementById('news_title');
                if (titleInput) titleInput.focus();
            }
        };

        window.closeCreateNewsModal = function() {
            const modal = document.getElementById('createNewsModal');
            if (modal) modal.style.display = 'none';
        };

        window.openEditNewsModal = function(data) {
            const modal = document.getElementById('editNewsModal');
            if (!modal) return;

            const form = document.getElementById('editNewsForm');
            if (form) form.action = `/news/${data.id}`;

            const titleEl = document.getElementById('edit_news_title');
            const catEl = document.getElementById('edit_news_category');
            const contentEl = document.getElementById('edit_news_content');
            const pinEl = document.getElementById('edit_news_pinned');
            const coverExistEl = document.getElementById('editNewsCoverExisting');
            const audioExistEl = document.getElementById('editNewsAudioExisting');

            if (titleEl) titleEl.value = data.title || '';
            if (catEl) catEl.value = data.category || 'ทั่วไป';
            if (contentEl) contentEl.value = data.content || '';
            if (pinEl) pinEl.checked = !!data.is_pinned;

            if (coverExistEl) coverExistEl.style.display = data.has_cover ? 'block' : 'none';
            if (audioExistEl) audioExistEl.style.display = data.has_audio ? 'block' : 'none';

            modal.style.display = 'flex';
        };

        window.closeEditNewsModal = function() {
            const modal = document.getElementById('editNewsModal');
            if (modal) modal.style.display = 'none';
        };

        window.previewNewsCover = function(input, previewId) {
            const previewWrap = document.getElementById(previewId);
            if (!previewWrap) return;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = previewWrap.querySelector('img');
                    if (img) img.src = e.target.result;
                    previewWrap.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        window.clearNewsCover = function(inputId, previewId) {
            const input = document.getElementById(inputId);
            const previewWrap = document.getElementById(previewId);
            if (input) input.value = '';
            if (previewWrap) {
                const img = previewWrap.querySelector('img');
                if (img) img.src = '';
                previewWrap.style.display = 'none';
            }
        };

        window.filterNewsCategory = function(category, btnEl) {
            document.querySelectorAll('.news-filter-chip').forEach(b => b.classList.remove('active'));
            if (btnEl) btnEl.classList.add('active');

            const cards = document.querySelectorAll('#newsFeedList .news-card');
            cards.forEach(card => {
                const cat = card.getAttribute('data-category');
                const isPinned = card.getAttribute('data-is-pinned') === '1';

                if (category === 'all') {
                    card.style.display = 'flex';
                } else if (category === 'pinned') {
                    card.style.display = isPinned ? 'flex' : 'none';
                } else {
                    card.style.display = (cat === category) ? 'flex' : 'none';
                }
            });
        };

        window.toggleNewsLike = function(newsId, btnEl) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                              '{{ csrf_token() }}';

            fetch(`/news/${newsId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.liked !== undefined) {
                    if (data.liked) {
                        btnEl.classList.add('liked');
                        btnEl.querySelector('.like-icon').textContent = '❤️';
                        btnEl.querySelector('.like-label').textContent = 'ถูกใจแล้ว';
                    } else {
                        btnEl.classList.remove('liked');
                        btnEl.querySelector('.like-icon').textContent = '🤍';
                        btnEl.querySelector('.like-label').textContent = 'ถูกใจ';
                    }
                    const counter = btnEl.querySelector('.like-counter');
                    if (counter) counter.textContent = `(${data.likes_count})`;
                }
            })
            .catch(err => {
                console.error('Error toggling like:', err);
            });
        };

        // ==========================================
        // REAL-TIME AJAX ACTION HANDLERS
        // ==========================================
        window.updateTaskStatusAjax = function(selectEl, taskId, viewType) {
            const newStatus = selectEl.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            const endpoint = (viewType === 'my') ? `/my-tasks/${taskId}/status` : `/tasks/${taskId}`;

            // Optimistic UI update
            const myCard = document.querySelector(`[data-my-task-id="${taskId}"]`);
            const allCard = document.querySelector(`[data-task-id="${taskId}"]`);

            if (allCard) {
                allCard.setAttribute('data-status', newStatus);
                const badge = allCard.querySelector('.status-badge');
                if (badge) badge.textContent = newStatus;
                const selectInAll = allCard.querySelector('select[name="status"]');
                if (selectInAll && selectInAll !== selectEl) selectInAll.value = newStatus;
            }

            if (myCard) {
                const badge = myCard.querySelector('.status-badge');
                if (badge) badge.textContent = newStatus;
                const selectInMy = myCard.querySelector('select[name="status"]');
                if (selectInMy && selectInMy !== selectEl) selectInMy.value = newStatus;

                if (newStatus === 'เสร็จแล้ว') {
                    myCard.style.transition = 'opacity 0.3s ease, transform 0.3s ease, max-height 0.4s ease';
                    myCard.style.opacity = '0';
                    myCard.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        myCard.remove();
                    }, 350);
                }
            }

            fetch(endpoint, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(res => res.json())
            .then(data => {
                if (window.runGlobalRealtimeSync) {
                    window.runGlobalRealtimeSync();
                }
            })
            .catch(err => {
                console.error('Error updating task status:', err);
            });
        };

        window.handleDeleteTaskAjax = function(event, taskId) {
            event.preventDefault();
            if (!confirm('ยืนยันที่จะลบงานนี้หรือไม่?')) return false;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            const allCard = document.querySelector(`[data-task-id="${taskId}"]`);
            const myCard = document.querySelector(`[data-my-task-id="${taskId}"]`);

            if (allCard) {
                allCard.style.transition = 'opacity 0.3s, transform 0.3s';
                allCard.style.opacity = '0';
                allCard.style.transform = 'scale(0.95)';
                setTimeout(() => allCard.remove(), 300);
            }
            if (myCard) {
                myCard.style.transition = 'opacity 0.3s, transform 0.3s';
                myCard.style.opacity = '0';
                myCard.style.transform = 'scale(0.95)';
                setTimeout(() => myCard.remove(), 300);
            }

            fetch(`/tasks/${taskId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                if (window.runGlobalRealtimeSync) {
                    window.runGlobalRealtimeSync();
                }
            })
            .catch(err => {
                console.error('Error deleting task:', err);
            });

            return false;
        };

        window.handlePinNewsAjax = function(event, newsId) {
            event.preventDefault();
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            fetch(`/news/${newsId}/pin`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                if (window.runGlobalRealtimeSync) {
                    window.runGlobalRealtimeSync(true);
                }
            })
            .catch(err => {
                console.error('Error toggling pin:', err);
            });

            return false;
        };

        window.handleDeleteNewsAjax = function(event, newsId) {
            event.preventDefault();
            if (!confirm('ยืนยันที่จะลบประกาศข่าวนี้หรือไม่?')) return false;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            const card = document.getElementById(`newsCard${newsId}`);
            if (card) {
                card.style.transition = 'opacity 0.3s, transform 0.3s';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => card.remove(), 300);
            }

            fetch(`/news/${newsId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                if (window.runGlobalRealtimeSync) {
                    window.runGlobalRealtimeSync(true);
                }
            })
            .catch(err => {
                console.error('Error deleting news:', err);
            });

            return false;
        };

        // ==========================================
        // GLOBAL REAL-TIME SYNCHRONIZATION ENGINE
        // ==========================================
        let lastNewsHash = null;
        let lastRoomsHash = null;
        let lastDmHash = null;
        let isSyncing = false;

        window.escapeHtml = function(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        };

        window.runGlobalRealtimeSync = async function(forceNews = false) {
            if (isSyncing) return;
            isSyncing = true;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            try {
                const res = await fetch('/realtime/sync', {
                    headers: { 'Accept': 'application/json' }
                });
                if (!res.ok) {
                    isSyncing = false;
                    return;
                }

                const data = await res.json();

                // 1. Urgent Notifications & Bell Badge
                const notifCount = data.notifications_count || 0;
                const headerBellBadge = document.getElementById('headerBellBadge');
                if (headerBellBadge) {
                    headerBellBadge.textContent = notifCount > 9 ? '9+' : notifCount;
                    headerBellBadge.style.display = notifCount > 0 ? '' : 'none';
                }

                const notifDropdownCount = document.getElementById('notificationDropdownCount');
                if (notifDropdownCount) {
                    notifDropdownCount.textContent = `${notifCount} งาน`;
                    notifDropdownCount.style.display = notifCount > 0 ? '' : 'none';
                }

                const sidebarUrgentNavWrap = document.getElementById('sidebarUrgentNavWrap');
                if (sidebarUrgentNavWrap) {
                    sidebarUrgentNavWrap.style.display = notifCount > 0 ? 'block' : 'none';
                }

                const sidebarUrgentCountBadge = document.getElementById('sidebarUrgentCountBadge');
                if (sidebarUrgentCountBadge) {
                    sidebarUrgentCountBadge.textContent = notifCount;
                }

                // Urgent Dropdown Items list
                const notifBody = document.getElementById('notificationDropdownBody');
                if (notifBody && data.urgent_tasks) {
                    if (data.urgent_tasks.length === 0) {
                        notifBody.innerHTML = `
                            <div class="notification-empty">
                                <div style="font-size: 13.5px; font-weight: 600; color: var(--text-primary);">ไม่มีงานสำคัญเร่งด่วนในขณะนี้</div>
                                <div style="font-size: 12px; color: var(--text-muted); margin-top: 3px;">คุณและทีมงานจัดการภารกิจได้อย่างยอดเยี่ยม!</div>
                            </div>
                        `;
                    } else {
                        let html = '';
                        data.urgent_tasks.forEach(task => {
                            const pClass = task.priority === 'ด่วน' ? 'badge-red' : (task.priority === 'สูง' ? 'badge-amber' : 'badge-blue');
                            const dueHtml = task.due_human ? `<span>•</span><span style="color: ${task.is_overdue ? '#ef4444' : '#f59e0b'}; font-weight: 500;">${window.escapeHtml(task.due_human)}</span>` : '';
                            html += `
                                <div class="notification-item" onclick="openTaskFromNotification('${task.id}')">
                                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 8px; margin-bottom: 4px;">
                                        <span class="notification-item-title">${window.escapeHtml(task.title)}</span>
                                        <span class="nav-badge ${pClass}" style="font-size: 10px; flex-shrink: 0;">${window.escapeHtml(task.priority)}</span>
                                    </div>
                                    <div class="notification-item-meta">
                                        <span>${window.escapeHtml(task.assignee)}</span>
                                        ${dueHtml}
                                    </div>
                                </div>
                            `;
                        });
                        notifBody.innerHTML = html;
                    }
                }

                // 2. Task Badges & Live Status Sync
                const myTasksCount = data.my_tasks_count || 0;
                const sidebarMyTasksBadge = document.getElementById('sidebarMyTasksBadge');
                if (sidebarMyTasksBadge) {
                    sidebarMyTasksBadge.textContent = myTasksCount;
                    sidebarMyTasksBadge.style.display = myTasksCount > 0 ? '' : 'none';
                }

                const allTasksCount = data.all_tasks_count || 0;
                const sidebarAllTasksCountBadge = document.getElementById('sidebarAllTasksCountBadge');
                if (sidebarAllTasksCountBadge) {
                    sidebarAllTasksCountBadge.textContent = allTasksCount;
                }

                const headerAllTasksCountBadge = document.getElementById('headerAllTasksCountBadge');
                if (headerAllTasksCountBadge) {
                    headerAllTasksCountBadge.textContent = `${allTasksCount} รายการ`;
                }

                // Task Statuses Live Sync
                if (data.task_statuses) {
                    for (const [taskId, info] of Object.entries(data.task_statuses)) {
                        const allCard = document.querySelector(`.all-task-item[data-task-id="${taskId}"]`);
                        if (allCard) {
                            allCard.setAttribute('data-status', info.status);
                            const badge = allCard.querySelector('.status-badge');
                            if (badge && badge.textContent.trim() !== info.status) {
                                badge.textContent = info.status;
                            }
                            const selectEl = allCard.querySelector('select[name="status"]');
                            if (selectEl && selectEl !== document.activeElement && selectEl.value !== info.status) {
                                selectEl.value = info.status;
                            }
                        }

                        const myCard = document.querySelector(`[data-my-task-id="${taskId}"]`);
                        if (myCard) {
                            if (info.status === 'เสร็จแล้ว') {
                                myCard.style.transition = 'opacity 0.3s, transform 0.3s';
                                myCard.style.opacity = '0';
                                myCard.style.transform = 'scale(0.95)';
                                setTimeout(() => myCard.remove(), 300);
                            } else {
                                const badge = myCard.querySelector('.status-badge');
                                if (badge && badge.textContent.trim() !== info.status) {
                                    badge.textContent = info.status;
                                }
                                const selectEl = myCard.querySelector('select[name="status"]');
                                if (selectEl && selectEl !== document.activeElement && selectEl.value !== info.status) {
                                    selectEl.value = info.status;
                                }
                            }
                        }
                    }
                }

                // 3. News Likes & Feed Live Sync
                const newsCount = data.news_count || 0;
                const sidebarNewsCountBadge = document.getElementById('sidebarNewsCountBadge');
                if (sidebarNewsCountBadge) {
                    sidebarNewsCountBadge.textContent = newsCount;
                    sidebarNewsCountBadge.style.display = newsCount > 0 ? '' : 'none';
                }

                const headerNewsCountBadge = document.getElementById('headerNewsCountBadge');
                if (headerNewsCountBadge) {
                    headerNewsCountBadge.textContent = `${newsCount} รายการ`;
                }

                // Live Likes Sync
                if (data.news_likes) {
                    for (const [newsId, likeInfo] of Object.entries(data.news_likes)) {
                        const card = document.getElementById(`newsCard${newsId}`);
                        if (card) {
                            const likeBtn = card.querySelector('.news-like-btn');
                            if (likeBtn) {
                                const counter = likeBtn.querySelector('.like-counter');
                                if (counter) counter.textContent = `(${likeInfo.likes_count})`;
                                const icon = likeBtn.querySelector('.like-icon');
                                const label = likeBtn.querySelector('.like-label');
                                if (likeInfo.is_liked) {
                                    likeBtn.classList.add('liked');
                                    if (icon) icon.textContent = '❤️';
                                    if (label) label.textContent = 'ถูกใจแล้ว';
                                } else {
                                    likeBtn.classList.remove('liked');
                                    if (icon) icon.textContent = '🤍';
                                    if (label) label.textContent = 'ถูกใจ';
                                }
                            }
                        }
                    }
                }

                // News Feed Re-render when new items added/pinned/removed
                if ((data.news_hash && data.news_hash !== lastNewsHash) || forceNews) {
                    const isFirstRun = (lastNewsHash === null);
                    lastNewsHash = data.news_hash;

                    if (!isFirstRun || forceNews) {
                        const feedList = document.getElementById('newsFeedList');
                        if (feedList && data.news_items) {
                            if (data.news_items.length === 0) {
                                feedList.innerHTML = `
                                    <div style="background: var(--bg-card); padding: 70px 20px; text-align: center; border-radius: 16px; border: 1px solid var(--border-color); box-shadow: var(--card-shadow);">
                                        <div style="font-size: 38px; margin-bottom: 10px;">📰</div>
                                        <div style="font-size: 18px; font-weight: 700; color: var(--text-primary);">ยังไม่มีข่าวสารหรือประกาศในขณะนี้</div>
                                    </div>
                                `;
                            } else {
                                let html = '';
                                data.news_items.forEach(item => {
                                    const roleClass = item.author_role_class || 'role-staff';
                                    const avatarHtml = item.author_avatar 
                                        ? `<img src="${item.author_avatar}" class="news-author-avatar" alt="${window.escapeHtml(item.author_name)}">`
                                        : `<div class="news-author-initial" style="background: ${item.position_color};">${window.escapeHtml(item.author_initial)}</div>`;
                                    
                                    const pinBadge = item.is_pinned 
                                        ? `<span class="news-badge-pinned"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg><span>ปักหมุด</span></span>` 
                                        : '';
                                    
                                    let adminActionsHtml = '';
                                    if (data.can_manage_news) {
                                        const editJson = window.escapeHtml(JSON.stringify({
                                            id: item.id,
                                            title: item.title,
                                            category: item.category,
                                            content: item.content,
                                            is_pinned: item.is_pinned,
                                            has_cover: !!item.cover_image,
                                            has_audio: !!item.audio_file
                                        }));

                                        adminActionsHtml = `
                                            <div class="news-admin-actions">
                                                <form method="POST" action="/news/${item.id}/pin" onsubmit="return handlePinNewsAjax(event, ${item.id})" style="display:inline; margin:0;">
                                                    <input type="hidden" name="_token" value="${csrfToken}">
                                                    <button type="submit" class="btn-news-action ${item.is_pinned ? 'pinned' : ''}" title="${item.is_pinned ? 'ยกเลิกการปักหมุด' : 'ปักหมุดข่าวนี้'}">
                                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="${item.is_pinned ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="17" x2="12" y2="22"></line><path d="M5 17h14v-2l-2-2V6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1v7l-2 2v2z"></path></svg>
                                                        <span>${item.is_pinned ? 'เลิกปักหมุด' : 'ปักหมุด'}</span>
                                                    </button>
                                                </form>

                                                <button type="button" class="btn-news-action" onclick='openEditNewsModal(${editJson})' title="แก้ไขข่าว">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                    <span>แก้ไข</span>
                                                </button>

                                                <form method="POST" action="/news/${item.id}" onsubmit="return handleDeleteNewsAjax(event, ${item.id})" style="display:inline; margin:0;">
                                                    <input type="hidden" name="_token" value="${csrfToken}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn-news-action danger" title="ลบประกาศข่าว">
                                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path><path d="M4 6h16"></path><path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path><line x1="10" y1="10" x2="10" y2="17"></line><line x1="14" y1="10" x2="14" y2="17"></line></svg>
                                                        <span>ลบ</span>
                                                    </button>
                                                </form>
                                            </div>
                                        `;
                                    }

                                    const coverHtml = item.cover_image 
                                        ? `<div class="news-cover-wrap" onclick="openImageModal('${item.cover_image}')"><img src="${item.cover_image}" class="news-cover-img" alt="${window.escapeHtml(item.title)}" loading="lazy"></div>`
                                        : '';

                                    const audioHtml = item.audio_file
                                        ? `<div class="news-audio-player"><div class="news-audio-icon">🎙️</div><div class="news-audio-info"><div class="news-audio-title">🔊 คลิปเสียงแถลงการณ์ / ประกาศเสียง</div><audio controls class="news-audio-element" src="${item.audio_file}"></audio></div></div>`
                                        : '';

                                    const contentFormatted = window.escapeHtml(item.content).replace(/\n/g, '<br>');

                                    html += `
                                        <article class="news-card ${item.is_pinned ? 'is-pinned' : ''}" 
                                                 data-category="${window.escapeHtml(item.category)}" 
                                                 data-is-pinned="${item.is_pinned ? '1' : '0'}"
                                                 data-news-id="${item.id}"
                                                 id="newsCard${item.id}">
                                            
                                            <div class="news-card-header">
                                                <div class="news-author-group">
                                                    ${avatarHtml}
                                                    <div class="news-author-meta">
                                                        <div class="news-author-name">
                                                            <span>${window.escapeHtml(item.author_name)}</span>
                                                            <span class="role-pill ${roleClass}" style="font-size: 10.5px; padding: 1px 8px;">
                                                                ${window.escapeHtml(item.author_position)}
                                                            </span>
                                                            ${pinBadge}
                                                        </div>
                                                        <div class="news-timestamp">
                                                            <span>${window.escapeHtml(item.created_at_formatted)}</span>
                                                            <span style="margin: 0 4px; opacity: 0.5;">•</span>
                                                            <span style="color: ${item.category_color}; font-weight: 600;">${window.escapeHtml(item.category)}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                ${adminActionsHtml}
                                            </div>

                                            <h2 class="news-title">${window.escapeHtml(item.title)}</h2>
                                            ${coverHtml}
                                            ${audioHtml}
                                            <div class="news-content">${contentFormatted}</div>

                                            <div class="news-footer">
                                                <button type="button" 
                                                        class="news-like-btn ${item.is_liked ? 'liked' : ''}" 
                                                        onclick="toggleNewsLike(${item.id}, this)">
                                                    <span class="like-icon">${item.is_liked ? '❤️' : '🤍'}</span>
                                                    <span class="like-label">${item.is_liked ? 'ถูกใจแล้ว' : 'ถูกใจ'}</span>
                                                    <span class="like-counter" style="margin-left: 2px;">(${item.likes_count})</span>
                                                </button>

                                                <button type="button" 
                                                        class="btn-news-action" 
                                                        onclick="copyNewsLink(${item.id})">
                                                    🔗 คัดลอกลิงก์
                                                </button>
                                            </div>
                                        </article>
                                    `;
                                });
                                feedList.innerHTML = html;
                            }
                        }
                    }
                }

                // 4. Chat Rooms live sync
                if (data.rooms_hash && data.rooms_hash !== lastRoomsHash) {
                    const isFirstRoomsRun = (lastRoomsHash === null);
                    lastRoomsHash = data.rooms_hash;

                    if (!isFirstRoomsRun) {
                        const roomsTitle = document.getElementById('sidebarRoomsCountTitle');
                        if (roomsTitle) roomsTitle.textContent = `ห้องแชต (${data.rooms.length})`;

                        const roomsList = document.getElementById('sidebarRoomsList');
                        if (roomsList && data.rooms) {
                            let rHtml = '';
                            data.rooms.forEach(r => {
                                const isActive = (window.currentRoomId && window.currentRoomId == r.id);
                                let editHtml = '';
                                let deleteHtml = '';

                                if (data.can_manage_rooms || data.is_admin) {
                                    const safeName = window.escapeHtml(r.name).replace(/'/g, "\\'");
                                    const safeDesc = window.escapeHtml(r.description || '').replace(/'/g, "\\'");
                                    editHtml = `
                                        <button type="button" class="room-edit-btn" title="แก้ไขชื่อห้อง" onclick="event.stopPropagation(); openEditRoomModal(${r.id}, '${safeName}', '${safeDesc}')">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </button>
                                    `;
                                }

                                if (data.is_admin) {
                                    deleteHtml = `
                                        <form method="POST" action="/rooms/${r.id}" onsubmit="return confirm('ต้องการลบห้อง ${window.escapeHtml(r.name)} ใช่หรือไม่?')" style="margin: 0;">
                                            <input type="hidden" name="_token" value="${csrfToken}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="room-delete-btn" title="ลบห้องนี้">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2H9V4z"></path>
                                                    <path d="M4 6h16"></path>
                                                    <path d="M6 6v12a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V6"></path>
                                                    <line x1="10" y1="10" x2="10" y2="17"></line>
                                                    <line x1="14" y1="10" x2="14" y2="17"></line>
                                                </svg>
                                            </button>
                                        </form>
                                    `;
                                }

                                const actionsHtml = (editHtml || deleteHtml) ? `<div class="room-actions">${editHtml}${deleteHtml}</div>` : '';

                                rHtml += `
                                    <div class="room-item ${isActive ? 'active' : ''}" data-room-id="${r.id}" data-search-text="${window.escapeHtml(r.name).toLowerCase()}">
                                        <a href="/dashboard?room=${r.id}" class="room-link" onclick="handleRoomClick(${r.id}, event)">
                                            <span class="room-hash">#</span>
                                            <span class="room-name-text">${window.escapeHtml(r.name)}</span>
                                        </a>
                                        ${actionsHtml}
                                    </div>
                                `;
                            });
                            roomsList.innerHTML = rHtml;
                        }
                    }
                }

                // 5. Direct Message Rooms live sync
                if (data.dm_hash && data.dm_hash !== lastDmHash) {
                    lastDmHash = data.dm_hash;
                    if (data.dm_rooms && Array.isArray(data.dm_rooms)) {
                        const countEl = document.getElementById('sidebarDmCount');
                        if (countEl) countEl.textContent = data.dm_rooms.length;
                        
                        const dmList = document.getElementById('sidebarDmList');
                        if (dmList && data.dm_rooms.length > 0) {
                            let html = '';
                            data.dm_rooms.forEach(dm => {
                                const isActive = (window.currentRoomId && window.currentRoomId == dm.id);
                                const color = dm.other_user_position_color || '#00C853';
                                const avatarHtml = dm.other_user_avatar
                                    ? `<img src="${dm.other_user_avatar}" class="dm-avatar" alt="${window.escapeHtml(dm.other_user_name)}">`
                                    : `<div class="dm-avatar-fallback" style="color:${color}; border-color:rgba(255,255,255,0.15);">${(dm.other_user_first_name || 'U').charAt(0).toUpperCase()}</div>`;
                                html += `
                                    <div class="dm-row-wrap ${isActive ? 'active' : ''}" 
                                         data-search-text="${window.escapeHtml((dm.other_user_name + ' ' + (dm.other_user_position || '') + ' ' + dm.other_user_first_name).toLowerCase())}"
                                         data-dm-user-id="${dm.other_user_id}"
                                         data-dm-room-id="${dm.id}">
                                        <a href="/dashboard?room=${dm.id}" class="dm-item ${isActive ? 'active' : ''}" title="แชตส่วนตัวกับ ${window.escapeHtml(dm.other_user_name)}">
                                            ${avatarHtml}
                                            <div class="dm-info">
                                                <span class="dm-name">${window.escapeHtml(dm.other_user_first_name)}</span>
                                                <span class="dm-role-tag" style="color:${color}; background:${color}22; border-color:${color}55;">${window.escapeHtml(dm.other_user_position || 'พนักงาน')}</span>
                                            </div>
                                        </a>
                                        <form method="POST" action="/rooms/${dm.id}" onsubmit="return confirm('ต้องการปิดแชตส่วนตัวกับ ${window.escapeHtml(dm.other_user_name)} ใช่หรือไม่?')" style="margin: 0;">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || ''}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="dm-close-btn" title="ปิดแชตนี้">✕</button>
                                        </form>
                                    </div>
                                `;
                            });
                            dmList.innerHTML = html;
                        } else if (dmList && data.dm_rooms.length === 0) {
                            dmList.innerHTML = `
                                <div class="sidebar-empty-hint" onclick="openNewDmModal()">
                                    <span>ยังไม่มีแชตส่วนตัว</span>
                                    <span class="btn-hint-add">＋ เริ่มคุยกับเพื่อนร่วมงาน</span>
                                </div>
                            `;
                        }
                    }
                }

            } catch (err) {
                // background sync silent catch
            } finally {
                isSyncing = false;
            }
        };

        // Start real-time background sync polling every 2.5 seconds
        setTimeout(window.runGlobalRealtimeSync, 1000);
        setInterval(window.runGlobalRealtimeSync, 2500);

        window.copyNewsLink = function(newsId) {
            const url = `${window.location.origin}/dashboard?view=news#newsCard${newsId}`;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    alert('คัดลอกลิงก์ประกาศข่าวแล้ว! คุณสามารถนำไปวางในห้องแชตเพื่อแชร์ให้เพื่อนร่วมงานได้ทันที');
                }).catch(() => {
                    prompt('คัดลอกลิงก์ด้านล่าง:', url);
                });
            } else {
                prompt('คัดลอกลิงก์ด้านล่าง:', url);
            }
        };

        // Auto-open settings modal if there are profile validation errors
        @if(isset($errors) && $errors->has('name'))
            openSettingsModal();
        @endif

        window.addEventListener('popstate', (e) => {
            const params = new URLSearchParams(window.location.search);
            const view = params.get('view') || (params.get('room') ? 'chat' : 'chat');
            window.switchDashboardView(view);
        });
    });
</script>

</body>
</html>