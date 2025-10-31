<?php

declare(strict_types=1);

namespace Tourze\RiskyImageDetectBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle;

/**
 * @internal
 */
#[CoversClass(RiskyImageDetectBundle::class)]
#[RunTestsInSeparateProcesses]
final class RiskyImageDetectBundleTest extends AbstractBundleTestCase
{
}
