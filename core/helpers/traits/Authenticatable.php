<?php

namespace Core\Helpers\Traits;

require_once __DIR__ . "/../../../vendor/autoload.php";

use Core\DB\QueryBuilder;
use Core\Helpers\Auth;
use Core\Models\BaseModel;

trait Authenticatable {

    public static function login(array $data): BaseModel|NULL {
        /**
         * @var QueryBuilder
         */
        $query = self::query();
        $model = $query->where("`email`='{$data['email']}'")->first();
        if ($model) {
            if (password_verify($data['password'], $model->password)) {
                $model->type = $data['user_type'];
                Auth::login($model);
                return $model;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

}
