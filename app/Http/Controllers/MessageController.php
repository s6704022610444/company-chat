<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
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

        $messages = Message::with('user')
            ->where('room_id', $roomId)
            ->where('id', '>', $afterId)
            ->oldest()
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'message' => $msg->message ?? '',
                    'image' => $msg->image,
                    'audio' => $msg->audio,
                    'audio_duration' => $msg->audio_duration,
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
            'message' => 'nullable|string|max:2000',
            'room_id' => 'required|exists:chat_rooms,id',
            'image' => 'nullable|string',
            'audio' => 'nullable|string',
            'audio_duration' => 'nullable|integer',
        ]);

        $text = trim($request->input('message') ?? '');
        $image = $request->input('image');
        $audio = $request->input('audio');
        $audioDuration = $request->input('audio_duration');

        if ($text === '' && empty($image) && empty($audio)) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'error' => 'กรุณากรอกข้อความ แนบรูปภาพ หรือบันทึกเสียง'], 422);
            }
            return back()->withErrors(['message' => 'กรุณากรอกข้อความ แนบรูปภาพ หรือบันทึกเสียง']);
        }

        $message = Message::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'message' => $text,
            'image' => $image,
            'audio' => $audio,
            'audio_duration' => $audioDuration,
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
}