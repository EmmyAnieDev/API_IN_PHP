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

$response_headers = [];  // Initialize an empty array to store response headers.

// Define a callback function to process headers received in the response.
$header_callback = function($ch, $header) use (&$response_headers) {

    $len = strlen($header);  // Get the length of the current header line.

    $parts = explode(':', $header, 2);  // Split the header into two parts: the header name and its value.

    if (count($parts) < 2) {  // If the header doesn't contain a colon (i.e., it's not a valid header), skip it.
        return $len;  // Return the length of the header (required for the cURL callback to continue).
    }

    $response_headers[$parts[0]] = trim($parts[1]);  // Store the header name (key) and its value (after trimming spaces) in the $response_headers array.

    return $len;  // Return the length of the processed header line to let cURL know to continue processing headers.
};



curl_setopt_array($ch, [

    // CURLOPT_URL => "https://api.unsplash.com/photos/random?client_id=YOUR_ACCESS_KEY",
    CURLOPT_URL => "https://api.unsplash.com/photos/random",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_HEADERFUNCTION => $header_callback


]);

$respone = curl_exec($ch); 

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch); 

echo $status_code . "\n";

print_r($response_headers);

print_r($respone . "\n"); 

