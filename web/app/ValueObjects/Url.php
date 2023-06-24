<?php

namespace App\ValueObjects;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \UnexpectedValueException('Not valid url');
        }

        $this->url = $url;
    }

    public function value(): string
    {
        return $this->url;
    }
}
