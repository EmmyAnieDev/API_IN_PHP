<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Initialize a cURL session
$ch = curl_init();


#   --------------------------------------   USE EITHER THE COMMENTED OR THE UNCOMMENTED
// // Set the URL for the cURL request
// curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api"); 

// // Return the transfer as a string instead of outputting it directly
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 


// Set multiple cURL options at once using curl_setopt_array()
curl_setopt_array($ch, [

    // CURLOPT_URL => "https://randomuser.me/api",      // Set the URL for the request

    // Without adding the API KEY, the cURL request will return a 404 error because the request is unauthorized or invalid.
    CURLOPT_URL => "https://api.openweathermap.org/data/2.5/weather?q=lagos&appid=YOUR_API_KEY",
    CURLOPT_RETURNTRANSFER => true                   // Return the response as a string instead of outputting it directly

]);

#------------------------------------  USE EITHER ABOVE


// Execute the cURL request and store the response
$respone = curl_exec($ch); 

// Get the HTTP status code of the response from the cURL request
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);  

// Close the cURL session to free up resources
curl_close($ch); 

echo $status_code . "\n";

print_r($respone . "\n"); 

