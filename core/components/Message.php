<?php

namespace Core\Components;

class Message {

    private function __construct(
        private string $content='',
        private string $color='',
        private $duration=5000) {
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function getColor() {
        return $this->color;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function get() {
        $message = $this;
        ob_start();
        require_once __DIR__ . '/../../components/message.php';
        return ob_get_clean();
    }

    public static function success($content, $duration=5000) {
        return (new self())
            ->setContent($content)
            ->setColor('success')
            ->setDuration($duration)
            ->get();
    }

    public static function warning($content, $duration=5000) {
        return (new self())
            ->setContent($content)
            ->setColor('warning')
            ->setDuration($duration)
            ->get();
    }

    public static function danger($content, $duration=5000) {
        return (new self())
            ->setContent($content)
            ->setColor('danger')
            ->setDuration($duration)
            ->get();
    }

    public static function info($content, $duration=5000) {
        return (new self())
            ->setContent($content)
            ->setColor('info')
            ->setDuration($duration)
            ->get();
    }

    public static function secondary($content, $duration=5000) {
        return (new self())
            ->setContent($content)
            ->setColor('secondary')
            ->setDuration($duration)
            ->get();
    }
}
