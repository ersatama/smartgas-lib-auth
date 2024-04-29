<?php

namespace Ruslan_sgs\SmartgasLibAuth\Services\Auth;

use Ruslan_sgs\SmartgasLibAuth\Services\Service;

class AuthQueryService extends Service
{
    public function login(array $credentials): ?string
    {
        if ($token = auth()->attempt($credentials)) {
            return $token;
        }
        return null;
    }
}