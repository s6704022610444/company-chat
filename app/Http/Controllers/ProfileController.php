<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีผู้ใช้งานในระบบแล้ว',
            'current_password.required_with' => 'กรุณาระบุรหัสผ่านปัจจุบันหากต้องการเปลี่ยนรหัสผ่าน',
            'password.min' => 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
            'password.confirmed' => 'การยืนยันรหัสผ่านใหม่ไม่ตรงกัน',
        ]);

        if (!empty($validated['password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง'])->withInput();
            }
            $user->password = Hash::make($validated['password']);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return back()->with('success', 'บันทึกข้อมูลผู้ใช้เรียบร้อยแล้ว');
    }
}
