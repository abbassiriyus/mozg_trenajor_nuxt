<?php

namespace Wrql\Helpers;

/**
 * Messages
 */
class Messages {
    
    /**
     * code
     *
     * @param  mixed $message
     * @param  mixed $code
     * @return json
     */
    public static function code($message, $code, $json = true) 
    {
        http_response_code($code);
        
        if($json) header("Content-Type: application/json");

        echo json_encode([
            "message" => $message,
            "code" => $code
        ]);
    }
    
}
