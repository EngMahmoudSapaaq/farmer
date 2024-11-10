<?php

    require_once __DIR__ . '/../../vendor/autoload.php';

    use Core\Helpers\Redirect;

    Redirect::ifNotUser();

?>

<?php if ($order->status == 'done'): ?>
    <span class="badge bg-success">Done</span>
<?php elseif ($order->status == 'rejected'): ?>
    <span class="badge bg-danger">Rejected</span>
<?php else: ?>
    <span class="badge bg-warning">Pending</span>
<?php endif; ?>