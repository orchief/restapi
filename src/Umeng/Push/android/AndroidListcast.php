<?php

namespace SDK\Umeng\Push\android;

use SDK\Umeng\Push\androidNotification;

class AndroidListcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'listcast';
        $this->data['device_tokens'] = null;
    }
}
