<?php

namespace Tourze\RiskyImageDetectBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle;

/**
 * 集成测试内核
 *
 * 注意：当前RiskyImageDetectBundle不需要复杂的容器配置，
 * 因此我们使用简化版测试内核。
 */
class IntegrationTestKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new RiskyImageDetectBundle(),
        ];
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        // 框架基本配置
        $container->extension('framework', [
            'test' => true,
            'secret' => 'test',
            'http_method_override' => false,
            'handle_all_throwables' => true,
            'php_errors' => [
                'log' => true,
            ],
            'validation' => [
                'email_validation_mode' => 'html5',
            ],
        ]);
    }

    /**
     * 获取缓存目录
     */
    public function getCacheDir(): string
    {
        return sys_get_temp_dir() . '/risky_image_detect_bundle/cache/' . $this->environment;
    }

    /**
     * 获取日志目录
     */
    public function getLogDir(): string
    {
        return sys_get_temp_dir() . '/risky_image_detect_bundle/logs';
    }
}
