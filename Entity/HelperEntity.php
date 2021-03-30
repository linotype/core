<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;

class HelperEntity
{

    use DefaultTrait;

    private $id;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    private $methode;

    public function getMethode(): ?array
    {
        return $this->methode;
    }

    public function setMethode(array $methode): self
    {
        $this->methode = $methode;

        return $this;
    }

}
