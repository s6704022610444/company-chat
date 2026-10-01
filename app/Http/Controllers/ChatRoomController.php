<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function store(Request $request)
    {
        // ผู้จัดการและผู้ดูแลระบบเท่านั้นที่สร้างห้องได้
        if (!in_array(auth()->user()->position, ['ผู้จัดการ', 'ผู้ดูแลระบบ'])) {
            abort(403, 'คุณไม่มีสิทธิ์สร้างห้องแชต');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        ChatRoom::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'สร้างห้องแชตเรียบร้อยแล้ว');
    }

    public function destroy(ChatRoom $room)
    {
        // ผู้ดูแลระบบเท่านั้น
        if (auth()->user()->position !== 'ผู้ดูแลระบบ') {
            abort(403, 'คุณไม่มีสิทธิ์ลบห้อง');
        }

        // ป้องกันไม่ให้ลบห้องสุดท้าย
         if (\App\Models\ChatRoom::count() <= 1) {
            return redirect()->route('dashboard')
                ->with('error', 'ไม่สามารถลบห้องสุดท้ายได้');
        }

        $room->delete();

        return redirect()->route('dashboard')
            ->with('success', 'ลบห้องเรียบร้อยแล้ว');
    }
}