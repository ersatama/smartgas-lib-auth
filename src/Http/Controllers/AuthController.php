<?php

namespace Ruslan_sgs\SmartgasLibAuth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Ruslan_sgs\SmartgasLibAuth\Helpers\SmscHelper;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth\LoginRequest;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth\MobileLoginRequest;
use Ruslan_sgs\SmartgasLibAuth\Http\Requests\v1\Auth\MobileVerifyRequest;
use Ruslan_sgs\SmartgasLibAuth\Http\Resources\User\UserResource;
use Ruslan_sgs\SmartgasLibAuth\Services\Auth\{
    AuthCommandService,
    AuthQueryService
};
use Ruslan_sgs\SmartgasLibAuth\Services\User\{
    UserCommandService,
    UserQueryService,
};
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{
    public function __construct(
        readonly private AuthQueryService $authQueryService,
        readonly private AuthCommandService $authCommandService,
        readonly private UserQueryService $userQueryService,
        readonly private UserCommandService $userCommandService,
        readonly private SmscHelper $smscHelper
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $credentials = $loginRequest->check();
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

    /**
     * @throws ValidationException
     */
    public function loginMobile(MobileLoginRequest $mobileLoginRequest
    ): JsonResponse {
        $data = $mobileLoginRequest->check();
        $user = $this->userQueryService->firstByPhone($data['phone']);
        if (!$user) {
            if ($data['create']) {
                $user = $this->userCommandService->create([
                    'phone' => $data['phone']
                ]);
            } else {
                return response()->json([
                    'message' => 'User not found'
                ], Response::HTTP_NOT_FOUND);
            }
        }
        $code = rand(100000, 999999);
        $user = $this->userCommandService->update($user, [
            'otp' => $code
        ]);
        $this->smscHelper->send($user->phone, $code);
        return response()->json([
            'message' => 'sms sent',
            'phone'   => $user->phone
        ], Response::HTTP_OK);
    }

    /**
     * @throws ValidationException
     */
    public function verifyMobile(MobileVerifyRequest $mobileVerifyRequest
    ): JsonResponse {
        $data = $mobileVerifyRequest->check();
        $user = $this->userQueryService->firstByPhone($data['phone']);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        } elseif ($user->phone !== intval($data['code'])) {
            return response()->json([
                'message' => 'Incorrect code number'
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'message' => 'Success',
            'data'    => new UserResource($user)
        ], Response::HTTP_OK);
    }
}