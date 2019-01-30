<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\Work\Message;

use SDK\Kernel\BaseClient;
use SDK\Kernel\Messages\Message;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string|\SDK\Kernel\Messages\Message $message
     *
     * @return \SDK\Work\Message\Messenger
     *
     * @throws \SDK\Kernel\Exceptions\InvalidArgumentException
     */
    public function message($message)
    {
        return (new Messenger($this))->message($message);
    }

    /**
     * @param array $message
     *
     * @return \Psr\Http\Message\ResponseInterface|\SDK\Kernel\Support\Collection|array|object|string
     */
    public function send(array $message)
    {
        return $this->httpPostJson('cgi-bin/message/send', $message);
    }
}
