<?php

namespace App\Services\File;


abstract class FileControl implements FileAble
{
    protected string $path;
    protected string $content;
    protected string $ext;

    public function __construct(
        string $path = null,
        string $content = null,
        string $ext = null
    )
    {
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->path;
        if($path) {
            $this->path = $path;
        }
        if($content) {
            $this->content = $content;
        }
        if($ext) {
            $this->ext = $ext;
        }
    }

    /**
     * @throws \Exception
     */
    public function save(): string
    {
        $fileName = time() . '.' . $this->ext;
        $newFile = fopen($this->path . $fileName, "w");
        if (!$newFile) {
            throw new \Exception("Unable to open file!");
        }
        fwrite($newFile, $this->content);
        fclose($newFile);
        return $fileName;
    }

    /**
     * @throws \Exception
     */
    public function get(string $fileName): string
    {
        if (!file_exists($this->path . $fileName)) {
            throw new \Exception("Unable to open file!");
        }
        return file_get_contents($this->path . $fileName);
    }

    /**
     * @throws \Exception
     */
    public function remove(string $fileName): string
    {
        if (!file_exists($this->path . $fileName)) {
            throw new \Exception("Unable to open file!");
        }
        return unlink($this->path . $fileName);
    }
}