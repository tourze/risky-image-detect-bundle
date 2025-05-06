# 风险图片检测 Bundle

这是一个Symfony Bundle，提供风险图片检测功能。

## 安装

使用Composer安装此包：

```bash
composer require tourze/risky-image-detect-bundle
```

## 配置

在您的Symfony项目中启用此Bundle：

```php
// config/bundles.php
return [
    // ...
    Tourze\RiskyImageDetectBundle\RiskyImageDetectBundle::class => ['all' => true],
];
```

## 使用方法

此Bundle提供了一个 `RiskyImageDetector` 接口及其默认实现 `DefaultRiskyImageDetector`，用于检测图片是否包含风险内容。

```php
// 通过依赖注入使用
use Tourze\RiskyImageDetectBundle\Service\RiskyImageDetector;

class YourService
{
    public function __construct(
        private readonly RiskyImageDetector $riskyImageDetector
    ) {
    }
    
    public function processImage(string $imageData): void
    {
        if ($this->riskyImageDetector->isRiskyImage($imageData)) {
            // 处理风险图片...
        } else {
            // 处理正常图片...
        }
    }
}
```

## 自定义实现

您可以创建自己的 `RiskyImageDetector` 实现，并使用Symfony的服务配置将其设置为默认实现：

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
    }
}
```

## 开发

运行测试：

```bash
./vendor/bin/phpunit packages/risky-image-detect-bundle/tests
```

## 许可证

本包基于MIT许可证发布。详情请参阅[LICENSE](LICENSE)文件。
