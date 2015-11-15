<?php

namespace Ryl\CharityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ryl_charity');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
	        ->children()
		        ->arrayNode('class')
			        ->addDefaultsIfNotSet()
			        ->children()
				        ->scalarNode('sponsor')->defaultValue('Ryl\\CharityBundle\\Entity\\Sponsor')->end()
				        ->scalarNode('project')->defaultValue('Ryl\\CharityBundle\\Entity\\Project')->end()
				        ->scalarNode('media')->defaultValue('Application\\Sonata\\MediaBundle\\Entity\\Media')->end()
			        ->end()
		        ->end()
	        ->end()
        ->end();
                
        return $treeBuilder;
    }

}