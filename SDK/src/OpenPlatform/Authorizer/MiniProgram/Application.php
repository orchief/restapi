<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OpenPlatform\Authorizer\MiniProgram;

use SDK\MiniProgram\Application as MiniProgram;
use SDK\OpenPlatform\Authorizer\Aggregate\AggregateServiceProvider;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \SDK\OpenPlatform\Authorizer\Aggregate\Account\Client   $account
 * @property \SDK\OpenPlatform\Authorizer\MiniProgram\Code\Client    $code
 * @property \SDK\OpenPlatform\Authorizer\MiniProgram\Domain\Client  $domain
 * @property \SDK\OpenPlatform\Authorizer\MiniProgram\Tester\Client  $tester
 */
class Application extends MiniProgram
{
    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $prepends
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            AggregateServiceProvider::class,
            Code\ServiceProvider::class,
            Domain\ServiceProvider::class,
            Tester\ServiceProvider::class,
        ];

        foreach ($providers as $provider) {
            $this->register(new $provider());
        }
    }
}
