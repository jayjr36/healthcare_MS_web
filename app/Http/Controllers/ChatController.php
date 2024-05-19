<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    public function createChat(Request $request)
    {
        $chat = Chat::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => Auth::id(),
        ]);

        return response()->json($chat);
    }

    public function sendMessage(Request $request, $chatId)
    {
        $message = Message::create([
            'chat_id' => $chatId,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function getMessages($chatId)
    {
        $messages = Message::where('chat_id', $chatId)->with('user')->get();

        return response()->json($messages);
    }
}
