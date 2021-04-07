<?php

namespace Linotype\Core\Loader;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Linotype\Core\Model\BlockModel;
use Linotype\Core\Model\FieldModel;
use Linotype\Core\Model\HelperModel;
use Linotype\Core\Model\LinotypeModel;
use Linotype\Core\Model\ModuleModel;
use Linotype\Core\Model\TemplateModel;
use Linotype\Core\Model\ThemeModel;

class ConfigLoader
{

    private $config;

    private $dir;

    public function __construct( $dir )
    {
        $this->dir = $dir;
        $this->load();
    }

    public function load()
    {
        $config = ['block' => [],'field' => [],'helper' => [],'module' => [],'template' => [],'theme' => [], 'linotype' => []];
        $finder = new Finder();
        $finder->files()->name(['*.yml', '*.yaml'])->in($this->dir)->exclude('node_modules');
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $id = $file->getFilenameWithoutExtension();
                $path = $file->getPathname();
                $contents = Yaml::parse( file_get_contents($path) );
                if ( isset( $config[ key($contents) ][$id] ) ) {
                    throw new \Exception('Linotype: Config Yaml "' . key($contents) . '" with id "' . $id . '" already exist.');
                }
                $processor = new Processor();
                switch(key($contents)){
                    case 'block':
                        $configModel = new BlockModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'field':
                        $configModel = new FieldModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'helper':
                        $configModel = new HelperModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'module':
                        $configModel = new ModuleModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'template':
                        $configModel = new TemplateModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'theme':
                        $configModel = new ThemeModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ][$id] = $processedConfiguration;
                        break;
                    case 'linotype':
                        $configModel = new LinotypeModel();
                        $processedConfiguration = $processor->processConfiguration( $configModel, $contents );
                        $config[ key($contents) ] = $processedConfiguration;
                        break;
                }
            }
        }
        $this->config = $config;
    }

    public function get($type = null): ?array
    {   
        return isset( $this->config[$type] ) ? $this->config[$type] : $this->config;
    }
    
}
