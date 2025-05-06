<?php

namespace Tourze\RiskyImageDetectBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\RiskyImageDetectBundle\DependencyInjection\RiskyImageDetectExtension;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

class RiskyImageDetectExtensionTest extends TestCase
{
    /**
     * 测试扩展是否正确注册服务
     */
    public function testLoad_registersServices(): void
    {
        $container = new ContainerBuilder();
        $extension = new RiskyImageDetectExtension();

        $extension->load([], $container);

        $this->assertTrue($container->has(DefaultRiskyImageDetector::class), '容器应该包含DefaultRiskyImageDetector服务');

        // 由于使用AsAlias属性，而不是通过容器定义别名，无法在测试中直接验证别名
        // 这是因为别名是通过PHP属性定义的，在容器编译前不会被解析
        // 我们可以在集成测试中验证这一点
    }

    /**
     * 测试空配置时的服务加载
     */
    public function testLoad_withEmptyConfiguration(): void
    {
        $container = new ContainerBuilder();
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
