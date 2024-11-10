<?php

namespace Core\Models;

class BaseModel {
    public function __get($name) {
        return $this->$name ?? NULL;
    }

    public function __set($name, $value) {
        return $this->$name = $value;
    }

    public function getCreatedAt() {
        return date('d-m-Y H:i', strtotime($this->created_at));
    }
}
