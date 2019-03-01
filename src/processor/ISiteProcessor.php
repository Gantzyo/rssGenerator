<?php
namespace RssGenerator\Processor;

use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;

interface ISiteProcessor
{
    /**
     * @param Site $site
     * @param Cookie[] $cookies
     * @return ?string
     */
    public function getSiteUpdate(Site $site, $cookies): ?string;
}
