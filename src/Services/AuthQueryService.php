<?php

namespace Smartgas\Auth\Services;

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