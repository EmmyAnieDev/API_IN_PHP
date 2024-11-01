<?php

class RefreshTokenGateway {

    // PDO object to manage database connection
    private PDO $conn;

    // To access the database, we pass the database object as a dependency to the constructor
    public function __construct(Database $database, private string $key) {

        $this->conn = $database->getConnection();

    }

    public function create(string $token, int $expiry) {

        // hash the refresh token with your secret key before storing to database
        $hash = hash_hmac("sha256", $token, $this->key);

        $sql = "INSERT INTO refresh_token (token_hash, expires_at) VALUES (:token_hash, :expires_at)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":token_hash", $hash, PDO::PARAM_STR);
        $stmt->bindValue(":expires_at", $expiry, PDO::PARAM_STR);

        return $stmt->execute();

    }

    public function delete(string $token) : int {

        // Hash the provided refresh token with the secret key to generate the hash
        // that will be used to find and delete the matching token in the database
        $hash = hash_hmac("sha256", $token, $this->key);
    
        $sql = "DELETE FROM refresh_token WHERE token_hash = :token_hash";
    
        $stmt = $this->conn->prepare($sql);
    
        $stmt->bindValue("token_hash", $hash, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->rowCount();
    }

    public function getByToken(string $token) : array | false {

        // Hash the provided refresh token with the secret key to generate the hash
        // that will be used to find and get the matching token details in the database
        $hash = hash_hmac("sha256", $token, $this->key);

        $sql =  "SELECT * FROM refresh_token WHERE token_hash= :token_hash";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":token_hash", $hash, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteExpiredToken() : int {

        $sql = "DELETE FROM refresh_token WHERE expires_at < UNIX_TIMESTAMP()";

        $stmt = $this->conn->query($sql);

        return $stmt->rowCount();

    }
    
}