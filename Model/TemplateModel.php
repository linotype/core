<?php

namespace Linotype\Core\Model;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class TemplateModel implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('template');
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
                ->arrayNode('layout')
                    ->arrayPrototype()
                    ->children()
                        ->scalarNode('name')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->scalarNode('desc')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->scalarNode('module')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->scalarNode('block')
                            ->defaultValue('')
                            ->info('')
                            ->end()
                        ->variableNode('override')
                            ->defaultValue([])
                            ->beforeNormalization()->castToArray()->end()
                            ->info('')
                            ->end()
                        ->variableNode('children')
                            ->defaultValue([])
                            ->beforeNormalization()->castToArray()->end()
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
