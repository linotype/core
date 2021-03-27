<?php

namespace Linotype\Core\Config;

use Linotype\Core\Config\Traits\DefaultConfig;

class BaseConfig
{

    use DefaultConfig;

    private $id;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;


}
