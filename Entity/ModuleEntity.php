<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;
use Linotype\Core\Entity\Traits\KeyTrait;
use Linotype\Core\Entity\Traits\LayoutTrait;

class ModuleEntity
{

    use DefaultTrait;
    use KeyTrait;
    use LayoutTrait;

    private $id;

    private $key;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    private $layout;

}
