<?php

namespace Lepig\Weather;

use GuzzleHttp\Client;
use Lepig\Weather\Exceptions\InvalidArgumentException;
use Lepig\Weather\Exceptions\HttpException;

class Weather
{
    private $key; //高德地图申请的key
    private $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * 返回guzzle的实例
     * @date   2019-02-18
     * @return [type]     [description]
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * 用户可以自定义guzzle的请求相关参数
     * @date  2019-02-18
     * @param array      $options [description]
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * 获取某个城市天气
     * @date   2019-02-18
     * @param  string     $city   城市名称或者adcode(滁州:341103)
     * @param  string     $type   [description]
     * @param  string     $format [description]
     * @return [type]             [description]
     */
    public function getWeather($city, string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        if (! in_array(strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('无效的类型值: ' . $type);
        }

        if (! in_array(strtolower($format), ['json', 'xml'])) {
            throw new InvalidArgumentException('无效的响应格式: ' . $format);
        }

        $query = array_filter([ //过滤参数值等同于空的键
            'key'        => $this->key,
            'city'       => $city,
            'extensions' => $type,
            'output'     => $format,
        ]);

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();


            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch(\Exception $e){
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}


// $r = (new Weather)->getWeather();