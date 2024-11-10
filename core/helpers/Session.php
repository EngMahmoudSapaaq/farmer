<?php 

namespace Core\Helpers;

class Session {
    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    public static function get($key) {
        if (self::has($key))
            if ($key == 'user')
                return unserialize($_SESSION[$key]);
            else
                return $_SESSION[$key];
        else
            return null;
    }

    public static function set($key, $value) {
        if ($key == 'user')
            $_SESSION[$key] = serialize($value);
        else
            $_SESSION[$key] = $value;
        return true;
    }

    public static function unset($key) {
        if (self::has($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        else
            return false;
    }

    public static function clear() {
        $_SESSION = [];
    }

    public static function all() {
        return $_SESSION;
    }
}
