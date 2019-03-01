<?php
namespace RssGenerator\Processor\Processors;

use Requests;
use QL\QueryList as QueryList;
use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Processor\ISiteProcessor as ISiteProcessor;
use RssGenerator\Util\Singleton as Singleton;
use RssGenerator\Util\SiteProcessorUtils as SiteProcessorUtils;

class DescargasDDSiteProcessor extends Singleton implements ISiteProcessor
{
    /**
     * @param Site $site
     * @param Cookie[] $cookies
     * @return ?string
     */
    public function getSiteUpdate(Site $site, $cookies): ?string
    {
        $cookiesString = SiteProcessorUtils::getCookiesAsString($cookies);
        
        $headers = [];
        if ($cookiesString != null) {
            $headers["Cookie"] = $cookiesString;
        }

        $result = Requests::get($site->url, $headers);

        // Quitamos las tags de scripts para qutiarnos bastantes warnings al porcesar el HTML (Siguen saltando alguno que otro)
        $cleanBody = SiteProcessorUtils::getHtmlWithoutScripts($result->body);

        // Esto produce alguno warnings pero funciona
        // if($site->idWeb === "title") // Añadir si en el futuro hay que buscar otros campos según el tema a consultar
        $value = QueryList::setHtml($cleanBody)->find(".threadtitle a")->text();

        return $value;
    }
}
