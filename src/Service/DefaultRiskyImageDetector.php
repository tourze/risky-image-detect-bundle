<?php

namespace Tourze\RiskyImageDetectBundle\Service;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

#[AsAlias(id: RiskyImageDetector::class)]
#[Autoconfigure(public: true)]
class DefaultRiskyImageDetector implements RiskyImageDetector
{
    public function isRiskyImage(string $image): bool
    {
        // TODO 默认暂时不做任何检查
        return false;
    }
}
