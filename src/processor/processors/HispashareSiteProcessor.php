<?php
namespace RssGenerator\Processor\Processors;

use QL\QueryList as QueryList;
use Requests;
use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Processor\ISiteProcessor as ISiteProcessor;
use RssGenerator\Util\Singleton as Singleton;
use RssGenerator\Util\SiteProcessorUtils as SiteProcessorUtils;

class HispashareSiteProcessor extends Singleton implements ISiteProcessor
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

        // QueryList trae un cliente HTTP (GuzzleHttp) pero por algún motivo no se traga el HTML devuelto.
        // Usando este cliente sí funciona
        $result = Requests::get($site->url, $headers);

        // Quitamos las tags de scripts para qutiarnos bastantes warnings al porcesar el HTML (Siguen saltando alguno que otro)
        $cleanBody = SiteProcessorUtils::getHtmlWithoutScripts($result->body);

        // Esto produce alguno warnings pero funciona
        $value = QueryList::setHtml($cleanBody)->find("h2:contains(\"" . $site->idWeb . "\") ~ div:not(.INFOMSG):first tr:last-child td:nth-child(2) a")->text();

        $value = $value === '' ? '[ERROR] idWeb not found: "' . $site->idWeb . '"' : $value;

        return $value;
    }
}
