<?php

namespace App\Services\File;

interface FileAble
{
    public function save(): string;
    public function get(string $fileName): string;
    public function remove(string $fileName): string;
}