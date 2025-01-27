<?php

namespace Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth;

use JetBrains\PhpStorm\ArrayShape;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape([
        'username' => "string",
        'password' => "string"
    ])] public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }
}