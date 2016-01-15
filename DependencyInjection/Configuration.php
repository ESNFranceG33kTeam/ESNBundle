<?php

namespace Esn\EsnBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('esn');

        $rootNode
            ->children()
                ->arrayNode('cas')
                    ->children()
                        ->scalarNode('host')->end()
                        ->integerNode('port')->end()
                        ->scalarNode('context')->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
