<?php

namespace SDK\Oss;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Oss\Qiniu\Client $Qiniu
 * @property \SDK\Oss\Ali\Client $Ali
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Qiniu\ServiceProvider::class,
        Ali\ServiceProvider::class,
    ];
}
