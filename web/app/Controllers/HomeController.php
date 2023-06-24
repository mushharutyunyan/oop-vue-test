<?php

namespace App\Controllers;


use App\Requests\ParseUrlRequest;
use App\Responses\Response;
use App\Services\Scraping\Scrabble;
use App\Services\Scraping\ScrapingService;
use App\ValueObjects\Url;
use Helpers\HtmlTags;
use JetBrains\PhpStorm\NoReturn;
use System\Request;

class HomeController
{
    use HtmlTags;

    /**
     * @throws \Exception
     */
    #[NoReturn]
    public function parse(ParseUrlRequest $request): void
    {
        $url = $request->all()['url'];
        $scrapingService = new ScrapingService();
        $results = $scrapingService->handle(new Url($url));
        Response::jsonOk($results);
    }
}