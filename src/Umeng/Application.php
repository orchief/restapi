<?php

namespace SDK\Umeng;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Google\Push\Client $Push
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Push\ServiceProvider::class,
    ];
}
