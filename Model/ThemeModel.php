<?php

namespace Linotype\Core\Model;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class ThemeModel implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('theme');
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
                ->variableNode('map')
                    ->info('')
                    ->end()
            ->end()
        ;
        return $treeBuilder;
    }
    
}
