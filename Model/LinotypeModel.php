<?php

namespace Linotype\Core\Model;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class LinotypeModel implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('linotype');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->floatNode('version')
                    ->defaultTrue()
                    ->info('')
                    ->end()
                ->booleanNode('debug')
                    ->defaultFalse()
                    ->info('')
                    ->end()
                ->booleanNode('preview')
                    ->defaultFalse()
                    ->info('')
                    ->end()
                ->scalarNode('theme')
                    ->defaultValue('Default')
                    ->info('')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
    
}
