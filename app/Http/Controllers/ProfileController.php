<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
        ]);

        $user->name = $validated['name'];
        $user->save();

        return back()->with('success', 'บันทึกชื่อผู้ใช้เรียบร้อยแล้ว');
    }
}
