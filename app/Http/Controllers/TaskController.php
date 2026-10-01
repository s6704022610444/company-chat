<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaskHistory;

class TaskController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // หัวหน้า / ผู้จัดการ / แอดมิน เห็นงานทั้งหมด
        if (in_array($user->position, [
                'หัวหน้างาน',
                'ผู้จัดการ',
                'ผู้ดูแลระบบ'
            ])) {
                $tasks = Task::with([
                    'creator',
                    'assignee',
                    'histories.user'
                ])
                ->latest()
                ->get();
            } else {
                // พนักงานเห็นเฉพาะงานที่ตัวเองได้รับมอบหมาย
                $tasks = Task::with([
                    'creator',
                    'assignee',
                    'histories.user'
                ])
                ->where('assigned_to', $user->id)
                ->latest()
                ->get();
            }

        $users = User::orderBy('name')->get();

        return view('tasks.index', compact('tasks', 'users'));
    }

    public function store(Request $request)
    {
        // เฉพาะหัวหน้างาน ผู้จัดการ และผู้ดูแลระบบ
        if (!in_array(auth()->user()->position, [
            'หัวหน้างาน',
            'ผู้จัดการ',
            'ผู้ดูแลระบบ'
        ])) {
            abort(403, 'คุณไม่มีสิทธิ์สร้างงาน');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:ต่ำ,ปกติ,สูง,ด่วน',
            'due_at' => 'nullable|date',
            'assigned_to' => [
                'nullable',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);

                    if (!$user) {
                        return;
                    }

                    // ไม่อนุญาตให้มอบหมายงานให้ผู้ดูแลระบบ
                    if ($user->position === 'ผู้ดูแลระบบ') {
                        $fail('ไม่สามารถมอบหมายงานให้ผู้ดูแลระบบได้');
                    }
                },
            ],
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => auth()->id(),
            'assigned_to' => $request->assigned_to,
            'status' => 'ยังไม่เริ่ม',
            'priority' => $request->priority,
            'due_at' => $request->due_at,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'สร้างงานเรียบร้อยแล้ว');
    }

    public function edit(Task $task)
    {
        if (!in_array(auth()->user()->position, [
            'หัวหน้างาน',
            'ผู้จัดการ',
            'ผู้ดูแลระบบ'
        ])) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขงาน');
        }

        $users = User::where('position', '!=', 'ผู้ดูแลระบบ')
            ->orderBy('name')
            ->get();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function updateDetails(Request $request, Task $task)
    {
        if (!in_array(auth()->user()->position, [
            'หัวหน้างาน',
            'ผู้จัดการ',
            'ผู้ดูแลระบบ'
        ])) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขงาน');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => [
                'nullable',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);

                    if ($user && $user->position === 'ผู้ดูแลระบบ') {
                        $fail('ไม่สามารถมอบหมายงานให้ผู้ดูแลระบบได้');
                    }
                },
            ],
            'priority' => 'required|in:ต่ำ,ปกติ,สูง,ด่วน',
            'due_at' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'priority' => $request->priority,
            'due_at' => $request->due_at,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'แก้ไขงานเรียบร้อยแล้ว');
    }

    public function update(Request $request, Task $task)
    {
        $user = auth()->user();

        // คนที่ได้รับมอบหมายสามารถเปลี่ยนสถานะงานตัวเองได้
        $canUpdate =
            $task->assigned_to == $user->id ||
            in_array($user->position, [
                'หัวหน้างาน',
                'ผู้จัดการ',
                'ผู้ดูแลระบบ'
            ]);

        if (!$canUpdate) {
            abort(403, 'คุณไม่มีสิทธิ์แก้ไขงานนี้');
        }

        $request->validate([
            'status' => 'required|in:ยังไม่เริ่ม,รับงานแล้ว,กำลังดำเนินการ,เสร็จแล้ว',
        ]);

        $oldStatus = $task->status;

        $task->update([
            'status' => $request->status,
        ]);

        // บันทึกประวัติการเปลี่ยนสถานะ
        if ($oldStatus !== $request->status) {
            TaskHistory::create([
                'task_id' => $task->id,
                'user_id' => auth()->id(),
                'old_status' => $oldStatus,
                'new_status' => $request->status,
            ]);
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'อัปเดตสถานะงานเรียบร้อยแล้ว');
    }

    public function destroy(Task $task)
    {
        if (!in_array(auth()->user()->position, [
            'หัวหน้างาน',
            'ผู้จัดการ',
            'ผู้ดูแลระบบ'
        ])) {
            abort(403, 'คุณไม่มีสิทธิ์ลบงาน');
        }

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'ลบงานเรียบร้อยแล้ว');
    }
}