<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
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

    public function getMessages($doctorId, $patientId)
    {
        $chat = Chat::where('doctor_id', $doctorId)
                     ->where('patient_id', $patientId)
                     ->firstOrFail();

        $messages = Message::where('chat_id', $chat->id)
                           ->with('user')
                           ->get();

        return response()->json($messages);
    }

    // public function getMessages($chatId)
    // {
    //     $messages = Message::where('chat_id', $chatId)->with('user')->get();

    //     return response()->json($messages);
    // }

    public function index()
    {
        $chats = Message::where('sender_id', Auth::id())
                        ->orWhere('receiver_id', Auth::id())
                        ->get();
        return view('chats.index', compact('chats'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
                            $query->where('sender_id', Auth::id())
                                  ->where('receiver_id', $user->id);
                        })
                        ->orWhere(function ($query) use ($user) {
                            $query->where('sender_id', $user->id)
                                  ->where('receiver_id', Auth::id());
                        })
                        ->get();
        return view('chats.show', compact('user', 'messages'));
    }

    public function apiIndex()
    {
        $chats = Message::where('sender_id', Auth::id())
                        ->orWhere('receiver_id', Auth::id())
                        ->get();
        return $chats;
    }

    public function apiShow(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
                            $query->where('sender_id', Auth::id())
                                  ->where('receiver_id', $user->id);
                        })
                        ->orWhere(function ($query) use ($user) {
                            $query->where('sender_id', $user->id)
                                  ->where('receiver_id', Auth::id());
                        })
                        ->get();
        return $messages;
    }

    public function apiSend(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return $message;
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function fetchMessages($userId) {
        $messages = Message::where(function($query) use ($userId) {
                            $query->where('receiver_id', auth()->id())
                                  ->orWhere('sender_id', auth()->id());
                        })
                        ->where(function($query) use ($userId) {
                            $query->where('receiver_id', $userId)
                                  ->orWhere('sender_id', $userId);
                        })
                        ->orderBy('created_at', 'asc')
                        ->get();
    
        $user = User::findOrFail($userId);
    
        return view('chats.show', compact('messages', 'user'));
    }
    
    
    

}
