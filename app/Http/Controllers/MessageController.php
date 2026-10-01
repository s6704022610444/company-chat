<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
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
        broadcast(new MessageSent($message));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'room_id' => $message->room_id,
                    'user_id' => $message->user_id,
                    'user_name' => $message->user ? $message->user->name : 'User',
                    'created_at' => $message->created_at ? $message->created_at->format('H:i') : '',
                ],
            ]);
        }

        return redirect()->route('dashboard', [
            'room' => $request->room_id,
        ]);
    }
}