<?php

namespace Linotype\Core;

use Linotype\Core\Builder\ConfigBuilder;

class LinotypeCore
{

    private $linotype;

    public function __construct()
    {
        
    }

    public function getConfig()
    {
        $working_dir = dirname(dirname(dirname(dirname(__FILE__)))) . '/linotype-test';
        $configBuilder = new ConfigBuilder($working_dir);
        $configBuilder->build();
        $this->linotype = $configBuilder->get();
       
        // dump('LinotypeCore:get');
        return $this->linotype;
    }

}
