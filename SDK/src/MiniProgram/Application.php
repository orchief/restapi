<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\MiniProgram;

use SDK\BasicService;
use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \SDK\MiniProgram\Auth\AccessToken            $access_token
 * @property \SDK\MiniProgram\DataCube\Client             $data_cube
 * @property \SDK\MiniProgram\AppCode\Client              $app_code
 * @property \SDK\MiniProgram\Auth\Client                 $auth
 * @property \SDK\OfficialAccount\Server\Guard            $server
 * @property \SDK\MiniProgram\Encryptor                   $encryptor
 * @property \SDK\MiniProgram\TemplateMessage\Client      $template_message
 * @property \SDK\OfficialAccount\CustomerService\Client  $customer_service
 * @property \SDK\BasicService\Media\Client               $media
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        Server\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        // Base services
        BasicService\Media\ServiceProvider::class,
    ];
}
