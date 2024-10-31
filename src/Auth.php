<?php


class Auth {

    private int $user_id;

    public function __construct(private UserGateway $userGateway, private JWTCodec $codec){}

    public function authenticateApiKey() : bool {

        if (empty($_SERVER["HTTP_X_API_KEY"])) {
        
            http_response_code(400);
            echo json_encode(["message" => "missing API key"]);
            return false;
        
        }
        
        $api_key = $_SERVER["HTTP_X_API_KEY"];    //  http http://localhost/php_api/api/tasks X-API-Key:haisdjocjkalsc

        $user = $this->userGateway->getUserByApiKey($api_key);

        if ($user === false) {

            http_response_code(401);
            echo json_encode(["message" => "invalid API key!"]);
            return false;
        
        }

        $this->user_id = $user['id'];

        return true;

    }


    public function getUserId(){

        return $this->user_id;
        
    }


    // Validates the access token in the Authorization header.
    public function authenticationAccessToken() : bool {

        // Check if the Authorization header contains a properly formatted "Bearer" token
        if ( !preg_match("/^Bearer\s+(.*)$/", $_SERVER['HTTP_AUTHORIZATION'], $matches)) {

            http_response_code(400);
            echo json_encode(["message" => "incomplete authorization header"]);
            return false;
        }

        try {

            $payload = $this->codec->decode($matches[1]);

        }catch (InvalidSignatureException) {

            http_response_code(401);
            echo json_encode(["message" => "invalid signature!"]);
            return false;

        }catch (TokenExpiredException) {

            http_response_code(401);
            echo json_encode(["message" => "token has expired!"]);
            return false;

        }catch (Exception $e) {

            http_response_code(400);
            echo json_encode(["message" => $e->getMessage()]);
            return false;

        }

        $this->user_id = $payload['sub'];

        return true;
    }

}

?>