<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function store(Request $request)
    {
        $isPrivate = $request->boolean('is_private');

        // หากเป็นห้องสาธารณะ ผู้บริหาร ผู้จัดการ และผู้ดูแลระบบเท่านั้นที่สร้างห้องได้
        // หากเป็นห้องเฉพาะกลุ่ม (Private Group) อนุญาตให้พนักงานทุกคนสร้างได้
        if (!$isPrivate && !in_array(auth()->user()->position, ['ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin', 'Executive', 'Manager'])) {
            abort(403, 'คุณไม่มีสิทธิ์สร้างห้องแชตสาธารณะ');
        }

        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:500',
            'is_private' => 'nullable|boolean',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:users,id',
        ], [
            'name.required' => 'กรุณาระบุชื่อห้องแชต',
            'name.max' => 'ชื่อห้องแชตต้องมีความยาวไม่เกิน 30 ตัวอักษร',
        ]);

        $room = ChatRoom::create([
            'name' => trim($request->name),
            'description' => $request->description,
            'created_by' => auth()->id(),
            'is_private' => $isPrivate,
        ]);

        // กำหนดผู้สร้างห้องเป็น admin ในตารางสมาชิก
        $room->members()->attach(auth()->id(), ['role' => 'admin']);

        // เพิ่มสมาชิกที่เลือกไว้ตอนสร้างห้อง
        if ($isPrivate && !empty($request->member_ids)) {
            foreach ($request->member_ids as $memberId) {
                if ((int)$memberId !== (int)auth()->id()) {
                    $room->members()->syncWithoutDetaching([$memberId => ['role' => 'member']]);
                }
            }
        }

        return redirect()->route('dashboard', ['room' => $room->id])
            ->with('success', 'สร้างห้องแชตเรียบร้อยแล้ว');
    }

    public function update(Request $request, ChatRoom $room)
    {
        // ป้องกันการแก้ไขแชตส่วนตัว 1-ต่อ-1 ผ่านฟังก์ชันนี้
        if ($room->is_direct) {
            abort(403, 'ไม่สามารถแก้ไขชื่อบทสนทนาส่วนตัวได้');
        }

        if ($room->is_private) {
            if (!$room->isAdmin(auth()->id()) && auth()->user()->position !== 'ผู้ดูแลระบบ') {
                abort(403, 'คุณไม่มีสิทธิ์แก้ไขชื่อห้องนี้');
            }
        } else {
            // ผู้บริหาร ผู้จัดการ และผู้ดูแลระบบเท่านั้นที่แก้ไขห้องสาธารณะได้
            if (!in_array(auth()->user()->position, ['ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin', 'Executive', 'Manager'])) {
                abort(403, 'คุณไม่มีสิทธิ์แก้ไขชื่อห้องแชต');
            }
        }

        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:500',
        ], [
            'name.required' => 'กรุณาระบุชื่อห้องแชต',
            'name.max' => 'ชื่อห้องแชตต้องมีความยาวไม่เกิน 30 ตัวอักษร',
        ]);

        $room->update([
            'name' => trim($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard', ['room' => $room->id])
            ->with('success', 'แก้ไขชื่อห้องแชตเรียบร้อยแล้ว');
    }

    public function destroy(ChatRoom $room)
    {
        // กรณีเป็นแชตส่วนตัว 1-ต่อ-1
        if ($room->is_direct) {
            $myId = auth()->id();
            if ($room->user1_id !== $myId && $room->user2_id !== $myId && auth()->user()->position !== 'ผู้ดูแลระบบ') {
                abort(403, 'คุณไม่มีสิทธิ์ปิดบทสนทนานี้');
            }
            $room->delete();
            return redirect()->route('dashboard')
                ->with('success', 'ปิดบทสนทนาส่วนตัวเรียบร้อยแล้ว');
        }

        // กรณีเป็นห้องเฉพาะกลุ่ม
        if ($room->is_private) {
            if ($room->created_by !== auth()->id() && auth()->user()->position !== 'ผู้ดูแลระบบ') {
                abort(403, 'คุณไม่มีสิทธิ์ลบห้องเฉพาะกลุ่มนี้');
            }
            $room->delete();
            return redirect()->route('dashboard')
                ->with('success', 'ลบห้องเฉพาะกลุ่มเรียบร้อยแล้ว');
        }

        // กรณีเป็นห้องแชตสาธารณะ (ผู้ดูแลระบบเท่านั้น)
        if (auth()->user()->position !== 'ผู้ดูแลระบบ') {
            abort(403, 'คุณไม่มีสิทธิ์ลบห้อง');
        }

        // ป้องกันไม่ให้ลบห้องสาธารณะสุดท้าย
        if (ChatRoom::where('is_direct', false)->where('is_private', false)->count() <= 1) {
            return redirect()->route('dashboard')
                ->with('error', 'ไม่สามารถลบห้องสาธารณะสุดท้ายได้');
        }

        $room->delete();

        return redirect()->route('dashboard')
            ->with('success', 'ลบห้องเรียบร้อยแล้ว');
    }

    /**
     * ดึงรายชื่อสมาชิกในห้องและรายชื่อผู้ใช้ที่ยังไม่ได้อยู่ในห้อง
     */
    public function getMembers(ChatRoom $room)
    {
        if (!$room->canAccess(auth()->id())) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $nonMembers = collect();

        // ห้องสาธารณะ: ทุกคนในระบบถือเป็นสมาชิก
        if (!$room->is_private && !$room->is_direct) {
            $allUsers = User::select('id', 'name', 'first_name', 'last_name', 'position', 'avatar')
                ->orderBy('name')
                ->get();

            // ดึง pivot สำหรับ role
            $pivotRoles = $room->members()->pluck('chat_room_users.role', 'users.id');
            $creatorId = $room->created_by;

            $members = $allUsers->map(function ($u) use ($room, $pivotRoles, $creatorId) {
                $isCreator = $u->id === $creatorId;
                return [
                    'id' => $u->id,
                    'name' => $u->name,
                    'first_name' => $u->resolved_first_name,
                    'display_name' => $u->chat_display_name,
                    'position' => $u->position ?: 'พนักงาน',
                    'position_color' => $u->position_color,
                    'avatar' => $u->avatar,
                    'role' => $isCreator ? 'admin' : ($pivotRoles[$u->id] ?? 'member'),
                    'is_creator' => $isCreator,
                ];
            });

            // ไม่มี non_members สำหรับห้องสาธารณะ
            $nonMembers = collect();
        } else {
            // ห้องเฉพาะกลุ่มหรือ DM: ดึงเฉพาะจาก pivot
            $members = $room->members()
                ->select('users.id', 'users.name', 'users.first_name', 'users.last_name', 'users.position', 'users.avatar')
                ->get()
                ->map(function ($u) use ($room) {
                    return [
                        'id' => $u->id,
                        'name' => $u->name,
                        'first_name' => $u->resolved_first_name,
                        'display_name' => $u->chat_display_name,
                        'position' => $u->position ?: 'พนักงาน',
                        'position_color' => $u->position_color,
                        'avatar' => $u->avatar,
                        'role' => $u->pivot->role ?? 'member',
                        'is_creator' => $room->created_by === $u->id,
                    ];
                });

            // ตรวจสอบว่าผู้สร้างห้องถูกรวมอยู่ในลิสต์หรือไม่
            $memberIds = $members->pluck('id')->toArray();
            if ($room->created_by && !in_array($room->created_by, $memberIds)) {
                $creator = $room->creator;
                if ($creator) {
                    $members->prepend([
                        'id' => $creator->id,
                        'name' => $creator->name,
                        'first_name' => $creator->resolved_first_name,
                        'display_name' => $creator->chat_display_name,
                        'position' => $creator->position ?: 'พนักงาน',
                        'position_color' => $creator->position_color,
                        'avatar' => $creator->avatar,
                        'role' => 'admin',
                        'is_creator' => true,
                    ]);
                    $memberIds[] = $creator->id;
                }
            }

            // ผู้ใช้ที่ยังไม่ได้อยู่ในห้อง
            $nonMembers = User::select('id', 'name', 'first_name', 'last_name', 'position', 'avatar')
                ->whereNotIn('id', $memberIds)
                ->orderBy('name')
                ->get()
                ->map(function ($u) {
                    return [
                        'id' => $u->id,
                        'name' => $u->name,
                        'first_name' => $u->resolved_first_name,
                        'display_name' => $u->chat_display_name,
                        'position' => $u->position ?: 'พนักงาน',
                        'position_color' => $u->position_color,
                        'avatar' => $u->avatar,
                    ];
                });
        }

        $canManage = $room->created_by === auth()->id() 
            || auth()->user()->position === 'ผู้ดูแลระบบ' 
            || $room->isAdmin(auth()->id());

        return response()->json([
            'success' => true,
            'room_id' => $room->id,
            'room_name' => $room->name,
            'is_private' => (bool)$room->is_private,
            'can_manage' => $canManage,
            'members' => $members,
            'non_members' => $nonMembers,
        ]);
    }

    /**
     * เพิ่มสมาชิกเข้าห้องแชต
     */
    public function addMembers(Request $request, ChatRoom $room)
    {
        if (!$room->isAdmin(auth()->id()) && auth()->user()->position !== 'ผู้ดูแลระบบ') {
            return response()->json(['success' => false, 'message' => 'คุณไม่มีสิทธิ์เพิ่มสมาชิกในห้องนี้'], 403);
        }

        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        foreach ($request->user_ids as $uId) {
            $room->members()->syncWithoutDetaching([$uId => ['role' => 'member']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'เพิ่มสมาชิกเรียบร้อยแล้ว',
        ]);
    }

    /**
     * ลบสมาชิกออกจากห้องแชต
     */
    public function removeMember(Request $request, ChatRoom $room, User $user)
    {
        if (!$room->isAdmin(auth()->id()) && auth()->user()->position !== 'ผู้ดูแลระบบ') {
            return response()->json(['success' => false, 'message' => 'คุณไม่มีสิทธิ์ลบสมาชิกในห้องนี้'], 403);
        }

        if ($room->created_by === $user->id) {
            return response()->json(['success' => false, 'message' => 'ไม่สามารถลบผู้สร้างห้องออกได้'], 422);
        }

        $room->members()->detach($user->id);

        return response()->json([
            'success' => true,
            'message' => 'นำสมาชิกออกจากห้องเรียบร้อยแล้ว',
        ]);
    }
}