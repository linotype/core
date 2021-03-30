<?php

namespace Linotype\Core;

use Linotype\Core\Builder\ConfigBuilder;

class LinotypeCore
{

    private static $instance = null;

    // The constructor is private
    // to prevent initiation with outer code.
    private function __construct()
    {
        $dir_test = dirname(dirname(dirname(dirname(__FILE__)))) . '/linotype-test';

        $config = new ConfigBuilder();
        $config->load($dir_test);
        $linotype = $config->get();
        dump( $linotype );die;
        
        // The expensive process (e.g.,db connection) goes here.
    }

    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance() :LinotypeCore
    {
        if (self::$instance == null) {
            self::$instance = new LinotypeCore();
        }

        return self::$instance;
    }

}
