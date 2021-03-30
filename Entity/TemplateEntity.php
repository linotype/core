<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;
use Linotype\Core\Entity\Traits\LayoutTrait;

class TemplateEntity
{

    use DefaultTrait;
    use LayoutTrait;

    private $id;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    private $layout;

}
