<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OpenPlatform\Authorizer\OfficialAccount\OAuth;

use SDK\OpenPlatform\Application;
use Overtrue\Socialite\WeChatComponentInterface;

/**
 * Class ComponentDelegate.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ComponentDelegate implements WeChatComponentInterface
{
    /**
     * @var \SDK\OpenPlatform\Application
     */
    protected $app;

    /**
     * ComponentDelegate Constructor.
     *
     * @param \SDK\OpenPlatform\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->app['config']['app_id'];
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->app['access_token']->getToken()['component_access_token'];
    }
}
