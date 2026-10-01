<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->position, ['ผู้ดูแลระบบ', 'แอดมิน', 'Admin'])) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าหน้านี้');
        }

        $users = User::orderBy('name')->get();

        return view('users.index', compact('users'));
    }

    public function updatePosition(Request $request, User $user)
    {
        if (!in_array(auth()->user()->position, ['ผู้ดูแลระบบ', 'แอดมิน', 'Admin'])) {
            abort(403, 'คุณไม่มีสิทธิ์เปลี่ยนตำแหน่ง');
        }

        $request->validate([
            'position' => 'required|in:พนักงาน,หัวหน้างาน,ผู้บริหาร,ผู้จัดการ,ผู้ดูแลระบบ,แอดมิน',
        ]);

        $user->update([
            'position' => $request->position,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'เปลี่ยนตำแหน่งเรียบร้อยแล้ว');
    }
}