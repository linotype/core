<?php

namespace Linotype\Core\Entity\Traits;

trait CustomCssTrait
{
    
    private $custom_css;
    
    public function getCustomCss(): ?array
    {
        return $this->custom_css;
    }

    public function setCustomCss(array $custom_css): self
    {
        $this->custom_css = $custom_css;

        return $this;
    }

}