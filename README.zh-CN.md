# 风险图片检测 Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![PHP Version](https://img.shields.io/packagist/php-v/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![License](https://img.shields.io/packagist/l/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![Coverage Status](https://img.shields.io/codecov/c/github/tourze/php-monorepo.svg?style=flat-square)](https://codecov.io/gh/tourze/php-monorepo)

一个用于检测风险图片内容的 Symfony Bundle，提供安全的图片验证服务。

## 功能特性

- 简单且可扩展的风险图片检测接口
- 开箱即用的默认实现
- 易于使用自定义检测逻辑
- 完全兼容 Symfony 6.4+ 和 PHP 8.1+
- 全面的测试覆盖

## 安装

使用 Composer 安装此包：

```bash
composer require tourze/risky-image-detect-bundle
```

## 配置

在您的 Symfony 项目中启用此 Bundle：

```php
// config/bundles.php
return [
    // ...
    Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle::class => ['all' => true],
];
```

## 快速开始

此 Bundle 提供了一个 `RiskyImageDetector` 接口及其默认实现 `DefaultRiskyImageDetector`，用于检测风险图片内容。

```php
<?php

use Tourze\RiskyImageDetectBundle\Service\RiskyImageDetector;

class ImageProcessingService
{
    public function __construct(
        private readonly RiskyImageDetector $riskyImageDetector
    ) {
    }
    
    public function processImage(string $imageData): void
    {
        if ($this->riskyImageDetector->isRiskyImage($imageData)) {
            // 处理风险图片...
            throw new \Exception('检测到风险图片');
        } else {
            // 处理正常图片...
            $this->processNormalImage($imageData);
        }
    }
    
    private function processNormalImage(string $imageData): void
    {
        // 您的图片处理逻辑
    }
}
```

## 自定义实现

您可以创建自己的 `RiskyImageDetector` 实现，并使用 Symfony 的服务配置将其设置为默认实现：

```php
// src/Service/CustomRiskyImageDetector.php
namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Tourze\RiskyImageDetectBundle\Service\RiskyImageDetector;

#[AsAlias(RiskyImageDetector::class)]
class CustomRiskyImageDetector implements RiskyImageDetector
{
    public function isRiskyImage(string $image): bool
    {
        // 您的自定义实现...
        // 例如，与外部 API 集成或使用机器学习模型
        return $this->checkWithExternalService($image);
    }
    
    private function checkWithExternalService(string $image): bool
    {
        // 实现细节...
        return false;
    }
}
```

## 开发

运行测试：

```bash
./vendor/bin/phpunit packages/risky-image-detect-bundle/tests
```

运行静态分析：

```bash
php -d memory_limit=2G ./vendor/bin/phpstan analyse packages/risky-image-detect-bundle
```

## 许可证

本包基于 MIT 许可证发布。详情请参阅 [LICENSE](LICENSE) 文件。
