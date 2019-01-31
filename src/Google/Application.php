<?php

namespace SDK\Google;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Google\Map\Client $Map
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Map\ServiceProvider::class,
    ];
}
