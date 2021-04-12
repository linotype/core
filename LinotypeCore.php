<?php

namespace Linotype\Core;

use Linotype\Bundle\LinotypeBundle\Repository\LinotypeMetaRepository;
use Linotype\Bundle\LinotypeBundle\Repository\LinotypeOptionRepository;
use Linotype\Bundle\LinotypeBundle\Repository\LinotypeTemplateRepository;
use Linotype\Core\Builder\ConfigBuilder;

class LinotypeCore
{

    private $linotype;

    private static $doctrine;

    public function __construct()
    {
        $working_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/linotype';
        $configBuilder = new ConfigBuilder($working_dir);
        $configBuilder->build();
        $this->linotype = $configBuilder->get();
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

    static function getDoctrine($type, $id)
    {
        return self::$doctrine[$type . '_' . $id];
    }

    public function getConfig()
    {
        return $this->linotype;
    }

}
