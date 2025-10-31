<?php

namespace TourzeRiskyImageDetectBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

/**
 * @internal
 */
#[CoversClass(DefaultRiskyImageDetector::class)]
#[RunTestsInSeparateProcesses]
final class DefaultRiskyImageDetectorTest extends AbstractIntegrationTestCase
{
    /**
     * 子类自定义初始化逻辑
     */
    protected function onSetUp(): void
    {
        // 集成测试不需要特殊初始化
    }

    /**
     * 测试使用有效图片字符串时的行为
     */
    public function testIsRiskyImageWithValidImageString(): void
    {
        $detector = self::getService(DefaultRiskyImageDetector::class);
        self::assertFalse($detector->isRiskyImage('valid-image-data'));
    }

    /**
     * 测试使用空字符串时的行为
     */
    public function testIsRiskyImageWithEmptyString(): void
    {
        $detector = self::getService(DefaultRiskyImageDetector::class);
        self::assertFalse($detector->isRiskyImage(''));
    }

    /**
     * 测试使用特殊字符时的行为
     */
    public function testIsRiskyImageWithSpecialCharacters(): void
    {
        $detector = self::getService(DefaultRiskyImageDetector::class);
        self::assertFalse($detector->isRiskyImage('!@#$%^&*()_+'));
    }

    /**
     * 测试使用非常长的字符串时的行为
     */
    public function testIsRiskyImageWithLongString(): void
    {
        $detector = self::getService(DefaultRiskyImageDetector::class);
        $longString = str_repeat('a', 10000); // 生成一个非常长的字符串
        self::assertFalse($detector->isRiskyImage($longString));
    }
}
