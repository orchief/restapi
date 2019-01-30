<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\MiniProgram\AppCode;

use SDK\Kernel\BaseClient;
use SDK\Kernel\Http\StreamResponse;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get AppCode.
     *
     * @param string $path
     * @param array  $optional
     *
     * @return \SDK\Kernel\Http\StreamResponse
     */
    public function get(string $path, array $optional = [])
    {
        $params = array_merge([
            'path' => $path,
        ], $optional);

        return $this->getStream('wxa/getwxacode', $params);
    }

    /**
     * Get AppCode unlimit.
     *
     * @param string $scene
     * @param array  $optional
     *
     * @return \SDK\Kernel\Http\StreamResponse
     */
    public function getUnlimit(string $scene, array $optional = [])
    {
        $params = array_merge([
            'scene' => $scene,
        ], $optional);

        return $this->getStream('wxa/getwxacodeunlimit', $params);
    }

    /**
     * Create QrCode.
     *
     * @param string   $path
     * @param int|null $width
     *
     * @return \SDK\Kernel\Http\StreamResponse
     */
    public function getQrCode(string $path, int $width = null)
    {
        return $this->getStream('cgi-bin/wxaapp/createwxaqrcode', compact('path', 'width'));
    }

    /**
     * Get stream.
     *
     * @param string $endpoint
     * @param array  $params
     *
     * @return \SDK\Kernel\Http\StreamResponse
     */
    protected function getStream(string $endpoint, array $params)
    {
        return StreamResponse::buildFromPsrResponse($this->requestRaw($endpoint, 'POST', ['json' => $params]));
    }
}
