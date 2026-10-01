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
                    'message' => $msg->message,
                    'room_id' => $msg->room_id,
                    'user_id' => $msg->user_id,
                    'user_name' => $msg->user ? $msg->user->name : 'User',
                    'user_avatar' => $msg->user ? $msg->user->avatar : null,
                    'created_at' => $msg->created_at ? $msg->created_at->format('H:i') : '',
                ];
            });

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'room_id' => 'required|exists:chat_rooms,id',
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'message' => $request->message,
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
                    'message' => $message->message,
                    'room_id' => $message->room_id,
                    'user_id' => $message->user_id,
                    'user_name' => $message->user ? $message->user->name : 'User',
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