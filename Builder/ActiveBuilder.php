<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Config\LinotypeConfig;
use Linotype\Core\Config\ThemeConfig;

class ActiveBuilder
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
    }

    public function getTheme(): ?ThemeConfig
    {
        return $this->theme;
    }

    public function setTheme(ThemeConfig $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function get(): ?self
    {
        $active = $this;
        unset($active->linotype);
        return $active;
    }

}
