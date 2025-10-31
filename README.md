# Risky Image Detect Bundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![PHP Version](https://img.shields.io/packagist/php-v/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![License](https://img.shields.io/packagist/l/tourze/risky-image-detect-bundle.svg?style=flat-square)](https://packagist.org/packages/tourze/risky-image-detect-bundle)
[![Coverage Status](https://img.shields.io/codecov/c/github/tourze/php-monorepo.svg?style=flat-square)](https://codecov.io/gh/tourze/php-monorepo)

A Symfony Bundle for detecting risky image content, providing a secure image validation service.

## Features

- Simple and extensible interface for risky image detection
- Default implementation ready to use out of the box
- Easy to customize with your own detection logic
- Fully compatible with Symfony 6.4+ and PHP 8.1+
- Comprehensive test coverage

## Installation

Install this package using Composer:

```bash
composer require tourze/risky-image-detect-bundle
```

## Configuration

Enable this bundle in your Symfony project:

```php
// config/bundles.php
return [
    // ...
    Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle::class => ['all' => true],
];
```

## Quick Start

This bundle provides a `RiskyImageDetector` interface and its default implementation `DefaultRiskyImageDetector` for detecting risky image content.

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
            // Handle risky image...
            throw new \Exception('Risky image detected');
        } else {
            // Process normal image...
            $this->processNormalImage($imageData);
        }
    }
    
    private function processNormalImage(string $imageData): void
    {
        // Your image processing logic here
    }
}
```

## Customization

You can create your own `RiskyImageDetector` implementation and set it as the default using Symfony's service configuration:

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
        // Your custom implementation...
        // For example, integrate with external API or use ML models
        return $this->checkWithExternalService($image);
    }
    
    private function checkWithExternalService(string $image): bool
    {
        // Implementation details...
        return false;
    }
}
```

## Development

Run tests:

```bash
./vendor/bin/phpunit packages/risky-image-detect-bundle/tests
```

Run static analysis:

```bash
php -d memory_limit=2G ./vendor/bin/phpstan analyse packages/risky-image-detect-bundle
```

## License

This package is released under the MIT License. See [LICENSE](LICENSE) file for details.
