<?php

namespace Linotype\Core\Model;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class FieldModel implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('field');
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
                ->scalarNode('title')
                    ->defaultValue('Unknow')
                    ->info('')
                    ->end()
                ->scalarNode('info')
                    ->defaultValue('')
                    ->info('')
                    ->end()
                ->scalarNode('require')
                    ->defaultFalse()
                    ->info('')
                    ->end()
                ->arrayNode('format')
                    ->scalarPrototype()->end()
                    ->info('')
                    ->end()
                ->variableNode('option')
                    ->defaultValue([])
                    ->info('')
                    ->end()
            ->end()
        ;
        return $treeBuilder;
    }
    
}
