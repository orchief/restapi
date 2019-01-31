<?php

namespace SDK\Umeng\Push\ios;

use SDK\Umeng\Push\iosNotification;

class IOSGroupcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'groupcast';
        $this->data['filter'] = null;
    }
}
