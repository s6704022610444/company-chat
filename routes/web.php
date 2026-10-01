<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyTaskController;
use App\Http\Controllers\DatabaseViewerController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $rooms = \App\Models\ChatRoom::orderBy('name')->get();

    // Urgent banner tasks
    $tasks = \App\Models\Task::with(['creator', 'assignee'])
        ->where(function ($query) use ($user) {
            $query->where('assigned_to', $user->id)
                ->orWhere('created_by', $user->id);
        })
        ->latest()
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
    if (in_array($user->position, ['หัวหน้างาน', 'ผู้จัดการ', 'ผู้ดูแลระบบ'])) {
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

    $notifications = \App\Models\Task::where('assigned_to', $user->id)
        ->where('status', '!=', 'เสร็จแล้ว')
        ->whereNotNull('due_at')
        ->where('due_at', '<=', now()->addDay())
        ->count();

    $newTaskNotifications = \App\Models\Task::where('assigned_to', $user->id)
        ->where('status', 'ยังไม่เริ่ม')
        ->count();

    $myTasksCount = $myTasks->count();

    $selectedRoom = request('room');

    if (!$selectedRoom && $rooms->count() > 0) {
        $selectedRoom = $rooms->first()->id;
    }

    $messages = collect();

    if ($selectedRoom) {
        $messages = \App\Models\Message::with('user')
            ->where('room_id', $selectedRoom)
            ->oldest()
            ->get();
    }

    $currentView = request('view', 'chat');
    if (!in_array($currentView, ['chat', 'my-tasks', 'all-tasks'])) {
        $currentView = 'chat';
    }

    return view('dashboard', compact(
        'rooms',
        'selectedRoom',
        'messages',
        'tasks',
        'myTasks',
        'allTasks',
        'allUsers',
        'notifications',
        'newTaskNotifications',
        'myTasksCount',
        'currentView'
    ));
})->middleware('auth')->name('dashboard');

Route::get('/messages', [MessageController::class, 'index'])
    ->middleware('auth')
    ->name('messages.index');

Route::post('/messages', [MessageController::class, 'store'])
    ->middleware('auth')
    ->name('messages.store');

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

