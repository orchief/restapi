<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Google\Map;

use SDK\Kernel\BaseClient;
use Curl\Curl;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * 谷歌地图接口地址
     *
     * @var string
     */
    protected $api = 'https://maps.googleapis.com/maps/api/';

    /**
     * 谷歌地图返回数据类型.
     *
     * @var string
     */
    protected $dataType = 'json';

    /**
     * 路线规划.
     *
     * @param [type] $origin      起点
     * @param [type] $destination 终点
     * @param string $mode        模式
     */
    public function directions($origin, $destination, $mode = 'bicycling')
    {
        $curl = new Curl();
        $configs = $this->app->getConfig();
        $data = [
            'origin' => $origin,
            'destination' => $destination,
            // 'mode' => $mode,
            'key' => $configs['key'],
        ];

        $url = $this->api.'directions/'.$this->dataType;

        $curl->setProxy('127.0.0.1', '8888');

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $curl->get($url, $data);

        $res = json_encode($curl->response);
        $res = json_decode($res, true);

        return $res['routes'][0]['legs'][0]['distance']['value'];
    }

    /**
     * 通过地址字符串获取经纬度.
     *
     * @param string $address
     */
    public function geocoding($address)
    {
        // return [
        //     'lat'   =>  '39',
        //     'lng'   =>  '117'
        // ];
        $curl = new Curl();
        $configs = $this->app->getConfig();
        $data = [
            'address' => $address,
            'key' => $configs['key'],
        ];

        $url = $this->api.'geocode/'.$this->dataType;

        $curl->setProxy('127.0.0.1', '8888');

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $curl->get($url, $data);

        $res = json_encode($curl->response);
        $res = json_decode($res, true);

        return $res['results'][0]['geometry']['location'];
    }
}
