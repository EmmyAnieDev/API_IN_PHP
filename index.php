<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Initialize a cURL session
$ch = curl_init();


# Headers represent metadata about the request, such as authentication credentials, 
# information about the client, or the type of content being sent or requested.
$headers = [
    "Authorization: token YOUR_ACCESS_KEY",  // Replace with your actual GitHub token
    "User-Agent: EmmyAnieDev"
];


curl_setopt_array($ch, [

    CURLOPT_URL => "https://api.github.com/user/starred/EmmyAnieDev/PHP_BEGINNER", 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_CUSTOMREQUEST => "PUT" 


]);

$respone = curl_exec($ch); 

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch); 

echo $status_code . "\n";

print_r($respone . "\n"); 

