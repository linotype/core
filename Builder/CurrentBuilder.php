<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\TemplateEntity;
use Linotype\Core\Entity\ThemeEntity;
use Linotype\Core\Render\TemplateRender;
use Linotype\Core\Render\ThemeRender;
use Linotype\Core\Repo\ThemeRepo;

class CurrentBuilder
{

    public $theme;

    function __construct( LinotypeEntity $linotype )
    {
        $this->linotype = $linotype;
        $this->theme = $linotype->getThemes()->getTheme( $this->linotype->getActiveTheme() );
        $this->theme_render = new ThemeRender( $this->linotype );
        $this->template_render = new TemplateRender( $this->linotype );
    }

    public function getTheme(): ?ThemeEntity
    {
        return $this->theme;
    }

    public function renderTheme(): ?array
    {
        return $this->theme_render->render( $this->theme );
    }

    public function renderTemplate(TemplateEntity $template, $database_id = null): ?array
    {
        return $this->template_render->render($template, $database_id);
    }

    public function renderTemplateFields(TemplateEntity $template, $database_id = null): ?array
    {   
        $fields = [];
        $blocks = $this->template_render->render($template, $database_id);
        foreach ( $blocks as $block ) {
            foreach ( $block->getContext()->getAll() as $context ) {
                $fields[ $block->getKey() . '__' . $context->getId() ] = $context;
            }
        }
        return $fields;
    }
    
}
