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

    private $directory;

    private $configLoader;

    public function __construct($directory)
    {   
        $this->directory = $directory;
        $this->configLoader = new ConfigLoader($directory);
    }

    public function build() 
    {
        $linotype = new LinotypeConfig();
        $config = $this->configLoader->get('linotype');
        $linotype->setVersion( $config['version'] );
        $linotype->setDebug( $config['debug'] );
        $linotype->setPreview( $config['preview'] );
        $linotype->setActiveTheme( $config['theme'] ); 

        foreach( $this->configLoader->get('block') as $config_id => $config ) 
        {
            $item = new BlockConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setPackage($config['package']);
            $item->setParent($config['parent']);
            $item->setAccept($config['accept']);
            $item->setContext($config['context']);
            $item->setInfo( $config_id, $this->directory . '/Block' );
            $linotype->addBlock( $item );
        }

        foreach( $this->configLoader->get('field') as $config_id => $config ) 
        {
            $item = new FieldConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setPackage($config['package']);
            $item->setTitle($config['title']);
            $item->setHelp($config['help']);
            $item->setRequire($config['require']);
            $item->setFormat($config['format']);
            $item->setOption($config['option']);
            $item->setInfo( $config_id, $this->directory . '/Field' );
            $linotype->addField( $item );
        }

        foreach( $this->configLoader->get('helper') as $config_id => $config ) 
        {
            $item = new HelperConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setMethode($config['methode']);
            $item->setInfo( $config_id, $this->directory . '/Helper' );
            $linotype->addHelper( $item );
        }

        foreach( $this->configLoader->get('module') as $config_id => $config ) 
        {
            $item = new ModuleConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setLayout($config['layout']);
            $item->setInfo( $config_id, $this->directory . '/Module' );
            $linotype->addModule( $item );
        }

        foreach( $this->configLoader->get('template') as $config_id => $config ) 
        {
            $item = new TemplateConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setLayout($config['layout']);
            $item->setInfo( $config_id, $this->directory . '/Template' );
            $linotype->addTemplate( $item );
        }

        foreach( $this->configLoader->get('theme') as $config_id => $config ) 
        {
            $item = new ThemeConfig();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setInfo( $config_id, $this->directory . '/Theme' );
            $linotype->addTheme( $item );
        }

        $linotype->setActive( ( new ActiveBuilder( $linotype ) )->get() );

        $linotype->setCurrent( ( new CurrentBuilder( $linotype ) )->get() );

        $this->linotype = $linotype;
    }

    public function get(): ?LinotypeConfig
    {   
        return $this->linotype ? $this->linotype : null;
    }

}
