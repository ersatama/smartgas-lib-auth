<?php

namespace Ruslan_sgs\SmartgasLibAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth\LoginRequest;
use Ruslan_sgs\SmartgasLibAuth\Http\Resources\User\UserResource;
use Ruslan_sgs\SmartgasLibAuth\Services\{
    AuthCommandService,
    AuthQueryService
};
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{
    public function __construct(
        readonly private AuthQueryService $authQueryService,
        readonly private AuthCommandService $authCommandService
    )
    {
    }

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $credentials = $loginRequest->validated();
        if (!$token = $this->authQueryService->login($credentials)) {
            return response()->json(['message' => __('auth.failed')],
                Response::HTTP_BAD_REQUEST);
        }
        auth()->user()->update([
            'token' => $token
        ]);
        return response()->json([
            'user' => new UserResource(Auth::user()),
        ]);
    }
}