<?php

namespace SDK\Umeng\Push\android;

use SDK\Umeng\Push\androidNotification;

class AndroidBroadcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'broadcast';
    }
}
