<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use Core\Helpers\Auth;
use Core\Helpers\Session;

session_start();

if (Auth::check()) {
    Auth::logout();
    Session::set('done', 'You have been successfully logged out!');
    header("Location:login.php");
    exit;
} else {
    Session::set('info', 'You are not logged in!');
    header("Location:login.php");
    exit;
}
