<script>
    Toastify({
        text: "<?= $message->getContent() ?>",
        style: {
            background: "var(--bs-<?= $message->getColor() ?>)"
        },
        duration: <?= $message->getDuration() ?>
    }).showToast();
</script>