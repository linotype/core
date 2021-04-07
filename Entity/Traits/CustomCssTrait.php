<?php

namespace Linotype\Core\Entity\Traits;

trait CustomCssTrait
{
    
    private $customCss;
    
    public function getCustomCss(): ?array
    {
        return $this->customCss;
    }

    public function setCustomCss(array $customCss): self
    {
        $this->customCss = $customCss;

        return $this;
    }

}