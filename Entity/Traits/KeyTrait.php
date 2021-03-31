<?php

namespace Linotype\Core\Entity\Traits;

trait KeyTrait
{
    
    private $key;
    
    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

}