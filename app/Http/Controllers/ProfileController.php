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
            'avatar' => ['nullable', 'string'],
            'avatar_file' => ['nullable', 'image', 'max:10240'], // up to 10MB direct file
            'remove_avatar' => ['nullable'],
        ], [
            'name.required' => 'กรุณากรอกชื่อ-นามสกุล',
            'avatar_file.image' => 'ไฟล์ที่เลือกต้องเป็นรูปภาพเท่านั้น',
            'avatar_file.max' => 'ขนาดไฟล์รูปภาพต้องไม่เกิน 10MB',
        ]);

        $user->name = $validated['name'];

        if ($request->input('remove_avatar') == '1' || $request->input('remove_avatar') === true) {
            $user->avatar = null;
        } elseif (!empty($validated['avatar']) && str_starts_with($validated['avatar'], 'data:image/')) {
            $user->avatar = $validated['avatar'];
        } elseif ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            if ($file->isValid()) {
                $mime = $file->getMimeType();
                $base64 = base64_encode(file_get_contents($file->getRealPath()));
                $user->avatar = 'data:' . $mime . ';base64,' . $base64;
            }
        }

        $user->save();

        return back()->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
}
