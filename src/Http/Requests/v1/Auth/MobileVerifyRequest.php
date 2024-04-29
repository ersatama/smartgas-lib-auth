<?php

namespace Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth;

use JetBrains\PhpStorm\ArrayShape;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\Request;

class MobileVerifyRequest extends Request
{
    #[ArrayShape(['phone' => "string", 'code' => "string"])] public function rules(): array
    {
        return [
            'phone' => 'required',
            'code' => 'required',
        ];
    }
}