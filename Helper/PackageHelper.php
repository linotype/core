<?php

namespace Linotype\Core\Entity;

class PackageHelper
{

    private $id;

    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }
    
}
