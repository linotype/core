<?php

namespace Linotype\Core\Config;

use Linotype\Core\Config\Traits\DefaultTrait;
use Linotype\Core\Config\Traits\LayoutTrait;

class ModuleConfig
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
