<?php

namespace Tourze\RiskyImageDetectBundle\Service;

interface RiskyImageDetector
{
    /**
     * 检查是否是敏感图片
     */
    public function isRiskyImage(string $image): bool;
}
