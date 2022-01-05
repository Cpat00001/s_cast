<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function parse(string $source):string
    {
        return $this->cache->get('markdown_'.md5($source), function() use($source){
            return $source;
        });
    }
}
