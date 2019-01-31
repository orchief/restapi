<?php

namespace SDK\Umeng\Push\ios;

use SDK\Umeng\Push\iosNotification;

class IOSListcast extends IOSNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'listcast';
        $this->data['device_tokens'] = null;
    }
}
