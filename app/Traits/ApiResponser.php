<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     * Build a success response.
     *
     * @param  mixed  $data
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function successResponse($data, $statusCode = 200): JsonResponse
    {
        return response()->json(['data' => $data], $statusCode);
    }

    /**
     * Build an error response.
     *
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function errorResponse($message, $statusCode): JsonResponse
    {
        return response()->json(['error' => $message], $statusCode);
    }
    
     protected function respondValidationErrors($message = "Fai", $data, $status_code = 400)
    {
        return response()->json([
            'isSuccess' => false,
            'message' => $message,
            'errors' => $data,
            'status_code' => $status_code,
        ], $status_code);
    }
}