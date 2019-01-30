<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OpenPlatform\Authorizer\MiniProgram\Domain;

use SDK\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param array $params
     *
     * @return array|\SDK\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function modify(array $params)
    {
        return $this->httpPostJson('wxa/modify_domain', $params);
    }
}
