<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Feie\Printer;

use SDK\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * 飞鹅打印机接口地址
     *
     * @var string
     */
    protected $api = 'http://api.feieyun.cn/Api/Open/';

    /**
     * 发送打印机指令.
     *
     * @param [type] $apiname 模块名称
     * @param [type] $data    数据
     */
    public function post($apiname, $data)
    {
        $configs = $this->app->getConfig();

        $time = time();
        $sig = sha1($configs['USER'].$configs['UKEY'].$time);
        $content = array(
            'user' => $configs['USER'],
            'stime' => $time,
            'sig' => $sig,
            'apiname' => $apiname,
        );

        $content = array_merge($content, $data);

        // $queryStr = http_build_query($content);

        return $this->httpGet($this->api, $content);
    }
}
