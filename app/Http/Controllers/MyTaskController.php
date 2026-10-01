<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskHistory;

class MyTaskController extends Controller
{
    public function index()
    {
        return redirect()->to('/dashboard?view=my-tasks');
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

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'task_id' => $task->id,
                'status' => $task->status,
                'message' => 'อัปเดตสถานะงานเรียบร้อยแล้ว',
            ]);
        }

        return redirect()
            ->to('/dashboard?view=my-tasks')
            ->with('success', 'อัปเดตสถานะงานเรียบร้อยแล้ว');
    }
}