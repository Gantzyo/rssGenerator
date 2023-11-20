<?php
namespace RssGenerator\Processor\Processors;

use Requests;
use RssGenerator\Domain\Cookie as Cookie;
use RssGenerator\Domain\Site as Site;
use RssGenerator\Processor\ISiteProcessor as ISiteProcessor;
use RssGenerator\Util\SiteProcessorUtils as SiteProcessorUtils;

class DescargasDDSiteProcessor implements ISiteProcessor
{
    /**
     * @param Site $site
     * @param Cookie[] $cookies
     * @return ?string
     */
    public function getSiteUpdate(Site $site, $cookies): ?string
    {
        echo "Recuperando cookies como string<br/>";
        $cookiesString = SiteProcessorUtils::getCookiesAsString($cookies);
        
        echo "Steando cookies como headers<br/>";
        $headers = [];
        if ($cookiesString != null) {
            $headers["Cookie"] = $cookiesString;
        }

        echo "Haciendo GET a la URL del sitio<br/>";
        $result = Requests::get($site->url, $headers);

        // OLD - Usando QueryList
        // echo "Limpiando el body<br/>";
        // Quitamos las tags de scripts para qutiarnos bastantes warnings al porcesar el HTML (Siguen saltando alguno que otro)
        // $cleanBody = SiteProcessorUtils::getHtmlWithoutScripts($result->body);

        // echo "Recuperando el valor buscado<br/>";
        // if($site->idWeb === "title") // Añadir si en el futuro hay que buscar otros campos según el tema a consultar
        // $value = QueryList::setHtml($cleanBody)->find(".threadtitle a")->text();

        echo "Recuperando el valor buscado<br/>";
        preg_match("/<title>(.*)<\/title>/i", $result->body, $matches);

        $value = $matches[1];

        echo "Valor recuperado:".$value."<br/>";
        return $value;
    }
}
