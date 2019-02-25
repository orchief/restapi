<?php

/*
 * 友盟推送
 */

namespace SDK\Umeng\Push;

use SDK\Kernel\BaseClient;
use SDK\Umeng\Push\ios\IOSCustomizedcast;
use SDK\Umeng\Push\android\AndroidCustomizedcast;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    protected $appkey = null;
    protected $appMasterSecret = null;
    protected $timestamp = null;
    protected $validation_token = null;
    protected $msgData = null;
    private $error = null;
    protected $alias_type = 'UID';

    /**
     * 发送推送
     *
     * @param [type] $msgData
     */
    public function send($msgData)
    {
        $this->msgData = $msgData;
        $this->timestamp = strval(time());

        $configs = $this->app->getConfig();
        // 配置ios
        $this->appkey = $configs['AppKeyIos'];
        $this->appMasterSecret = $configs['MasterSecretIos'];
        $res1 = $this->sendIosMsg();

        // 配置 andriod
        $this->appkey = $configs['AppKeyAndriod'];
        $this->appMasterSecret = $configs['MasterSecretAndriod'];
        $res2 = $this->sendAndriodMsg();

        return $res1 or $res2;
    }

    /**
     * ios 用户推送
     */
    private function sendIosMsg()
    {
        try {
            $unicast = new IOSCustomizedcast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue('appkey', $this->appkey);
            $unicast->setPredefinedKeyValue('timestamp', $this->timestamp);
            $unicast->setPredefinedKeyValue('type', 'customizedcast');
            $unicast->setPredefinedKeyValue('alias', $this->msgData['userId']);
            $unicast->setPredefinedKeyValue('alias_type', $this->alias_type);

            $body = [
                'title' => $this->msgData['title'],
                'body' => $this->msgData['content'],
            ];

            $unicast->setPredefinedKeyValue('alert', $body);

            if(isset($this->msgData['sound']) && $this->msgData['sound']){
                $unicast->setPredefinedKeyValue('sound', $this->msgData['sound']);
            }

            $unicast->setPredefinedKeyValue('production_mode', 'false');

            $unicast->send();

            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * 安卓用户推送
     */
    private function sendAndriodMsg()
    {
        try {
            $unicast = new AndroidCustomizedcast();
            $unicast->setAppMasterSecret($this->appMasterSecret);
            $unicast->setPredefinedKeyValue('appkey', $this->appkey);
            $unicast->setPredefinedKeyValue('timestamp', $this->timestamp);
            $unicast->setPredefinedKeyValue('type', 'customizedcast');
            $unicast->setPredefinedKeyValue('alias', $this->msgData['userId']);
            $unicast->setPredefinedKeyValue('alias_type', 'UID');

            $unicast->setPredefinedKeyValue('ticker', $this->msgData['title']);
            $unicast->setPredefinedKeyValue('title', $this->msgData['title']);
            $unicast->setPredefinedKeyValue('text', $this->msgData['content']);

            $unicast->setPredefinedKeyValue('after_open', 'go_activity');
            $unicast->setPredefinedKeyValue('activity', 'com.withcar.userapp.activity.InformActivity');

            $unicast->setPredefinedKeyValue('production_mode', 'false');

            $unicast->send();

            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    /**
     * 获取错误消息.
     */
    public function getError()
    {
        return $this->error;
    }
}
