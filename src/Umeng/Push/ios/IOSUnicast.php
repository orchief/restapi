<?php

namespace SDK\Umeng\Push\ios;

use SDK\Umeng\Push\iosNotification;

class IOSUnicast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'unicast';
        $this->data['device_tokens'] = null;
    }
}
