<?php
namespace RssGenerator\Processor\Processors;

use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Processor\ISiteProcessor as ISiteProcessor;
use RssGenerator\Util\Singleton as Singleton;

class BlankSiteProcessor extends Singleton implements ISiteProcessor
{
    /**
     * @param Site $site
     * @param Cookie[] $cookies
     * @return ?string
     */
    public function getSiteUpdate(Site $site, $cookies): ?string
    {
        return "ERROR: No processors available for site type '".$site->Type_type."'";
    }
}
