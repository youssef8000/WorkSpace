<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        $userEmail = Auth::user()->email;
        $chats = Chat::where('senderEmail', $userEmail)
                      ->orWhere('receiveEmail', $userEmail)
                      ->with(['sender', 'receiver'])
                      ->get();

        return view('frontend.Message.chat', ['chats' => $chats]);
    }


    public function create($email)
    {
        $userEmail = Auth::user()->email;
        $chatWithUser = User::where('email', $email)->first();

        if (!$chatWithUser) {
            abort(404);
        }

        $chats = Chat::where(function ($query) use ($userEmail, $email) {
            $query->where('senderEmail', $userEmail)
                  ->where('receiveEmail', $email);
        })->orWhere(function ($query) use ($userEmail, $email) {
            $query->where('senderEmail', $email)
                  ->where('receiveEmail', $userEmail);
        })->get();

        $messages = Message::where(function ($query) use ($userEmail, $email) {
            $query->where('senderEmail', $userEmail)
                  ->where('receiveEmail', $email);
        })->orWhere(function ($query) use ($userEmail, $email) {
            $query->where('senderEmail', $email)
                  ->where('receiveEmail', $userEmail);
        })->orderBy('created_at', 'asc')
          ->get();

        return view('frontend.Message.message', [
            'chatWithUser' => $chatWithUser,
            'chats' => $chats,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request, $email)
{
    $request->validate([
        'message' => 'required|string|max:255',
        'chat_id' => 'required',
    ]);

    $senderEmail = Auth::user()->email;
    $receiverEmail = $email;
    Message::create([
        'chat_id'=>$request->input('chat_id'),
        'senderEmail' => $senderEmail,
        'receiveEmail' => $receiverEmail,
        'message' => $request->input('message'),
    ]);

    return redirect()->route('chats.create', ['email' => $receiverEmail])->with('success', 'Message sent successfully.');
}

    public function startChat(Request $request)
    {
        $request->validate([
            'receiveEmail' => 'required|email',
        ]);
        $senderEmail = Auth::user()->email;
        $receiveEmail = $request->input('receiveEmail');

        $existingChat = Chat::where(function($query) use ($senderEmail, $receiveEmail) {
            $query->where('senderEmail', $senderEmail)
                  ->where('receiveEmail', $receiveEmail);
        })->orWhere(function($query) use ($senderEmail, $receiveEmail) {
            $query->where('senderEmail', $receiveEmail)
                  ->where('receiveEmail', $senderEmail);
        })->first();

        if (!$existingChat) {
            $chat = new Chat();
            $chat->senderEmail = $senderEmail;
            $chat->receiveEmail = $receiveEmail;
            $chat->save();
        }
        $chats = Chat::where('senderEmail', $senderEmail)
                      ->orWhere('receiveEmail', $senderEmail)
                      ->with(['sender', 'receiver'])
                      ->get();

        return view('frontend.Message.chat', ['chats' => $chats])->with('success', 'Chat started successfully.');
    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
