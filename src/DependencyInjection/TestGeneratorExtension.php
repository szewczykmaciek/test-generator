<?php
namespace SzewczykMaciek\Bundle\TestGenerator\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use SzewczykMaciek\Bundle\TestGenerator\DependencyInjection\CompilerPass\TestGeneratorCommandRegistrationPass;
use SzewczykMaciek\Bundle\TestGenerator\Util\TestGeneratorInterface;


class TestGeneratorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('generators.xml');

        $container->registerForAutoconfiguration(TestGeneratorInterface::class)
            ->addTag(TestGeneratorCommandRegistrationPass::TEST_GENERATOR_TAG);
    }
}
