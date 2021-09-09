<?php

namespace Linotype\Core;

use Linotype\Bundle\LinotypeBundle\Repository\LinotypeMetaRepository;
use Linotype\Bundle\LinotypeBundle\Repository\LinotypeOptionRepository;
use Linotype\Bundle\LinotypeBundle\Repository\LinotypeTemplateRepository;
use Linotype\Bundle\LinotypeBundle\Repository\LinotypeTranslateRepository;
use Linotype\Core\Builder\ConfigBuilder;

class LinotypeCore
{

    private $linotype;

    private static $locale;

    private static $doctrine;

    public function __construct()
    {
        $working_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/linotype';
        $configBuilder = new ConfigBuilder($working_dir);
        $configBuilder->build();
        $this->linotype = $configBuilder->get();
    }

    public function setLocale( string $locale )
    {
        self::$locale = $locale;
    }

    static function getLocale()
    {
        return self::$locale;
    }

    public function registerDoctrineMetaRepository( LinotypeMetaRepository $metaRepository )
    {
        self::$doctrine['repository_meta'] = $metaRepository;
    }

    public function registerDoctrineTemplateRepository( LinotypeTemplateRepository $templateRepository )
    {
        self::$doctrine['repository_template'] = $templateRepository;
    }

    public function registerDoctrineOptionRepository( LinotypeOptionRepository $optionRepository )
    {
        self::$doctrine['repository_option'] = $optionRepository;
    }

    public function registerDoctrineTranslateRepository( LinotypeTranslateRepository $translateRepository )
    {
        self::$doctrine['repository_translate'] = $translateRepository;
    }

    static function getDoctrine($type, $id)
    {
        return self::$doctrine[$type . '_' . $id];
    }

    public function getConfig()
    {
        return $this->linotype;
    }

}
