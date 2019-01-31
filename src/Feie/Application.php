<?php

namespace SDK\Feie;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Feie\Printer\Client  $Printer
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Printer\ServiceProvider::class
    ];
}
