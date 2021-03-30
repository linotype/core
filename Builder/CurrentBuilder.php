<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Config\LinotypeConfig;

class CurrentBuilder
{

    private $theme;

    private $templates;

    private $modules;

    private $helpers;

    private $fields;

    private $blocks;

    function __construct( LinotypeConfig $linotype )
    {
        $this->linotype = $linotype;
        $this->init();
    }

    public function get(): ?self
    {   
        $current = $this;
        unset($current->linotype);
        return $current;
    }

    public function init()
    {
        $this->linotype->getThemes();
    }

    

}
