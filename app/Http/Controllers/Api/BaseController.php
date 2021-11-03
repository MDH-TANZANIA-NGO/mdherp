<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    /**
     * success response method
     *
     * @returns Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'code' => 201,
            'message' => $message,
            'result' => $result
        ];

        return response()->json($response, 201);
    }

    /**
     * send error response
     *
     * @returns Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'code' => $code,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['result'] = $errorMessages;
        }

        return response()->json($response, $code);
    }


}
