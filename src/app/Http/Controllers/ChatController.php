<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Chat;
use App\Models\Room;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function openChat(User $user)
    {
        // 自分と相手のIDを取得
        $myUserId = auth()->user()->id;
        $otherUserId = $user->id; // ここで相手のユーザーIDを指定

        // データベース内でチャットが存在するかを確認
        $chat = Room::where(function($query) use ($myUserId, $otherUserId) {
            $query->where('owner_id', $myUserId)
                ->where('guest_id', $otherUserId);
        })->orWhere(function($query) use ($myUserId, $otherUserId) {
            $query->where('owner_id', $otherUserId)
                ->where('guest_id', $myUserId);
        })->first();

        // チャットが存在しない場合、新しいチャットを作成
        if (!$chat) {
            $chat = new Room();
            $chat->owner_id = $myUserId;
            $chat->guest_id = $otherUserId;
            $chat->save();
        }

        $messages = Message::where('chat_id', $chat->id)->orderBy('updated_at', 'DESC')->get();;


        return view('chats/chat')->with(['chat' => $chat, 'messages' => $messages]);
    }
}