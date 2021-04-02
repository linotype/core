<?php

namespace Linotype\Core\Builder;

use Linotype\Core\Context\BlockContext;
use Linotype\Core\Context\BlockContextItem;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\BlockEntity;
use Linotype\Core\Entity\FieldEntity;
use Linotype\Core\Entity\HelperEntity;
use Linotype\Core\Entity\ModuleEntity;
use Linotype\Core\Entity\TemplateEntity;
use Linotype\Core\Entity\ThemeEntity;
use Linotype\Core\Loader\ConfigLoader;
use Linotype\Core\Repo\BlockContextList;
use Linotype\Core\Repo\BlockRepo;
use Linotype\Core\Repo\FieldRepo;
use Linotype\Core\Repo\HelperRepo;
use Linotype\Core\Repo\ModuleRepo;
use Linotype\Core\Repo\TemplateRepo;
use Linotype\Core\Repo\ThemeRepo;

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
            $blockContext = new BlockContext();
            foreach( $config['context'] as $context_id => $context_value ) 
            {
                $context_item = new BlockContextItem();
                $context_item->setID($context_id);
                $context_item->setName($context_value['name']);
                // $context_item->setDesc($context_value['desc']);
                $context_item->setField($context_value['field']);
                // $context_item->setOption($context_value['option']);
                $context_item->setPersist($context_value['persist']);
                // $context_item->setValue($context_value['value']);
                $context_item->setDefault(isset($context_value['default'])?$context_value['default']:'');
                // $context_item->setPreview($context_value['preview']);
                $context_item->setFormat($context_value['format']);
                $context_item->setDebug($context_value['debug']);
                $context_item->setJs($context_value['js']);
                $context_item->setCss($context_value['css']);
                $blockContext->addContext($context_item);
            }
            $item->setContext( $blockContext );
            $item->setInfo( 'block', $config_id, $this->directory . '/Block' );
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
            $item->setInfo( 'field', $config_id, $this->directory . '/Field' );
            $fieldRepo->addField( $item );
        }
        $linotype->setFields( $fieldRepo );

        $helperRepo = new HelperRepo();
        foreach( $this->configLoader->get('helper') as $config_id => $config ) 
        {
            $item = new HelperEntity();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setMethode($config['methode']);
            $item->setInfo( 'helper', $config_id, $this->directory . '/Helper' );
            $helperRepo->addHelper( $item );
        }
        $linotype->setHelpers( $helperRepo );

        $moduleRepo = new ModuleRepo();
        foreach( $this->configLoader->get('module') as $config_id => $config ) 
        {
            $item = new ModuleEntity();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setLayout($config['layout']);
            $item->setInfo( 'module', $config_id, $this->directory . '/Module' );
            $moduleRepo->addModule( $item );
        }
        $linotype->setModules( $moduleRepo );

        $templateRepo = new TemplateRepo();
        foreach( $this->configLoader->get('template') as $config_id => $config ) 
        {
            $item = new TemplateEntity();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setLayout($config['layout']);
            $item->setInfo( 'template', $config_id, $this->directory . '/Template' );
            $templateRepo->addTemplate( $item );
        }
        $linotype->setTemplates( $templateRepo );

        $themeRepo = new ThemeRepo();
        foreach( $this->configLoader->get('theme') as $config_id => $config ) 
        {
            $item = new ThemeEntity();
            $item->setID($config_id);
            $item->setVersion($config['version']);
            $item->setAuthor($config['author']);
            $item->setName($config['name']);
            $item->setDesc($config['desc']);
            $item->setMap($config['map']);
            $item->setInfo( 'theme', $config_id, $this->directory . '/Theme' );
            $themeRepo->addTheme( $item );
        }
        $linotype->setThemes( $themeRepo );

        // $linotype->setActive( new ActiveBuilder( $linotype ) );

        $linotype->setCurrent( new CurrentBuilder( $linotype ) );

        $this->linotype = $linotype;
    }

    public function get(): ?LinotypeEntity
    {   
        return $this->linotype ? $this->linotype : null;
    }

}
