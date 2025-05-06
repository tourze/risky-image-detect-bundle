<?php

namespace Tourze\RiskyImageDetectBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Tourze\RiskyImageDetectBundle\Service\DefaultRiskyImageDetector;

class DefaultRiskyImageDetectorTest extends TestCase
{
    /**
     * 测试使用有效图片字符串时的行为
     */
    public function testIsRiskyImage_withValidImageString(): void
    {
        $detector = new DefaultRiskyImageDetector();
        $this->assertFalse($detector->isRiskyImage('valid-image-data'));
    }

    /**
     * 测试使用空字符串时的行为
     */
    public function testIsRiskyImage_withEmptyString(): void
    {
        $detector = new DefaultRiskyImageDetector();
        $this->assertFalse($detector->isRiskyImage(''));
    }

    /**
     * 测试使用特殊字符时的行为
     */
    public function testIsRiskyImage_withSpecialCharacters(): void
    {
        $detector = new DefaultRiskyImageDetector();
        $this->assertFalse($detector->isRiskyImage('!@#$%^&*()_+'));
    }

    /**
     * 测试使用非常长的字符串时的行为
     */
    public function testIsRiskyImage_withLongString(): void
    {
        $detector = new DefaultRiskyImageDetector();
        $longString = str_repeat('a', 10000); // 生成一个非常长的字符串
        $this->assertFalse($detector->isRiskyImage($longString));
    }
}
