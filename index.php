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

    CURLOPT_URL => "https://randomuser.me/api",      // Set the URL for the request
    CURLOPT_RETURNTRANSFER => true                   // Return the response as a string instead of outputting it directly

]);

#------------------------------------  USE EITHER ABOVE


// Execute the cURL request and store the response
$respone = curl_exec($ch); 

// Close the cURL session to free up resources
curl_close($ch); 


print_r($respone . "\n"); 

