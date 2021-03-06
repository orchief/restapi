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
    protected $error = '获取成功！';

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

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $curl->get($url, $data);

        $res = json_encode($curl->response);
        $res = json_decode($res, true);
        if ($res['status'] == 'OK') {
            return $res['routes'][0]['legs'][0]['distance']['value'];
        } else {
            $this->error = $res['error_message'];

            return false;
        }
    }

    /**
     * 获取错误消息.
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 通过地址字符串获取经纬度.
     *
     * @param string $address
     */
    public function geocoding($address)
    {
        $curl = new Curl();
        $configs = $this->app->getConfig();
        $data = [
            'address' => $address,
            'key' => $configs['key'],
        ];

        $url = $this->api.'geocode/'.$this->dataType;

        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);

        $curl->get($url, $data);

        $res = json_encode($curl->response);
        $res = json_decode($res, true);

        if ($res['status'] == 'OK') {
            return $res['results'][0]['geometry']['location'];
        } else {
            $this->error = $res['error_message'];

            return false;
        }
    }
}
