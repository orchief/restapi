<?php

namespace SDK\Umeng\Push\ios;

use SDK\Umeng\Push\iosNotification;

class IOSBroadcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'broadcast';
    }
}
