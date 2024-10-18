<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Initialize a cURL session
$ch = curl_init();


# Headers represent metadata about the request, such as authentication credentials, 
# information about the client, or the type of content being sent or requested.

// You can add as many headers as needed, depending on the API's requirements.
$headers = [
    "Authorization: Client-ID YOUR_ACCESS_KEY"
];


curl_setopt_array($ch, [

    // CURLOPT_URL => "https://api.unsplash.com/photos/random?client_id=YOUR_ACCESS_KEY",
    CURLOPT_URL => "https://api.unsplash.com/photos/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_HEADER => true // to view all the response headers we set this to true

]);

$respone = curl_exec($ch); 

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

$content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE); 

$content_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD); 

curl_close($ch); 

echo $status_code . "\n";
echo $content_type . "\n";
echo $content_length . "\n";

print_r($respone . "\n"); 

