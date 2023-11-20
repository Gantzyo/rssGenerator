<?php
namespace RssGenerator\Processor;

use RssGenerator\Domain\Site as Site;
use RssGenerator\Domain\Type as Type;
use RssGenerator\Processor\Processors\BlankSiteProcessor as BlankSiteProcessor;
use RssGenerator\Processor\Processors\DescargasDDSiteProcessor as DescargasDDSiteProcessor;
use RssGenerator\Processor\Processors\HispashareSiteProcessor as HispashareSiteProcessor;

class SiteProcessorChooser
{
    /**
     * @param Site $site
     */
    public static function getProcessor(Site $site): ISiteProcessor
    {
        /**
         * @var ISiteProcessor
         */
        $processor;
		
		echo "Recuperando processor para el tipo ".$site->Type_type."<br/>";

        switch ($site->Type_type) {
            case Type::SITE_HISPASHARE:
                $processor = new HispashareSiteProcessor();
                break;
            case Type::SITE_DESCARGASDD:
				echo "Recuperando processor para el tipo ".Type::SITE_DESCARGASDD."<br/>";
                $processor = new DescargasDDSiteProcessor();
                break;
            default:
				echo "Recuperando processor para el tipo BLANK<br/>";
                $processor = new BlankSiteProcessor();
                break;
        }
		echo "Processor: ".get_class($processor)."<br/>";
        return $processor;
    }
}
