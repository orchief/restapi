<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OfficialAccount;

use SDK\BasicService;
use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \SDK\BasicService\Media\Client               $media
 * @property \SDK\BasicService\Url\Client                 $url
 * @property \SDK\BasicService\QrCode\Client              $qrcode
 * @property \SDK\BasicService\Jssdk\Client               $jssdk
 * @property \SDK\OfficialAccount\Auth\AccessToken        $access_token
 * @property \SDK\OfficialAccount\Server\Guard            $server
 * @property \SDK\OfficialAccount\User\UserClient         $user
 * @property \SDK\OfficialAccount\User\TagClient          $user_tag
 * @property \SDK\OfficialAccount\Menu\Client             $menu
 * @property \SDK\OfficialAccount\TemplateMessage\Client  $template_message
 * @property \SDK\OfficialAccount\Material\Client         $material
 * @property \SDK\OfficialAccount\CustomerService\Client  $customer_service
 * @property \SDK\OfficialAccount\Semantic\Client         $semantic
 * @property \SDK\OfficialAccount\DataCube\Client         $data_cube
 * @property \SDK\OfficialAccount\AutoReply\Client        $auto_reply
 * @property \SDK\OfficialAccount\Broadcasting\Client     $broadcasting
 * @property \SDK\OfficialAccount\Card\Card               $card
 * @property \SDK\OfficialAccount\Device\Client           $device
 * @property \SDK\OfficialAccount\ShakeAround\ShakeAround $shake_around
 * @property \SDK\OfficialAccount\Base\Client             $base
 * @property \Overtrue\Socialite\Providers\WeChatProvider        $oauth
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        User\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        Menu\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        Material\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        Semantic\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        POI\ServiceProvider::class,
        AutoReply\ServiceProvider::class,
        Broadcasting\ServiceProvider::class,
        Card\ServiceProvider::class,
        Device\ServiceProvider::class,
        ShakeAround\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Base\ServiceProvider::class,
        // Base services
        BasicService\QrCode\ServiceProvider::class,
        BasicService\Media\ServiceProvider::class,
        BasicService\Url\ServiceProvider::class,
        BasicService\Jssdk\ServiceProvider::class,
    ];
}
