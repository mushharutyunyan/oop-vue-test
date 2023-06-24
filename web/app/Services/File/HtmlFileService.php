<?php

namespace App\Services\File;

use App\ValueObjects\Url;

class HtmlFileService extends FileControl implements HtmlFileAble
{
    protected string $path = '../storage/htmlbodies/';
    protected string $content;
    protected string $ext = 'txt';

    public function __construct(?string $content = null)
    {
        parent::__construct();
        if ($content) {
            $this->content = $content;
        }
    }

    /**
     * @throws \Exception
     */
    public function getContentFromHtml(Url $url): self
    {
        try {
            $content = @file_get_contents($url->value());
            preg_match("/<body[^>]*>(.*?)<\/body>/is", $content, $matches);
        } catch (\Exception $exception) {
            throw new \Exception('can not parse this url');
        }
        if (empty($matches[0])) {
            throw new \Exception('Url not have body element');
        }
        $this->content = $matches[0];
        $this->ext = 'html';
        return $this;
    }

    public function clearHtmlContent(string $content = null): self
    {
        if($content) {
            $this->content = $content;
        }
        $this->content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $this->content);
        $this->content = preg_replace('#<noscript(.*?)>(.*?)</noscript>#is', '', $this->content);
        $this->content = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $this->content);
        return $this;
    }
}

