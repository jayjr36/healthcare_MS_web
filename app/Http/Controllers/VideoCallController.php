<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoCallController extends Controller
{
    public function startCall(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'channel_name' => 'required',
        ]);

        // Store call information in database or perform necessary actions

        return response()->json(['message' => 'Video call started']);
    }

    public function endCall(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
        ]);

        return response()->json(['message' => 'Video call ended']);
    }
}
