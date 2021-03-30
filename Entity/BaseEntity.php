<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;

class BaseEntity
{

    use DefaultTrait;

    private $id;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;


}
