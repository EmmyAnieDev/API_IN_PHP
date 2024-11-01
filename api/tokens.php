<?php

// Create a payload array containing the user's ID and name for the token
$payload = [
    "sub" => $user['id'],
    "name" => $user['name'],
    "exp" => time() + 100
];

$refresh_token_expiry = time() + 432000;   // expiry here is much longer than access token expiry

// We only need these two claims for the refresh token, unlike the access token, which can contain more user data.
$refresh_token_payload = [
    "sub" => $user['id'],
    "exp" => $refresh_token_expiry
];

$access_token = $codec->encode($payload);
$refresh_token = $codec->encode($refresh_token_payload);

echo json_encode(["access token" => $access_token, "refresh token" => $refresh_token]);