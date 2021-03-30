<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\ThemeEntity;

class ActiveBuilder
{

    private $theme;

    private $templates;

    private $modules;

    private $helpers;

    private $fields;

    private $blocks;

    function __construct( LinotypeEntity $linotype )
    {
        $this->linotype = $linotype;
    }

    public function getTheme(): ?ThemeEntity
    {
        return $this->theme;
    }

    public function setTheme(ThemeEntity $theme): self
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
