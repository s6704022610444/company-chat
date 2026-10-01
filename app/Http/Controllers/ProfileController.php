<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'name' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'string'],
            'avatar_file' => ['nullable', 'image', 'max:10240'], // up to 10MB direct file
            'remove_avatar' => ['nullable'],
        ], [
            'first_name.required' => 'กรุณากรอกชื่อจริง',
            'avatar_file.image' => 'ไฟล์ที่เลือกต้องเป็นรูปภาพเท่านั้น',
            'avatar_file.max' => 'ขนาดไฟล์รูปภาพต้องไม่เกิน 10MB',
        ]);

        $firstName = trim($request->input('first_name') ?? '');
        $lastName = trim($request->input('last_name') ?? '');

        if (!empty($firstName)) {
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->name = trim($firstName . ' ' . $lastName);
        } elseif (!empty($request->input('name'))) {
            $parts = explode(' ', trim($request->input('name')), 2);
            $user->first_name = $parts[0];
            $user->last_name = $parts[1] ?? '';
            $user->name = trim($request->input('name'));
        }

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
