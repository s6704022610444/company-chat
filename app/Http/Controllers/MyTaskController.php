<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskHistory;

class MyTaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['histories.user'])
            ->where('assigned_to', auth()->id())
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

        return view('tasks.mine', compact('tasks'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        // ต้องเป็นคนที่ได้รับมอบหมายงานเท่านั้น
        if ($task->assigned_to !== auth()->id()) {
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
            ->to('/dashboard?view=my-tasks')
            ->with('success', 'อัปเดตสถานะงานเรียบร้อยแล้ว');
    }
}