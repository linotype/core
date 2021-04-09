<?php

namespace Linotype\Core;

use Linotype\Core\Builder\ConfigBuilder;

class LinotypeCore
{

    private $linotype;

    public static $db;

    public function __construct($metaRepo)
    {
        self::$db = $metaRepo;
        $working_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/linotype';
        $configBuilder = new ConfigBuilder($working_dir);
        $configBuilder->build();
        $this->linotype = $configBuilder->get();
    }

    public function getConfig()
    {
        return $this->linotype;
    }

}
