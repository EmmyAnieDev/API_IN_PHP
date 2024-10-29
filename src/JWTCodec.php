<?php

class JWTCodec {

    // Encodes the payload into a JWT string with a header, payload, and signature
    public function encode(array $payload) : string {

        $header = json_encode([ "typ" => "JWT", "alg" => "HS256" ]);
        $header = $this->base64urlEncode($header);
        
        $payload = json_encode($payload);
        $payload = $this->base64urlEncode($payload);

        $signature = hash_hmac("sha256", $header . "." . $payload, "lz7CM2jVTIDkSUNIdwWSfdDs9xJ9gqQhyHaPtH6xoe4=", true);
        $signature = $this->base64urlEncode($signature);

        // returing the JWT
        return "$header.$payload.$signature";


    }

    // Encodes a string in base64 URL format
    public function base64urlEncode(string $text) : string {

        return str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($text));

    }



}