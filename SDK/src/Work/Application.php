<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Work;

use SDK\Kernel\ServiceContainer;

/**
 * Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \SDK\Work\OA\Client                   $oa
 * @property \SDK\Work\Auth\AccessToken            $access_token
 * @property \SDK\Work\Agent\Client                $agent
 * @property \SDK\Work\Department\Client           $department
 * @property \SDK\Work\Media\Client                $media
 * @property \SDK\Work\Menu\Client                 $menu
 * @property \SDK\Work\Message\Client              $message
 * @property \SDK\Work\Message\Messenger           $messenger
 * @property \SDK\Work\User\Client                 $user
 * @property \SDK\Work\User\TagClient              $tag
 * @property \SDK\Work\Server\ServiceProvider      $server
 * @property \SDK\BasicService\Jssdk\Client        $jssdk
 * @property \Overtrue\Socialite\Providers\WeWorkProvider $oauth
 *
 * @method mixed getCallbackIp()
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        OA\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Base\ServiceProvider::class,
        Menu\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        User\ServiceProvider::class,
        Agent\ServiceProvider::class,
        Media\ServiceProvider::class,
        Message\ServiceProvider::class,
        Department\ServiceProvider::class,
        Server\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        // http://docs.guzzlephp.org/en/stable/request-options.html
        'http' => [
            'base_uri' => 'https://qyapi.weixin.qq.com/',
        ],
    ];

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this['base']->$method(...$arguments);
    }
}
