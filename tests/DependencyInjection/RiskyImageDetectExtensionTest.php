<?php

namespace TourzeRiskyImageDetectBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\RiskyImageDetectBundle\DependencyInjection\RiskyImageDetectExtension;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

/**
 * @internal
 */
#[CoversClass(RiskyImageDetectExtension::class)]
final class RiskyImageDetectExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
    /**
     * 测试空配置时的服务加载
     */
    public function testLoadWithEmptyConfiguration(): void
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.environment', 'test');
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        // 即使配置为空，服务仍应被注册
        $this->assertTrue($container->has(DefaultRiskyImageDetector::class), '即使配置为空，服务也应该被注册');

        // 验证服务定义是自动装配的
        $definition = $container->getDefinition(DefaultRiskyImageDetector::class);
        $this->assertTrue($definition->isAutowired(), '服务应该是自动装配的');
        $this->assertTrue($definition->isAutoconfigured(), '服务应该是自动配置的');
    }
}
