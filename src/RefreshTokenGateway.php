<?php

class RefreshTokenGateway {

    // PDO object to manage database connection
    private PDO $conn;

    // To access the database, we pass the database object as a dependency to the constructor
    public function __construct(Database $database, private string $key) {

        $this->conn = $database->getConnection();

    }

    public function create(string $token, int $expiry) {

        $hash = hash_hmac("sha256", $token, $this->key);

        $sql = "INSERT INTO refresh_token (token_hash, expires_at) VALUES (:token_hash, :expires_at)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":token_hash", $hash, PDO::PARAM_STR);
        $stmt->bindValue(":expires_at", $expiry, PDO::PARAM_STR);

        return $stmt->execute();

    }

}