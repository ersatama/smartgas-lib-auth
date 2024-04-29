<?php

namespace Ruslan_sgs\SmartgasLibAuth\Helpers;

use Exception;

class SmscHelper extends Helper
{
    public function send($phone, $message): bool
    {
        try {
            file_get_contents(
                config('smartgas.smsc.url') . http_build_query([
                    'login'  => config('smartgas.smsc.login'),
                    'psw'    => config('smartgas.smsc.password'),
                    'phones' => $phone,
                    'mes'    => $message
                ]),
                false,
                stream_context_create([
                    'http' => [
                        'method' => "GET",
                    ]
                ])
            );
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }

    public function phoneCodeVerify($code): string
    {
        return 'Ваш проверочный код для входа: ' . $code;
    }
}