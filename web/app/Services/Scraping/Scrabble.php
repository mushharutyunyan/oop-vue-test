<?php

namespace App\Services\Scraping;

use App\ValueObjects\Url;

interface Scrabble
{
    public function handle(Url $url): array;
}