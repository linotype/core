<?php

namespace Linotype\Core\Entity\Traits;

trait TemplateRefTrait
{
 
    private $template_ref;
    
    public function getTemplateRef(): ?int
    {
        return (int) $this->template_ref;
    }

    public function setTemplateRef($template_ref = null): self
    {
        $this->template_ref = $template_ref;

        return $this;
    }

}