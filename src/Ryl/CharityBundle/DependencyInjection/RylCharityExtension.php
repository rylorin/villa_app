<?php

namespace Ryl\CharityBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Sonata\EasyExtendsBundle\Mapper\DoctrineCollector;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RylCharityExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $bundles = $container->getParameter('kernel.bundles');
        
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        
        if (isset($bundles['SonataAdminBundle'])) {
        	$loader->load('admin.xml');
        }

        $this->registerDoctrineMapping($config);
    }
    

    /**
     * @param  array $config
     * @return void
     */
    public function registerDoctrineMapping(array $config)
    {
        $collector = DoctrineCollector::getInstance();

        foreach ($config['class'] as $type => $class) {
            if (!class_exists($class)) {
                return;
            }
        }

        $collector->addAssociation($config['class']['sponsor'], 'mapOneToOne', array(
            'fieldName'     => 'image',
            'targetEntity'  => $config['class']['media'],
            'cascade' =>
                array(
                    0 => 'remove',
                    1 => 'persist',
                    2 => 'refresh',
                    3 => 'merge',
                    4 => 'detach',
                ),
            'mappedBy'      => NULL,
            'inversedBy'    => NULL,
            'joinColumns'   => array(
                array(
                    'name' => 'image_id',
                    'referencedColumnName' => 'id',
                    'onDelete' => 'SET NULL',
                ),
            ),
            'orphanRemoval' => false,
        	'nullable' => true,
        ));
        
        $collector->addAssociation($config['class']['project'], 'mapOneToOne', array(
            'fieldName'     => 'image',
            'targetEntity'  => $config['class']['media'],
            'cascade' =>
                array(
                    0 => 'remove',
                    1 => 'persist',
                    2 => 'refresh',
                    3 => 'merge',
                    4 => 'detach',
                ),
            'mappedBy'      => NULL,
            'inversedBy'    => NULL,
            'joinColumns'   => array(
                array(
                    'name' => 'image_id',
                    'referencedColumnName' => 'id',
                    'onDelete' => 'SET NULL',
                ),
            ),
            'orphanRemoval' => false,
        	'nullable' => true,
        ));
    }
        
}
