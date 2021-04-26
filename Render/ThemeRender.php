<?php

namespace Linotype\Core\Render;

use DeepCopy\DeepCopy;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\ThemeEntity;

class ThemeRender
{

    private $output;

    private $theme;

    public function __construct(LinotypeEntity $linotype)
    {
        $this->linotype = $linotype;
        $this->themes = $linotype->getThemes();
        $this->templates = $linotype->getTemplates();
        $this->TemplateRender = new TemplateRender( $linotype );
    }

    public function render(ThemeEntity $theme)
    {
        $this->theme = $theme;

        $this->output = [];
        foreach( $this->theme->getMap() as $item_key => $item ) {
            
            //clone module from defaults
            $template = (new DeepCopy())->copy( $this->templates->findById($item['template']) );
            
            //get template render
            $this->output[$item_key] = $this->TemplateRender->render($template);

        }
        return $this->output;
    }

}
