<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SDK\OfficialAccount\ShakeAround;

use SDK\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \SDK\OfficialAccount\ShakeAround\DeviceClient   $device
 * @property \SDK\OfficialAccount\ShakeAround\GroupClient    $group
 * @property \SDK\OfficialAccount\ShakeAround\MaterialClient $material
 * @property \SDK\OfficialAccount\ShakeAround\RelationClient $relation
 * @property \SDK\OfficialAccount\ShakeAround\StatsClient    $stats
 */
class ShakeAround extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \SDK\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["shake_around.{$property}"])) {
            return $this->app["shake_around.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No shake_around service named "%s".', $property));
    }
}
