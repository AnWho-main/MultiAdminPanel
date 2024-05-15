<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Log;

class BaseController extends Controller
{


    public function __construct()
    {   
        $this->code                     = 'status_code';
        $this->status                   = 'status';
        $this->result                   = 'result';
        $this->message                  = 'message';
        $this->data                     = 'data';
        $this->total                    = 'total_count';        
        
    }


    /*
        Laravel HTTPS RESPONSE Code

            200 OK: Response::HTTP_OK
            201 Created: Response::HTTP_CREATED
            204 No Content: Response::HTTP_NO_CONTENT
            400 Bad Request: Response::HTTP_BAD_REQUEST
            401 Unauthorized: Response::HTTP_UNAUTHORIZED
            403 Forbidden: Response::HTTP_FORBIDDEN
            404 Not Found: Response::HTTP_NOT_FOUND
            405 Method Not Allowed: Response::HTTP_METHOD_NOT_ALLOWED
            419 Authentication Timeout Response::HTTP_AUTHENTICATION_TIMEOUT
            422 Unprocessable Entity: Response::HTTP_UNPROCESSABLE_ENTITY
            429 Too Many Requests: Response::HTTP_TOO_MANY_REQUESTS
            500 Internal Server Error: Response::HTTP_INTERNAL_SERVER_ERROR
    
    */

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data, $message, $code)
    {
    	$response = [
            $this->status => true,
            $this->code => $code,
            $this->message => $message,                
            $this->data    => $data
        ];
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code)
    {
    	$response = [
            'status' => false,
            'status_code' => $code,
            'message' => $error,
            'data' => []
        ];
        return response()->json($response, $code);
    }

    public function throwValidationException($errorMessages)
    {
        throw new HttpResponseException(response()->json($errorMessages, 200));        
    }

    public function throwExceptionError($errorMessages, $code)
    {
        throw new HttpResponseException(response()->json($errorMessages, $code));        
    }

}