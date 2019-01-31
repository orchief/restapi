<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Juhe\Sms;

use SDK\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    protected $api = 'http://v.juhe.cn/sms/send';
    protected $error = '';

    /**
     * 发送短信
     *
     * @param [type] $phone
     * @param [type] $code
     */
    public function code($data)
    {
        $configs = $this->app->getConfig();
        $smsConf['key'] = $configs['key'];
        $smsConf['mobile'] = $data['phone'];
        $smsConf['tpl_id'] = $configs['tpl_id'];
        $smsConf['tpl_value'] = '#code#='.$data['code'].'&#company#='.$configs['company'];

        $content = $this->httpPost($this->api, $smsConf); //请求发送短信
        if ($content['error_code'] == 0) {
            return true;
        } else {
            $this->error = $content['reason'];

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
}
