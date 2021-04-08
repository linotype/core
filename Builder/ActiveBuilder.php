<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\ThemeEntity;
use Linotype\Core\Render\ThemeRender;

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
        $this->theme = new ThemeRender( $linotype );
    }

    public function render(string $theme_id): ?array
    {
        return $this->theme->render($theme_id);
    }

}
