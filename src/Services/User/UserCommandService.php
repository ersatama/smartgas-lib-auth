<?php

namespace Ruslan_sgs\SmartgasLibAuth\Services\User;

use Ruslan_sgs\SmartgasLibAuth\Models\CrmUser;
use Ruslan_sgs\SmartgasLibAuth\Services\Service;

class UserCommandService extends Service
{
    public function create($data)
    {
        return CrmUser::create($data);
    }
}