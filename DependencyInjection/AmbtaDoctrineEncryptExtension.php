<?php

namespace Ambta\DoctrineEncryptBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Initialization of bundle.
 *
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AmbtaDoctrineEncryptExtension extends Extension
{

    public static $supportedEncryptorClasses = array(
        'defuse' => 'Ambta\DoctrineEncryptBundle\Encryptors\DefuseEncryptor',
        'defuse_salt'=> 'Ambta\DoctrineEncryptBundle\Encryptors\DefuseSaltEncryptor');

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {

        //Create configuration object
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        //Set orm-service in array of services
        $services = array('orm' => 'orm-services');

        //set supported encryptor classes
        $supportedEncryptorClasses = self::$supportedEncryptorClasses;

        //If no secret key is set, check for framework secret, otherwise throw exception
        if (empty($config['secret_key'])) {
            if ($container->hasParameter('secret')) {
                $config['secret_key'] = $container->getParameter('secret');
            } else {
                throw new \RuntimeException('You must provide "secret_key" for DoctrineEncryptBundle or "secret" for framework');
            }
        }

        if (isset(self::$supportedEncryptorClasses[$config['encryptor']])) {
            $encryptorClass = self::$supportedEncryptorClasses[$config['encryptor']];
        }
        else {
            $encryptorClass = $config['encryptor'];
        }

        //Set parameters
        $container->setParameter('ambta_doctrine_encrypt.encryptor_class_name', $encryptorClass);
        $container->setParameter('ambta_doctrine_encrypt.secret_key', $config['secret_key']);

        //Load service file
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load(sprintf('%s.xml', $services['orm']));

    }

    /**
     * Get alias for configuration
     *
     * @return string
     */
    public function getAlias() {
        return 'ambta_doctrine_encrypt';
    }
}
