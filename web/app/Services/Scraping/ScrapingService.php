<?php

namespace App\Services\Scraping;

use App\Services\File\HtmlFileService;
use App\ValueObjects\Url;
use Helpers\HtmlTags;

class ScrapingService implements Scrabble
{
    use HtmlTags;

    protected array $results = [];
    protected string $fileName;

    /**
     * @throws \Exception
     */
    public function handle(Url $url): array
    {
        $htmlFileService = (new HtmlFileService())->getContentFromHtml($url);
        $htmlFileService = $htmlFileService->clearHtmlContent();
        $this->fileName = $htmlFileService->save();
        // add queue there if it will be needed in future
        $content = (new HtmlFileService())->get($this->fileName);
        $this->collectTagsWithLooping($content);
        (new HtmlFileService())->remove($this->fileName);
        return $this->results;
    }

    /**
     * @throws \Exception
     */
    private function collectTagsWithLooping(string $content): void
    {
        foreach (self::tags() as $tag) {
            $useQty = $this->findTagQty($content, $tag);
            if ($useQty) {
                $this->results[] = [
                    'tag' => $tag,
                    'qty' => $useQty
                ];
            }
        }
    }

    private function findTagQty(string $content, string $tag): int
    {
        preg_match_all("/<$tag (.*?)>(.*?)/", $content, $matches);
        if (!empty($matches[0])) {
            return count($matches[0]);
        }
        return 0;
    }
}
