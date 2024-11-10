<?php

namespace Core\Models;

require_once __DIR__ . "/../../vendor/autoload.php";

use Core\DB\QueryBuilder;
use Core\Helpers\Auth;

class Chat extends BaseModel {

    protected static $table = 'chat';

    public static function query() {
        $query = new QueryBuilder();
        $query->setTable(self::$table);
        $query->setModel(self::class);
        return $query;
    }

    public function getUnSeenMessageCount() {
        $authId = Auth::user()->id;
        $user_type = Auth::userType();
        $this->count = self::query()->where("
            `sender_id`={$this->other_id} AND
            `reciever_id`={$authId} AND
            `seen_$user_type`=0
        ")->count();
        return $this->count;
    }

}
