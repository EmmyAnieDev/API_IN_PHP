<?php


/* 
Line 1: This includes the Composer autoload file, which automatically loads the GuzzleHttp classes 
and other dependencies.
*/
require __DIR__ . "/vendor/autoload.php"; 


// Line 2: Creates a new Guzzle HTTP client object that will be used to make the HTTP request.
$client = new GuzzleHttp\Client;


/*
 Line 3: Sends a GET request to GitHub's API to retrieve the user's repositories. 
 The "request" method sends the request and stores the response in the $response variable.
 */
$response = $client->request("GET", "https://api.github.com/user/repos", [

    "headers" => [
        // Line 5: Authorization header with a GitHub personal access token to authenticate the request.
        "Authorization" => "token YOUR_TOKEN", 
        // Line 6: A "User-Agent" header is required by GitHub API to identify the client making the request.
        "User-Agent" => "EmmyAnieDev"
    ]

]);

// Line 10: Outputs the HTTP status code from the response (e.g., 200 for success).
echo $response->getStatusCode(), "\n";


//Line 12: Outputs the 'content-type' of the response header (e.g., application/json), 
//which indicates the format of the response.
echo $response->getHeader("content-type")[0], "\n";

// Line 14: Outputs the first 200 characters of the response body to preview the data retrieved from the API.
echo substr($response->getBody(), 0, 200), "...\n";
