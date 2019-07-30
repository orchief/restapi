<?php

namespace SDK\Bank;

use SDK\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \SDK\Bank\Nong\Client  $Printer
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Nong\ServiceProvider::class
    ];
}
