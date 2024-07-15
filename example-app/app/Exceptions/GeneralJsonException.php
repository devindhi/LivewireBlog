<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GeneralJsonException extends Exception
{
    public function render($request)
    {
        return new JsonResponse([
                'statusCode'=> $this->code,
                'message' => $this->getMessage(),
            
        ], $this->code);
    }
}
