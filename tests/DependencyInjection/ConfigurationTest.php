<?php

namespace Tourze\RiskyImageDetectBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\RiskyImageDetectBundle\DependencyInjection\RiskyImageDetectExtension;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

/**
 * 测试扩展配置加载功能
 */
class ConfigurationTest extends TestCase
{
    /**
     * 测试空配置情况下的扩展加载
     */
    public function testLoadWithEmptyConfiguration(): void
    {
        $container = new ContainerBuilder();
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        // 确保服务被正确注册
        $this->assertTrue($container->hasDefinition('Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector'));

        // 验证服务定义
        $definition = $container->getDefinition('Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector');
        $this->assertTrue($definition->isAutowired(), '服务应该是自动装配的');
        $this->assertTrue($definition->isAutoconfigured(), '服务应该是自动配置的');
    }

    /**
     * 测试加载过程中的类解析
     */
    public function testClassResolving(): void
    {
        $container = new ContainerBuilder();
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        // 测试服务类的解析
        $definition = $container->getDefinition('Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector');
        $this->assertEquals(DefaultRiskyImageDetector::class, $definition->getClass());
    }
}
