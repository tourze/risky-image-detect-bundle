<?php

namespace Tourze\RiskyImageDetectBundle\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Tourze\IntegrationTestKernel\IntegrationTestKernel;
use Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;
use Tourze\RiskyImageDetectBundle\Service\RiskyImageDetector;

/**
 * 风险图片检测服务的集成测试
 */
class RiskyImageDetectBundleIntegrationTest extends TestCase
{
    /**
     * 测试默认检测器是否正确实现了接口
     */
    public function testDetectorImplementsInterface(): void
    {
        $detector = new DefaultRiskyImageDetector();
        $this->assertInstanceOf(RiskyImageDetector::class, $detector);
    }

    /**
     * 测试检测器在各种输入下的行为
     */
    public function testDetectorBehavior(): void
    {
        $detector = new DefaultRiskyImageDetector();

        // 根据当前实现，所有输入都应返回false
        $this->assertFalse($detector->isRiskyImage('test-image'), '标准输入应返回false');
        $this->assertFalse($detector->isRiskyImage(''), '空字符串应返回false');
        $this->assertFalse($detector->isRiskyImage(str_repeat('a', 1000)), '长字符串应返回false');
        $this->assertFalse($detector->isRiskyImage('!@#$%^&*()'), '特殊字符应返回false');
    }

    protected static function getKernelClass(): string
    {
        return IntegrationTestKernel::class;
    }

    protected static function createKernel(array $options = []): IntegrationTestKernel
    {
        $appendBundles = [
            FrameworkBundle::class => ['all' => true],
            RiskyImageDetectBundle::class => ['all' => true],
        ];
        
        $entityMappings = [];

        return new IntegrationTestKernel(
            $options['environment'] ?? 'test',
            $options['debug'] ?? true,
            $appendBundles,
            $entityMappings
        );
    }
}
