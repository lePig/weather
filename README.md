<h1 align="center"> weather </h1>

<p align="center"> A weather SDK..</p>


## Installing

```shell
$ composer require lepig/weather -vvv
```
## 配置
在使用此组件之前，你需要去[高德开放平台](https://lbs.amap.com/dev/index)注册帐号，并申请应用，获取应用的API Key.

## Usage
```php
use Lepig\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);
```

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/lepig/weather/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/lepig/weather/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT