<?php

require __DIR__ . "/vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
    $dotenv->load();

    $database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

    $conn = $database->getConnection();

    $sql = "INSERT INTO user (name, username, password_hash, api_key)
    VALUES (:name, :username, :password_hash, :api_key)";

    $stmt = $conn->prepare($sql);

    $password_harsh = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
    $api_key = bin2hex(random_bytes(16));

    $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
    $stmt->bindValue(':password_hash', $password_harsh, PDO::PARAM_STR);
    $stmt->bindValue(':api_key', $api_key, PDO::PARAM_STR);

    $stmt->execute();

    echo "Thank you for registering. Your api key is $api_key";
    exit;

}


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
  <style>
        main {
            max-width: 600px;
            margin: auto;
            padding: 1rem; /* Add padding on left and right */
        }
    </style>
</head>
<body>
    <main class="register-container">
        <h2>Register</h2>
        <form method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
