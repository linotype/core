<?php

namespace Linotype\Core\Entity\Traits;

trait LayoutTrait
{
    
    private $layout;
    
    public function getLayout(): ?array
    {
        return $this->layout;
    }

    public function setLayout(array $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

}