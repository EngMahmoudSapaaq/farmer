<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\Helpers\Auth;
use PDO;

class AuthModel {

    protected $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function markAllChatMessagesAsSeen($other_id) {
        $id = $this->user->id;
        $user_type = $this->user->type;
        return Chat::query()->where("
            (`sender_id`=$id AND `reciever_id`=$other_id AND `sender_user_type`='$user_type')
            OR
            (`reciever_id`=$id AND `sender_id`=$other_id AND `sender_user_type`!='$user_type')
        ")->update("`seen_$user_type`=1");
    }

    public function markAllChatMessagesAsSeenALL() {
        $id = $this->user->id;
        $user_type = $this->user->type;
        return Chat::query()->where("
            (`sender_id`=$id AND `sender_user_type`='$user_type')
            OR
            (`reciever_id`=$id AND `sender_user_type`!='$user_type')
        ")->update("`seen_$user_type`=1");
    }
    
    public function getAllChatMessages($other_id) {
        $id = $this->user->id;
        $user_type = $this->user->type;
        return Chat::query()->where("
            (`sender_id`=$id AND `sender_user_type`='$user_type' AND `reciever_id`=$other_id)
            OR
            (`reciever_id`=$id AND `sender_user_type`!='$user_type' AND `sender_id`=$other_id)
            ORDER BY `created_at`
        ")->get();
    }

    public function getAllUsersChats() {
        $id = $this->user->id;
        $user_type = $this->user->type;
        $chats = Chat::query()->execute("
            SELECT IF(`sender_user_type`='$user_type', `reciever_id`, `sender_id`) AS other_id, chat.*
            FROM `chat`
            WHERE
            (`sender_id`=$id AND `sender_user_type`='$user_type')
            OR
            (`reciever_id`=$id AND `sender_user_type`!='$user_type')
            ORDER BY `created_at` DESC
        ")->fetchAll(PDO::FETCH_CLASS, Chat::class);
        $others = array_unique(array_column($chats, 'other_id'));
        $res = [];
        foreach ($chats as $chat) {
            $i = array_search($chat->other_id, $others);
            // echo var_dump($i) . '<br>';
            if ($i !== false) {
                $res[] = $chat;
                unset($others[$i]);
            }
            // echo var_dump($others) . '<br>';
        }
        // echo var_dump($res);die;
        return $res;
    }

}
