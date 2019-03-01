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

        switch ($site->Type_type) {
            case Type::SITE_HISPASHARE:
                $processor = HispashareSiteProcessor::instance();
                break;
            case Type::SITE_DESCARGASDD:
                $processor = DescargasDDSiteProcessor::instance();
                break;
            default:
                $processor = BlankSiteProcessor::instance();
                break;
        }
        return $processor;
    }
}
