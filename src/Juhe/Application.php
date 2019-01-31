<?php

namespace SDK\Juhe;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Google\Sms\Client $Sms
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Sms\ServiceProvider::class,
    ];
}
