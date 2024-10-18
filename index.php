<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Initialize a cURL session
$ch = curl_init();


# Headers represent metadata about the request, such as authentication credentials, 
# information about the client, or the type of content being sent or requested.

// You can add as many headers as needed, depending on the API's requirements.
$headers = [
    "Authorization: Client-ID LjUMV7XWmVafpm_qw1MH-KVeuwkXyzLYY-28ZUVhJgQ"
];


curl_setopt_array($ch, [

    // CURLOPT_URL => "https://api.unsplash.com/photos/random?client_id=LjUMV7XWmVafpm_qw1MH-KVeuwkXyzLYY-28ZUVhJgQ",
    CURLOPT_URL => "https://api.unsplash.com/photos/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers

]);

$respone = curl_exec($ch); 

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

curl_close($ch); 

echo $status_code . "\n";

print_r($respone . "\n"); 

