<?php

namespace Linotype\Core\Model;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class HelperModel implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('helper');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->floatNode('version')
                    ->defaultValue(1.0)
                    ->info('')
                    ->end()
                ->scalarNode('author')
                    ->defaultValue('Unknow')
                    ->info('')
                    ->end()
                ->scalarNode('name')
                    ->defaultValue('Unknow')
                    ->info('')
                    ->end()
                ->scalarNode('desc')
                    ->defaultValue('')
                    ->info('')
                    ->end()
                ->arrayNode('package')
                    ->defaultValue([])
                    ->scalarPrototype()->end()
                    ->info('')
                    ->end()
                ->arrayNode('methode')
                    ->arrayPrototype()
                    ->children()
                        ->scalarNode('name')
                            ->defaultValue('Unknow')
                            ->info('')
                            ->end()
                        ->scalarNode('desc')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->scalarNode('controller')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->end()
                    ->end()
                    ->info('')
                    ->end()
            ->end()
        ;
        return $treeBuilder;
    }
    
}
