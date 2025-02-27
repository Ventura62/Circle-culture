<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'receiver_id' => $request->receiver_id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
