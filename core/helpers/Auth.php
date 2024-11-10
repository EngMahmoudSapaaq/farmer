<?php 

namespace Core\Helpers;

require_once __DIR__ . "/../../vendor/autoload.php";

class Auth {
    public static function check($user_type=null) {
        return Session::has($user_type ?? 'user');
    }
    public static function user() {
        return Session::get('user');
    }

    public static function userType() {
        return Session::has('user_type') ?
            Session::get('user_type') : null;
    }

    public static function updateUser($user) {
        return Session::set('user', $user);
    }

    public static function login($user) {
        Session::set('user', $user);
        Session::set('user_type', $user->type);
        return $user;
    }

    public static function logout() {
        Session::clear();
    }
}