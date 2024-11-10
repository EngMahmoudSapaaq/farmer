<?php

namespace Core\Helpers;

class Redirect {

    public static function ifLoggedIn($root_dir, $message='Logout first!') {
        $root_dir = trim($root_dir, '/');
        $root_dir = $root_dir == '' ? '.' : $root_dir;
        if (Auth::check()) {
            Session::set('error', $message);
            switch (Auth::userType()) {
                case 'farmer':
                    header("Location: {$root_dir}/admin/pages/farmer/index.php"); break;
                case 'admin':
                    header("Location: {$root_dir}/admin/pages/admin/farmers.php"); break;
                case 'user':
                    header("Location: {$root_dir}/pages/user/index.php"); break;
            }
            exit;
        }
        return false;
    }

    public static function ifNotLoggedIn($message='Login first!') {
        if (!Auth::check()) {
            Session::set('error', $message);
            header("Location: ../../index.php");
            exit;
        }
        return false;
    }

    public static function ifNotAdmin($message='You are not allowed to access this page!') {
        if (Auth::userType() != 'admin') {
            Session::set('error', $message);
            if (Auth::userType() == 'farmer')
                header("Location: ../farmer/index.php");
            else
                header("Location: ../../../pages/user/index.php");
            exit;
        }
        return false;
    }
    
    public static function ifNotFarmer($message='You are not allowed to access this page!') {
        if (Auth::userType() != 'farmer') {
            Session::set('error', $message);
            if (Auth::userType() == 'admin')
                header("Location: ../admin/index.php");
            else
                header("Location: ../../../pages/user/index.php");
            exit;
        }
        return false;
    }

    public static function ifNotUser($message='You are not allowed to access this page!') {
        if (Auth::userType() != 'user') {
            Session::set('error', $message);
            if (Auth::userType() == 'farmer')
                header("Location: ../../admin/pages/farmer/index.php");
            else
                header("Location: ../../admin/pages/admin/index.php");
            exit;
        }
        return false;
    }

    public static function afterLoggedIn() {
        Session::set('done', 'Welcome: Logged in successfully!');
        header("Location: ../" . Auth::userType());
        exit;
    }

    public static function withError($path='index.php', $message='Something went wrong!') {
        Session::set('error', $message);
        header("Location: $path");
        exit;
    }

}
