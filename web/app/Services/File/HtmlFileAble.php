<?php

namespace App\Services\File;

use App\ValueObjects\Url;

interface HtmlFileAble extends FileAble
{
    public function getContentFromHtml(Url $url): self;
    public function clearHtmlContent(): self;
}