<?php

namespace SDK\Umeng\Push\android;

use SDK\Umeng\Push\androidNotification;

class AndroidGroupcast extends AndroidNotification
{
    public function __construct()
    {
        parent::__construct();
        $this->data['type'] = 'groupcast';
        $this->data['filter'] = null;
    }
}
