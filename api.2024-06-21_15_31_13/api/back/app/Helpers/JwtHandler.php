<?php

namespace Wrql\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    private $key = "your_secret_key";

    public function generateToken($data)
    {
        $token = JWT::encode($data, $this->key, 'HS256');
        return $token;
    }

    public function verifyToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->key, 'HS256'));
            return [
                "status" => true,
                "data" => $decoded
            ];
        } catch (\Exception $e) {

            http_response_code(400);
            return [
                "status" => false
            ];
        }
    }
}
