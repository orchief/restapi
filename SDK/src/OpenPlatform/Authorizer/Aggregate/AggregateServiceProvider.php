<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OpenPlatform\Authorizer\Aggregate;

use SDK\OpenPlatform\Authorizer\Aggregate\Account\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AggregateServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['account'] = function ($app) {
            return new Client($app);
        };
    }
}
