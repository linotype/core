<?php

namespace Linotype\Core\Render;

use DeepCopy\DeepCopy;
use Linotype\Core\Entity\LinotypeEntity;

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

    public function render(string $theme_id)
    {
        $this->theme = $this->themes->getTheme($theme_id);

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
