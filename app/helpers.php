<?php

if (! function_exists('successResponse')) {
    /**
     * Return a standard success json response
     */
    function successResponse($data = [], int $code = 200) : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $data
        ], $code);
    }
}
