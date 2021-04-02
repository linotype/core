<?php

namespace Linotype\Core\Entity\Traits;

trait KeyTrait
{
    
    private $key;

    private $hash;

    private $cssId;
    
    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        $this->setHash($this->key);
        $this->setCssId($this->key);

        return $this;
    }

    public function gethash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $key): self
    {
        $this->hash = md5( $key, false );

        return $this;
    }

    public function getCssId(): ?string
    {
        return $this->cssId;
    }

    public function setCssId(string $key): self
    {
        $this->cssId = strtolower( str_replace( '_', '-', $key ) );

        return $this;
    }

}