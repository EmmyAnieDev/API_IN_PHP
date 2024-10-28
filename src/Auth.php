<?php


class Auth {

    private int $user_id;

    public function __construct(private UserGateway $userGateway){}

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

        // Decode the Base64-encoded token from the Authorization header
        $plain_text = base64_decode($matches[1], true);


        // Validate that the token was successfully decoded
        if ($plain_text === false) {

            http_response_code(400);
            echo json_encode(["message" => "invalid authorization header"]);
            return false;
        }


        // Attempt to parse the decoded token as JSON
        $data = json_decode($plain_text, true);


        // Check if the decoded token is valid JSON
        if($data === null) {

            http_response_code(400);
            echo json_encode(["message" => "invalid JSON"]);
            return false;
        }

        $this->user_id = $data['id'];

        return true;
    }

}

?>