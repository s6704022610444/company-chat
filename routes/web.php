<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyTaskController;
use App\Http\Controllers\DatabaseViewerController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RealtimeSyncController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    try {
        $user = auth()->user();

        // Self-healing migration check: automatically migrate if columns are missing
        $hasDirectCol = \Illuminate\Support\Facades\Schema::hasColumn('chat_rooms', 'is_direct');
        $hasDeletedCol = \Illuminate\Support\Facades\Schema::hasColumn('messages', 'is_deleted');

        if (!$hasDirectCol || !$hasDeletedCol) {
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                $hasDirectCol = \Illuminate\Support\Facades\Schema::hasColumn('chat_rooms', 'is_direct');
                $hasDeletedCol = \Illuminate\Support\Facades\Schema::hasColumn('messages', 'is_deleted');
            } catch (\Throwable $migErr) {
                \Illuminate\Support\Facades\Log::warning('Dashboard auto-migration notice: ' . $migErr->getMessage());
            }
        }

        // All relevant tasks for current user
        $tasks = \App\Models\Task::with(['creator', 'assignee'])
            ->where(function ($query) use ($user) {
                $query->where('assigned_to', $user->id)
                    ->orWhere('created_by', $user->id);
            })
            ->latest()
            ->get();

        // Urgent & important tasks for the notification bell
        $urgentTasks = \App\Models\Task::with(['creator', 'assignee'])
            ->where(function ($query) use ($user) {
                $query->where('assigned_to', $user->id)
                    ->orWhere('created_by', $user->id);
            })
            ->where('status', '!=', 'เสร็จแล้ว')
            ->where(function ($query) {
                $query->whereIn('priority', ['ด่วน', 'สูง'])
                    ->orWhere(function ($q) {
                        $q->whereNotNull('due_at')
                          ->where('due_at', '<=', now()->addDays(2));
                    });
            })
            ->orderByRaw("
                CASE
                    WHEN priority = 'ด่วน' THEN 1
                    WHEN priority = 'สูง' THEN 2
                    WHEN priority = 'ปกติ' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('due_at')
            ->get();

        // My tasks (for the embedded My Tasks view)
        $myTasks = \App\Models\Task::with(['creator', 'assignee', 'histories.user'])
            ->where('assigned_to', $user->id)
            ->where('status', '!=', 'เสร็จแล้ว')
            ->orderByRaw("
                CASE
                    WHEN priority = 'ด่วน' THEN 1
                    WHEN priority = 'สูง' THEN 2
                    WHEN priority = 'ปกติ' THEN 3
                    WHEN priority = 'ต่ำ' THEN 4
                    ELSE 5
                END
            ")
            ->orderBy('due_at')
            ->get();

        // All tasks (for the embedded All Tasks view)
        if (in_array($user->position, ['หัวหน้างาน', 'ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin'])) {
            $allTasks = \App\Models\Task::with(['creator', 'assignee', 'histories.user'])
                ->latest()
                ->get();
        } else {
            $allTasks = \App\Models\Task::with(['creator', 'assignee', 'histories.user'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->get();
        }

        $allUsers = \App\Models\User::orderBy('name')->get();

        $mentionUsers = $allUsers->map(function ($u) {
            $firstName = $u->resolved_first_name ?? ($u->name ? explode(' ', $u->name)[0] : 'User');
            return [
                'id' => $u->id,
                'name' => $u->name,
                'first_name' => $firstName,
                'position' => $u->position ?? 'พนักงาน',
                'position_color' => $u->position_color ?? '#00C853',
                'avatar' => $u->avatar,
            ];
        })->values();

        $notifications = $urgentTasks->count();

        $newTaskNotifications = \App\Models\Task::where('assigned_to', $user->id)
            ->where('status', 'ยังไม่เริ่ม')
            ->count();

        $myTasksCount = $myTasks->count();

        // Company News & Announcements
        $newsList = \App\Models\News::with(['user', 'likes'])
            ->orderByDesc('is_pinned')
            ->latest()
            ->get();
        $newsCount = $newsList->count();

        // Public rooms list
        if ($hasDirectCol) {
            $rooms = \App\Models\ChatRoom::where('is_direct', false)->orderBy('name')->get();
            $dmRooms = \App\Models\ChatRoom::with(['user1', 'user2'])
                ->where('is_direct', true)
                ->where(function ($q) use ($user) {
                    $q->where('user1_id', $user->id)->orWhere('user2_id', $user->id);
                })
                ->get();
        } else {
            $rooms = \App\Models\ChatRoom::orderBy('name')->get();
            $dmRooms = collect();
        }

        $selectedRoom = request('room');

        if (!$selectedRoom && $rooms->count() > 0) {
            $selectedRoom = $rooms->first()->id;
        }

        $selectedRoomModel = null;
        $messages = collect();

        if ($selectedRoom) {
            $selectedRoomModel = \App\Models\ChatRoom::with(['user1', 'user2'])->find($selectedRoom);
            if ($hasDirectCol && $selectedRoomModel && $selectedRoomModel->is_direct) {
                $isAdmin = $user->position === 'ผู้ดูแลระบบ';
                if ((int)$user->id !== (int)$selectedRoomModel->user1_id && (int)$user->id !== (int)$selectedRoomModel->user2_id && !$isAdmin) {
                    return redirect()->route('dashboard');
                }
            }

            if ($selectedRoomModel) {
                $msgQuery = \App\Models\Message::with('user')->where('room_id', $selectedRoom);
                if ($hasDeletedCol) {
                    $msgQuery->where('is_deleted', false);
                }
                $messages = $msgQuery->oldest()->get();
            }
        }

        $currentView = request('view', 'chat');
        if (!in_array($currentView, ['chat', 'my-tasks', 'all-tasks', 'news'])) {
            $currentView = 'chat';
        }

        $viewHtml = view('dashboard', compact(
            'rooms',
            'dmRooms',
            'selectedRoom',
            'selectedRoomModel',
            'messages',
            'tasks',
            'urgentTasks',
            'myTasks',
            'allTasks',
            'allUsers',
            'mentionUsers',
            'notifications',
            'newTaskNotifications',
            'myTasksCount',
            'newsList',
            'newsCount',
            'currentView'
        ))->render();

        return response($viewHtml);
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Dashboard error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return response('<div style="font-family:sans-serif;padding:30px;background:#0f172a;color:#f8fafc;min-height:100vh;">' .
            '<h2 style="color:#ef4444;">เกิดข้อผิดพลาดในการโหลดหน้าเว็บ</h2>' .
            '<p style="font-size:14px;color:#cbd5e1;background:#1e293b;padding:15px;border-radius:8px;">' . e($e->getMessage()) . '</p>' .
            '<a href="/dashboard" style="display:inline-block;margin-top:15px;padding:8px 16px;background:#3b82f6;color:#fff;text-decoration:none;border-radius:6px;font-size:13px;">รีเฟรชหน้าเว็บ</a>' .
            '</div>', 500);
    }
})->middleware('auth')->name('dashboard');

Route::post('/news', [NewsController::class, 'store'])
    ->middleware('auth')
    ->name('news.store');

Route::put('/news/{news}', [NewsController::class, 'update'])
    ->middleware('auth')
    ->name('news.update');

Route::delete('/news/{news}', [NewsController::class, 'destroy'])
    ->middleware('auth')
    ->name('news.destroy');

Route::post('/news/{news}/pin', [NewsController::class, 'togglePin'])
    ->middleware('auth')
    ->name('news.pin');

Route::post('/news/{news}/like', [NewsController::class, 'toggleLike'])
    ->middleware('auth')
    ->name('news.like');

Route::put('/profile', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update');

Route::get('/realtime/sync', [RealtimeSyncController::class, 'sync'])
    ->middleware('auth')
    ->name('realtime.sync');

Route::get('/messages', [MessageController::class, 'index'])
    ->middleware('auth')
    ->name('messages.index');

Route::post('/messages', [MessageController::class, 'store'])
    ->middleware('auth')
    ->name('messages.store');

Route::put('/messages/{message}', [MessageController::class, 'update'])
    ->middleware('auth')
    ->name('messages.update');

Route::delete('/messages/{message}', [MessageController::class, 'destroy'])
    ->middleware('auth')
    ->name('messages.destroy');

Route::get('/direct-chat/{user}', [MessageController::class, 'directChat'])
    ->middleware('auth')
    ->name('messages.directChat');

Route::get('/users', [UserManagementController::class, 'index'])
    ->middleware('auth')
    ->name('users.index');

Route::put('/users/{user}/position', [UserManagementController::class, 'updatePosition'])
    ->middleware('auth')
    ->name('users.position');

Route::get('/admin/database', [DatabaseViewerController::class, 'index'])
    ->middleware('auth')
    ->name('admin.database');

Route::post('/rooms', [ChatRoomController::class, 'store'])
    ->middleware('auth')
    ->name('rooms.store');

Route::delete('/rooms/{room}', [ChatRoomController::class, 'destroy'])
    ->middleware('auth')
    ->name('rooms.destroy');

Route::get('/tasks', function () {
    return redirect()->to('/dashboard?view=all-tasks');
})->middleware('auth')->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
    ->middleware('auth')
    ->name('tasks.store');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
    ->middleware('auth')
    ->name('tasks.edit');

Route::put('/tasks/{task}/details', [TaskController::class, 'updateDetails'])
    ->middleware('auth')
    ->name('tasks.updateDetails');

Route::put('/tasks/{task}', [TaskController::class, 'update'])
    ->middleware('auth')
    ->name('tasks.update');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->middleware('auth')
    ->name('tasks.destroy');

Route::get('/my-tasks', function () {
    return redirect()->to('/dashboard?view=my-tasks');
})->middleware('auth')->name('my.tasks');

Route::put('/my-tasks/{task}/status', [MyTaskController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('my.tasks.status');

