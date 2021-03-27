<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Config\LinotypeConfig;
use Linotype\Core\Config\BlockConfig;
use Linotype\Core\Config\FieldConfig;
use Linotype\Core\Config\HelperConfig;
use Linotype\Core\Config\ModuleConfig;
use Linotype\Core\Config\TemplateConfig;
use Linotype\Core\Config\ThemeConfig;
use Linotype\Core\Loader\ConfigLoader;

class ConfigBuilder
{

    private $linotype;

    private $config;

    function __construct($dir)
    {
        $this->linotype = new LinotypeConfig();
        $this->config = new ConfigLoader($dir);
    }

    public function load() 
    {
        $config = $this->config->get('linotype');
        $this->linotype->setVersion( $config['version'] );
        $this->linotype->setDebug( $config['debug'] );
        $this->linotype->setPreview( $config['preview'] );
        $this->linotype->setActiveTheme( $config['theme'] );   
        foreach( $this->config->get('block') as $config_id => $config ) 
        {
            $item = new BlockConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setInfo($config);
            $item->setPackage($config['package']);
            $item->setParent($config['parent']);
            $item->setAccept($config['accept']);
            $item->setContext($config['context']);
            // $item->setChildren($config['children']);
            $this->linotype->addBlock( $item );
        }
        foreach( $this->config->get('field') as $config_id => $config ) 
        {
            $item = new FieldConfig();
            $item->setID($config_id);
            $this->linotype->addField( $item );
        }
        foreach( $this->config->get('helper') as $config_id => $config ) 
        {
            $item = new HelperConfig();
            $item->setID($config_id);
            $this->linotype->addHelper( $item );
        }
        foreach( $this->config->get('module') as $config_id => $config ) 
        {
            $item = new ModuleConfig();
            $item->setID($config_id);
            $this->linotype->addModule( $item );
        }
        foreach( $this->config->get('template') as $config_id => $config ) 
        {
            $item = new TemplateConfig();
            $item->setID($config_id);
            $this->linotype->addTemplate( $item );
        }
        foreach( $this->config->get('theme') as $config_id => $config ) 
        {
            $item = new ThemeConfig();
            $item->setID($config_id);
            $this->linotype->addTheme( $item );
        }
        // $this->linotype->setCurrentTheme( $this->linotype->getTheme( $this->linotype->getActiveTheme() ) ); 
    }

    public function get() 
    {
        return $this->linotype;
    }
    
}
