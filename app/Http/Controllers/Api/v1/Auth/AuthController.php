<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Contracts\Auth\AuthContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends BaseController
{
    public function __construct(
      public readonly AuthContract $auth,
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            return $this->sendResponse($this->auth->register($request->requestData()), 'Успешно!');
        } catch (\Exception $e) {
            return $this->sendError('[API]: ' .$e->getMessage(), $e->getCode());
        }
    }
}
