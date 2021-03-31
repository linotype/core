<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Render\TemplateRender;

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
        $this->template = new TemplateRender( 'Page', $linotype );
        return $this;
    }

    public function render(): ?array
    {
        return $this->template->render();
    }
    

    public function getTemplate(): ?array
    {
        return $this->methode;
    }

    public function setTemplate(array $methode): self
    {
        $this->methode = $methode;

        return $this;
    }

    

}
