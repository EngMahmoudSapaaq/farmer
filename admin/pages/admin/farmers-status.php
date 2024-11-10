<?php
    require_once __DIR__ . "/../../../vendor/autoload.php";

    use Core\Helpers\Redirect;

    Redirect::ifNotLoggedIn();
    Redirect::ifNotAdmin();

    $color = '';
    if ($farmer->status == 'pending')
        $color = 'warning';
    else if ($farmer->status == 'activated')
        $color = 'success';
    else if ($farmer->status == 'rejected')
        $color = 'secondary';
    else
        $color = 'danger';
?>
<span class="badge bg-<?= $color ?>"><?= ucwords($farmer->status) ?></span>