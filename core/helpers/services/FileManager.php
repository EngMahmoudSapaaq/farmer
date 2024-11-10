<?php

namespace Core\Helpers\Services;

use Exception;

class FileManager
{
    protected $filename;
    protected $file;
    protected $root_dir;

    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

    public function setFileName($filename) {
        $this->filename = $filename;
        return $this;
    }

    public function setRootDir($root_dir) {
        $this->root_dir = $root_dir;
        return $this;
    }

    public function storeFile()
    {
        $ext = $this->getFileExtension($this->file['name']);
        if (!in_array(strtolower($ext), ['png', 'jpg', 'jpeg', 'webp']))
            return null;
        $new_filename = time() . '.' . $ext;
        $target = "{$this->root_dir}/assets/uploads/{$new_filename}";
        if (!move_uploaded_file($this->file['tmp_name'], $target))
            throw new Exception('Could not move uploaded file');
        return $new_filename;
    }

    public function deleteFile() {
        $target = "{$this->root_dir}/assets/uploads/{$this->filename}";
        if (file_exists($target)) {
            unlink($target);
            return true;
        } else 
            return false;
    }

    private function getFileExtension($filename) {
        $arr = explode('.', $filename);
        return end($arr);
    }

}