<?php

namespace Lepig\Weather;

use GuzzleHttp\Client;

class Weather
{
    private $key; //高德地图申请的key
    private $guzzleOptions = [];

    public function __construct($key = 'd68ca78ded6b4d5bbc0eb55caa1e27a3')
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
    public function getWeather($city = '341103', string $type = 'base', string $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        $query = array_filter([ //过滤参数值等同于空的键
            'key'        => $this->key,
            'city'       => $city,
            'extensions' => $type,
            'output'     => $format,
        ]);

        $response = $this->getHttpClient()->get($url, [
            'query' => $query,
        ])->getBody()->getContents();


        return 'json' === $format ? \json_decode($response, true) : $response;
    }
}


// $r = (new Weather)->getWeather();