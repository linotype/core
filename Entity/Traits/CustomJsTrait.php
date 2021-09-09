<?php

namespace Linotype\Core\Entity\Traits;

trait CustomJsTrait
{
    
    private $custom_js;
    
    public function getCustomJs(): ?array
    {
        return $this->custom_js;
    }

    public function setCustomJs(array $custom_js): self
    {
        $this->custom_js = $custom_js;

        return $this;
    }

}