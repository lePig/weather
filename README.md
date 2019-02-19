<h1 align="center"> weather </h1>

[![Build Status](https://travis-ci.org/lePig/weather.svg?branch=master)](https://travis-ci.org/lePig/weather)

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
## 获取实时天气
```php
$weather->getWeather('滁州');
```
返回结果示例：
```json
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "lives": [
        {
            "province": "安徽",
            "city": "滁州市",
            "adcode": "341100",
            "weather": "多云",
            "temperature": "2",
            "winddirection": "西北",
            "windpower": "≤3",
            "humidity": "84",
            "reporttime": "2019-02-19 11:17:22"
        }
    ]
}
```

## 获取最近几天的天气
```php
$weather->getWeather('滁州', 'all');
```
返回结果示例：
```json
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "forecasts": [
        {
            "city": "滁州市",
            "adcode": "341100",
            "province": "安徽",
            "reporttime": "2019-02-19 11:17:22",
            "casts": [
                {
                    "date": "2019-02-19",
                    "week": "2",
                    "dayweather": "多云",
                    "nightweather": "多云",
                    "daytemp": "5",
                    "nighttemp": "2",
                    "daywind": "西北",
                    "nightwind": "西北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2019-02-20",
                    "week": "3",
                    "dayweather": "小雨",
                    "nightweather": "阴",
                    "daytemp": "6",
                    "nighttemp": "3",
                    "daywind": "东北",
                    "nightwind": "东北",
                    "daypower": "4",
                    "nightpower": "4"
                },
                {
                    "date": "2019-02-21",
                    "week": "4",
                    "dayweather": "小雨",
                    "nightweather": "中雨",
                    "daytemp": "10",
                    "nighttemp": "0",
                    "daywind": "东北",
                    "nightwind": "东北",
                    "daypower": "4",
                    "nightpower": "4"
                },
                {
                    "date": "2019-02-22",
                    "week": "5",
                    "dayweather": "多云",
                    "nightweather": "晴",
                    "daytemp": "4",
                    "nighttemp": "0",
                    "daywind": "北",
                    "nightwind": "北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                }
            ]
        }
    ]
}
```

## 独立的方法调用

### 获取实时天气
```php
$weather->getLiveWeather('滁州');
```

### 获取未来几天天气预报
```php
$weather->getForecastsWeather('滁州');
```


## 参数说明
```php
array | string   getWeather(string $city, string $type = 'base', string $format = 'json')
```
> $city - 城市名称或城市adcode
> $type - 返回内容类型： base->返回实时天气  all->返回预报天气
> $format - 输出的数据格式，默认为json。 可选xml


## 在Laravel中使用
在Laravel中和之前的安装方式一致。申请的key值需要配置在`config/services.php`中：
```php
'weather' => [
        'key' => env('WEATHER_API_KEY')
    ]
```
然后在`.env`文件中配置上`WEATHER_API_KEY`
```php
WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```


## 说明
实例`$weather`的获取可以通过参数注入的方式，也可以通过服务名的方式。

### 通过参数注入
```php
public function show(Weather $weather, $city)
{
    return $weather->getWeather($city);
}
```

### 通过服务名方式
```php
public function show($city)
{
    return app('weather')->getWeather($city, 'all', 'xml');
}
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