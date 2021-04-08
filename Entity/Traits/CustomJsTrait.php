<?php

namespace Linotype\Core\Entity\Traits;

trait CustomJsTrait
{
    
    private $customJs;
    
    public function getCustomJs(): ?array
    {
        return $this->customJs;
    }

    public function setCustomJs(array $customJs): self
    {
        $this->customJs = $customJs;

        return $this;
    }

}