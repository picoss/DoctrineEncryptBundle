<?php

namespace Ambta\DoctrineEncryptBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder() {

        //Create tree builder
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ambta_doctrine_encrypt');

        $rootNode
            ->children()
                ->scalarNode('secret_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('encryptor')
                    ->defaultValue('defuse')
                ->end()
            ->end();

        return $treeBuilder;
    }

}