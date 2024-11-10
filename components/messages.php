<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Components\Message;
use Core\Helpers\Request;
use Core\Helpers\Session;

if (Request::has('done') || Session::has('done'))
    echo Message::success(Request::get('done') ?? Session::get('done'));
if (Request::has('error') || Session::has('error'))
    echo Message::danger(Request::get('error') ?? Session::get('error'));
if (Request::has('info') || Session::has('info'))
    echo Message::info(Request::get('info') ?? Session::get('info'));

Session::unset('done');
Session::unset('error');
Session::unset('info');
