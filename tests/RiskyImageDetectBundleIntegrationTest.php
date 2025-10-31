<?php

namespace TourzeRiskyImageDetectBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

/**
 * 风险图片检测服务的集成测试
 *
 * @internal
 */
#[CoversClass(DefaultRiskyImageDetector::class)]
#[RunTestsInSeparateProcesses]
final class RiskyImageDetectBundleIntegrationTest extends AbstractIntegrationTestCase
{
    /**
     * 子类自定义初始化逻辑
     */
    protected function onSetUp(): void
    {
        // 集成测试不需要特殊初始化
    }

    /**
     * 测试检测器在各种输入下的行为
     */
    public function testDetectorBehavior(): void
    {
        $detector = self::getService(DefaultRiskyImageDetector::class);

        // 根据当前实现，所有输入都应返回false
        self::assertFalse($detector->isRiskyImage('test-image'), '标准输入应返回false');
        self::assertFalse($detector->isRiskyImage(''), '空字符串应返回false');
        self::assertFalse($detector->isRiskyImage(str_repeat('a', 1000)), '长字符串应返回false');
        self::assertFalse($detector->isRiskyImage('!@#$%^&*()'), '特殊字符应返回false');
    }
}
