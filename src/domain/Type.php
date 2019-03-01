<?php
namespace RssGenerator\Domain;

class Type
{
    public const SITE_HISPASHARE = "Hispashare";
    public const SITE_DESCARGASDD = "DescargasDD";

    public $type;
    public $longName;
    public $description;
    public $enabled;
    public $creationTS;
}
