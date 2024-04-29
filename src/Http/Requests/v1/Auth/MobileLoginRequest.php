<?php

namespace Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth;

use JetBrains\PhpStorm\ArrayShape;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\Request;

class MobileLoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape([
        'phone'  => "string",
        'create' => "string"
    ])] public function rules(): array
    {
        return [
            'phone'  => 'required',
            'create' => 'required|boolean'
        ];
    }
}