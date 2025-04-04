<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * RETURN SUCCESS RESPONSE.
     *
     * @param $result
     * @param string|null $message
     * @return JsonResponse
     */
    public function sendResponse($result, ?string $message): JsonResponse
    {
        $response = [
            'success'   => true,
            'response'  => $result,
            'message'   => $message
        ];

        return response()->json($response, 200, ['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
    }

    /**
     * RETURN ERROR RESPONSE
     *
     * @param string $error
     * @param int|null $code
     * @return JsonResponse
     */
    public function sendError(string $error, ?int $code = null): JsonResponse
    {
        $response = [
            'success'       => false,
            'message'       => $error,
        ];

        return response()->json($response, $code ?? 200, ['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
    }
}
