<?php

namespace App\Http\Controllers;

use App\Events\MessageDeleted;
use App\Events\MessageSent;
use App\Events\MessageUpdated;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $roomId = $request->query('room_id');
        $afterId = $request->query('after_id', 0);

        if (!$roomId) {
            return response()->json([]);
        }

        $room = ChatRoom::find($roomId);
        if (!$room) {
            return response()->json([]);
        }

        $hasDirectCol = \Illuminate\Support\Facades\Schema::hasColumn('chat_rooms', 'is_direct');
        $hasDeletedCol = \Illuminate\Support\Facades\Schema::hasColumn('messages', 'is_deleted');

        // Privacy check for Direct Messages
        if ($hasDirectCol && $room->is_direct) {
            $myId = auth()->id();
            $isAdmin = auth()->user()->position === 'ผู้ดูแลระบบ';
            if ((int)$myId !== (int)$room->user1_id && (int)$myId !== (int)$room->user2_id && !$isAdmin) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $query = Message::with('user')
            ->where('room_id', $roomId)
            ->where('id', '>', $afterId);

        if ($hasDeletedCol) {
            $query->where('is_deleted', false);
        }

        $messages = $query->oldest()
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message ?? '',
                    'image' => $msg->image,
                    'audio' => $msg->audio,
                    'audio_duration' => $msg->audio_duration,
                    'file_data' => $msg->file_data,
                    'file_name' => $msg->file_name,
                    'file_size' => $msg->file_size,
                    'file_formatted_size' => $msg->formatted_file_size,
                    'file_type' => $msg->file_type,
                    'is_edited' => (bool)$msg->is_edited,
                    'is_deleted' => (bool)$msg->is_deleted,
                    'room_id' => $msg->room_id,
                    'user_id' => $msg->user_id,
                    'user_name' => $msg->user ? $msg->user->name : 'User',
                    'user_first_name' => $msg->user ? $msg->user->resolved_first_name : 'User',
                    'user_position' => $msg->user ? ($msg->user->position ?: 'พนักงาน') : 'พนักงาน',
                    'user_position_color' => $msg->user ? $msg->user->position_color : '#00C853',
                    'user_display_name' => $msg->user ? $msg->user->chat_display_name : 'User',
                    'user_avatar' => $msg->user ? $msg->user->avatar : null,
                    'created_at' => $msg->created_at ? $msg->created_at->format('H:i') : '',
                ];
            });

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'nullable|string|max:4000',
            'room_id' => 'required|exists:chat_rooms,id',
            'image' => 'nullable|string',
            'audio' => 'nullable|string',
            'audio_duration' => 'nullable|integer',
            'file_data' => 'nullable|string',
            'file_name' => 'nullable|string|max:255',
            'file_size' => 'nullable|integer',
            'file_type' => 'nullable|string|max:100',
        ]);

        $room = ChatRoom::findOrFail($request->room_id);

        // Privacy check for Direct Messages
        if ($room->is_direct) {
            $myId = auth()->id();
            $isAdmin = auth()->user()->position === 'ผู้ดูแลระบบ';
            if ($myId !== $room->user1_id && $myId !== $room->user2_id && !$isAdmin) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        $text = trim($request->input('message') ?? '');
        $image = $request->input('image');
        $audio = $request->input('audio');
        $audioDuration = $request->input('audio_duration');
        $fileData = $request->input('file_data');
        $fileName = $request->input('file_name');
        $fileSize = $request->input('file_size');
        $fileType = $request->input('file_type');

        if ($text === '' && empty($image) && empty($audio) && empty($fileData)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'error' => 'กรุณากรอกข้อความ แนบรูปภาพ บันทึกเสียง หรือแนบไฟล์เอกสาร'], 422);
            }
            return back()->withErrors(['message' => 'กรุณากรอกข้อความ แนบรูปภาพ บันทึกเสียง หรือแนบไฟล์เอกสาร']);
        }

        $message = Message::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'message' => $text,
            'image' => $image,
            'audio' => $audio,
            'audio_duration' => $audioDuration,
            'file_data' => $fileData,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'file_type' => $fileType,
        ]);

        $message->load('user');

        // Broadcast to WebSocket channel
        try {
            broadcast(new MessageSent($message));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Broadcast error: ' . $e->getMessage());
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message ?? '',
                    'image' => $message->image,
                    'audio' => $message->audio,
                    'audio_duration' => $message->audio_duration,
                    'file_data' => $message->file_data,
                    'file_name' => $message->file_name,
                    'file_size' => $message->file_size,
                    'file_formatted_size' => $message->formatted_file_size,
                    'file_type' => $message->file_type,
                    'is_edited' => false,
                    'is_deleted' => false,
                    'room_id' => $message->room_id,
                    'user_id' => $message->user_id,
                    'user_name' => $message->user ? $message->user->name : 'User',
                    'user_first_name' => $message->user ? $message->user->resolved_first_name : 'User',
                    'user_position' => $message->user ? ($message->user->position ?: 'พนักงาน') : 'พนักงาน',
                    'user_position_color' => $message->user ? $message->user->position_color : '#00C853',
                    'user_display_name' => $message->user ? $message->user->chat_display_name : 'User',
                    'user_avatar' => $message->user ? $message->user->avatar : null,
                    'created_at' => $message->created_at ? $message->created_at->format('H:i') : '',
                ],
            ]);
        }

        return redirect()->route('dashboard', [
            'room' => $request->room_id,
        ]);
    }

    /**
     * Edit message text
     */
    public function update(Request $request, Message $message)
    {
        $myId = auth()->id();
        $isAdmin = auth()->user()->position === 'ผู้ดูแลระบบ';

        if ($message->user_id !== $myId && !$isAdmin) {
            return response()->json(['error' => 'ไม่มีสิทธิ์แก้ไขข้อความนี้'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:4000',
        ]);

        $message->update([
            'message' => trim($request->input('message')),
            'is_edited' => true,
        ]);

        try {
            broadcast(new MessageUpdated($message));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Broadcast edit error: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'message' => $message->message,
                'is_edited' => true,
                'room_id' => $message->room_id,
            ],
        ]);
    }

    /**
     * Delete message
     */
    public function destroy(Request $request, Message $message)
    {
        $myId = auth()->id();
        $isAdmin = auth()->user()->position === 'ผู้ดูแลระบบ';

        if ($message->user_id !== $myId && !$isAdmin) {
            return response()->json(['error' => 'ไม่มีสิทธิ์ลบข้อความนี้'], 403);
        }

        $messageId = $message->id;
        $roomId = $message->room_id;

        $message->update([
            'is_deleted' => true,
            'message' => null,
            'image' => null,
            'audio' => null,
            'file_data' => null,
            'file_name' => null,
        ]);

        try {
            broadcast(new MessageDeleted($messageId, $roomId));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Broadcast delete error: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'id' => $messageId,
            'room_id' => $roomId,
        ]);
    }

    /**
     * Open or create Direct Message with another user
     */
    public function directChat(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('dashboard');
        }

        $room = ChatRoom::getOrCreateDirectRoom(auth()->id(), $user->id);

        return redirect()->route('dashboard', [
            'room' => $room->id,
            'view' => 'chat',
        ]);
    }
}