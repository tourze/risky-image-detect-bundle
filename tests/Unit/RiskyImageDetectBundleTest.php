<?php

namespace Tourze\RiskyImageDetectBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle;

class RiskyImageDetectBundleTest extends TestCase
{
    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new RiskyImageDetectBundle();
        
        $this->assertInstanceOf(RiskyImageDetectBundle::class, $bundle);
    }
}