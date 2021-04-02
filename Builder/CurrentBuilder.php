<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\TemplateEntity;
use Linotype\Core\Entity\ThemeEntity;
use Linotype\Core\Render\TemplateRender;
use Linotype\Core\Repo\ThemeRepo;

class CurrentBuilder
{

    public $theme;

    public $template;

    public $modules;

    public $helpers;

    public $fields;

    public $blocks;

    function __construct( LinotypeEntity $linotype )
    {
        $this->theme = $linotype->getThemes()->getTheme( $linotype->getActiveTheme() );
        $this->template = new TemplateRender( $linotype );
        
    }

    public function render(TemplateEntity $template): ?array
    {
        return $this->template->render($template);
    }
    
    public function getTheme(): ?ThemeEntity
    {
        return $this->theme;
    }

}
