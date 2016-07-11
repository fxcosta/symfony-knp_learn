<?php

namespace AppBundle\Service;

use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{

    private $markdownParser;
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {
        $key = md5($str);

        if ($this->cache->contains($key)) {
            return $this->cache->fetch($key);
        }

        $str = $this->markdownParser
            ->transform($str);

        $this->cache->save($key,$str);

        return $str;

    }
}