<?php

namespace Ruslan_sgs\SmartgasLibAuth\Services\User;

use Ruslan_sgs\SmartgasLibAuth\Models\CrmUser;
use Ruslan_sgs\SmartgasLibAuth\Services\Service;

class UserQueryService extends Service
{
    public function firstByPhone($phone)
    {
        return CrmUser::where('phone', $phone)->first();
    }
}