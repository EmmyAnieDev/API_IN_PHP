<?php

$api_key = "YOUR_ACCESS_KEY";

# Create a new customer.
$data = [
    "name" => "Ana",
    "email" => 'ana@example.com'
];


/*

# Using cURL HTTP to access the API directly.

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => 'https://api.stripe.com/v1/customers',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => $api_key,
    CURLOPT_POSTFIELDS => http_build_query($data) // CURLOPT_POSTFIELDS automatically set the REQUEST METHOD to POST
]);

$response = curl_exec($ch);

curl_close($ch);

echo $response;

*/


# Using the SDK: first install ==> composer require stripe/stripe-php


// this autoload the classes in the SDK directly
require __DIR__ . "/vendor/autoload.php";  

// create a StripeCliet object passing in the API as the argument.
$stripe = new \Stripe\StripeClient($api_key); 

// create a new customer using the "customer" property of our object
// then call the create() passing in an array of data.
$customer = $stripe->customers->create($data);  

echo $customer;
