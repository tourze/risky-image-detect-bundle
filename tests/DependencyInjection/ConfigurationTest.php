<?php

namespace TourzeRiskyImageDetectBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\RiskyImageDetectBundle\DependencyInjection\RiskyImageDetectExtension;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

/**
 * 测试扩展配置加载功能
 *
 * @internal
 */
#[CoversClass(RiskyImageDetectExtension::class)]
final class ConfigurationTest extends AbstractDependencyInjectionExtensionTestCase
{
    /**
     * 测试空配置情况下的扩展加载
     */
    public function testLoadWithEmptyConfiguration(): void
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        // 确保服务被正确注册
        $this->assertTrue($container->hasDefinition(DefaultRiskyImageDetector::class));

        // 验证服务定义
        $definition = $container->getDefinition(DefaultRiskyImageDetector::class);
        $this->assertTrue($definition->isAutowired(), '服务应该是自动装配的');
        $this->assertTrue($definition->isAutoconfigured(), '服务应该是自动配置的');
    }

    /**
     * 测试加载过程中的类解析
     */
    public function testClassResolving(): void
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        // 测试服务类的解析
        $definition = $container->getDefinition(DefaultRiskyImageDetector::class);
        $this->assertEquals(DefaultRiskyImageDetector::class, $definition->getClass());
    }
}
