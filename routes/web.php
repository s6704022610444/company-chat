<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyTaskController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $rooms = \App\Models\ChatRoom::orderBy('name')->get();

    $tasks = \App\Models\Task::with(['creator', 'assignee'])
        ->where(function ($query) {
            $query->where('assigned_to', auth()->id())
                ->orWhere('created_by', auth()->id());
        })
        ->latest()
        ->get();

    $notifications = \App\Models\Task::where('assigned_to', auth()->id())
        ->where('status', '!=', 'เสร็จแล้ว')
        ->whereNotNull('due_at')
        ->where('due_at', '<=', now()->addDay())
        ->count();

    $newTaskNotifications = \App\Models\Task::where('assigned_to', auth()->id())
        ->where('status', 'ยังไม่เริ่ม')
        ->count();

    $myTasksCount = \App\Models\Task::where('assigned_to', auth()->id())
        ->where('status', '!=', 'เสร็จแล้ว')
        ->count();

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

    return view('dashboard', compact(
        'rooms',
        'selectedRoom',
        'messages',
        'tasks',
        'notifications',
        'newTaskNotifications',
        'myTasksCount'
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

Route::post('/rooms', [ChatRoomController::class, 'store'])
    ->middleware('auth')
    ->name('rooms.store');

Route::delete('/rooms/{room}', [ChatRoomController::class, 'destroy'])
    ->middleware('auth')
    ->name('rooms.destroy');

Route::get('/tasks', [TaskController::class, 'index'])
    ->middleware('auth')
    ->name('tasks.index');

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

Route::get('/my-tasks', [MyTaskController::class, 'index'])
    ->middleware('auth')
    ->name('my.tasks');

Route::put('/my-tasks/{task}/status', [MyTaskController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('my.tasks.status');

