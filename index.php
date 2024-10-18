<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

// Initialize a cURL session
$ch = curl_init();

$headers = [
    "User-Agent: EmmyAnieDev"
];

curl_setopt_array($ch, [

    CURLOPT_URL => "https://api.github.com/gists/654ef2658142cc48859dad324e827f9e", 
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,

]);

$respone = curl_exec($ch);

curl_close($ch); 

$data = json_decode($respone, true);

/*
foreach ($data as $gist) {

    echo $gist['id'], " - ", $gist['description'], "\n";

}
*/

print_r($data);


