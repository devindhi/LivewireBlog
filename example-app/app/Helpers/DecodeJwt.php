<?php

namespace App\Helpers;

use App\Exception\JwtServiceException;
use App\Exceptions\GeneralJsonException;
use Illuminate\Support\Facades\Log;

class DecodeJwt{

    public function decodeJwtToken(string $token): array
    {
        try {
            // Split the JWT token into its parts (header, payload, signature)
            $jwtParts = explode('.', $token);
    
            // Check if all parts are present
            if (count($jwtParts) !== 3) {
                throw new JwtServiceException('Invalid JWT format: Expected three parts.');
            }
    
            // Decode and validate the payload
            $payload = base64_decode($jwtParts[1]);
            if (!$payload) {
                throw new JwtServiceException('Invalid JWT: Unable to decode payload from base64.');
            }
            $decodedPayload = json_decode($payload, true);
            if (!$decodedPayload || !is_array($decodedPayload)) {
                throw new JwtServiceException('Invalid JWT: Unable to decode JSON from payload.');
            }
    
            // Accessing the 'name' and 'id' values from the decoded payload
            $name = $decodedPayload['name'] ?? null;
            $id = $decodedPayload['id'] ?? null;
    
            // Check if the keys exist and not null
            if (isset($name) && isset($id)) {
                return ['name' => $name, 'id' => $id];
            } else {
                Log::info('No name or id found in the JWT payload.');
            }
        } catch (\Throwable $e) {
            Log::info($e);
            throw new GeneralJsonException("Token invalid",401);
        }
    
        return [];
    }

}