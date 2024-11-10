<?php

namespace Core\Helpers;

class Request {

    public static function uri() {
        $uris = explode('/', trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        ));

        array_shift($uris);

        return implode('/', $uris);
    }

    public static function fullUri() {
        $uris = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        array_shift($uris);

        return implode('/', $uris);
    }

    public static function queryString() {
        return explode('?', self::fullUri())[1];
    }

    public static function method($method=null) {
        if ($method)
            return strtolower($method) == strtolower($_SERVER['REQUEST_METHOD']);
        else
            return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function has($key) {
        return !is_null(self::get($key));
    }

    public static function get($key, $method = null) {
        if ($method == 'get')
            return isset($_GET[$key]) ? $_GET[$key] : null;
        else if ($method == 'post')
            return isset($_POST[$key]) ? $_POST[$key] : null;
        else
            return isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;
    }

    public static function set($key, $value, $method = null) {
        if ($method == 'get')
            $_GET[$key] = $value;
        else if ($method == 'post')
            $_POST[$key] = $value;
        else
            $_REQUEST[$key] = $value;
    }

    public static function all($method = null) {
        if ($method == 'get')
            return $_GET;
        else if ($method == 'post')
            return $_POST;
        else
            return $_REQUEST;
    }

    public static function files() {
        return $_FILES;
    }

    public static function file($key) {
        return isset($_FILES[$key]) && $_FILES[$key]['size'] > 0 ? $_FILES[$key] : null;
    }
}