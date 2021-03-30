<?php

namespace Linotype\Core\Config;

use Linotype\Core\Config\Traits\DefaultTrait;

class HelperConfig
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
