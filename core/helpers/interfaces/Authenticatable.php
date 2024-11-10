<?php

namespace Core\Helpers\Interfaces;

use Core\Models\BaseModel;

interface Authenticatable {

    public static function login(array $data): BaseModel|NULL;

}
