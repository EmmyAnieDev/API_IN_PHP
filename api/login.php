<?php

declare(strict_types = 1); 

require __DIR__ . "/bootstrap.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode("/", $path);

$resource = $parts[3];

// check if the $resource is not equal to 'login'
if ($resource != 'login'){

    http_response_code(404);
    exit;

}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);
    header("Allow: POST");
    exit;
}

$data = (array) json_decode(file_get_contents("php://input"), true);

if ( !array_key_exists('username', $data) || !array_key_exists('password', $data)) {

    http_response_code(400);
    echo json_encode(["message" => "missing login credentials!"]);
    exit;

}

echo json_encode($data);