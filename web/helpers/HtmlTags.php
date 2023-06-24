<?php

namespace Helpers;

trait HtmlTags
{
    public static function tags()
    {
        return json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/../helpers/libraries/html-tags.json'), true);
    }
}