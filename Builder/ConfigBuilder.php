<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\BlockEntity;
use Linotype\Core\Entity\FieldEntity;
use Linotype\Core\Entity\HelperEntity;
use Linotype\Core\Entity\ModuleEntity;
use Linotype\Core\Entity\TemplateEntity;
use Linotype\Core\Entity\ThemeEntity;
use Linotype\Core\Loader\ConfigLoader;
use Linotype\Core\Repo\BlockRepo;
use Linotype\Core\Repo\FieldRepo;

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
        $linotype = new LinotypeEntity();
        $config = $this->configLoader->get('linotype');
        $linotype->setVersion( $config['version'] );
        $linotype->setDebug( $config['debug'] );
        $linotype->setPreview( $config['preview'] );
        $linotype->setActiveTheme( $config['theme'] ); 

        $blockRepo = new BlockRepo();
        foreach( $this->configLoader->get('block') as $config_id => $config ) 
        {
            $item = new BlockEntity();
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
            $blockRepo->addBlock( $item );
        }
        $linotype->setBlocks( $blockRepo );

        $fieldRepo = new FieldRepo();
        foreach( $this->configLoader->get('field') as $config_id => $config ) 
        {
            $item = new FieldEntity();
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
            $fieldRepo->addField( $item );
        }
        $linotype->setFields( $fieldRepo );

        foreach( $this->configLoader->get('helper') as $config_id => $config ) 
        {
            $item = new HelperEntity();
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
            $item = new ModuleEntity();
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
            $item = new TemplateEntity();
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
            $item = new ThemeEntity();
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

    public function get(): ?LinotypeEntity
    {   
        return $this->linotype ? $this->linotype : null;
    }

}
