<?php
    require_once __DIR__ . "/../../../vendor/autoload.php";

    use Core\Helpers\Request;
    use Core\Helpers\Session;
    use Core\Models\Farmer;
    use Core\Helpers\Redirect;

    session_start();

    Redirect::ifNotLoggedIn();
    Redirect::ifNotAdmin();

    $id = Request::get('id');
    $status = Request::get('status');
    Farmer::query()->where("`id`=$id")->update("`status`='$status'");
    Session::set('done', 'Farmer status has been updated successfully!');
    header("Location: farmers.php");
    exit;
