<?php


class UserGateway {

    // PDO object to manage database connection
    private PDO $conn;

    // To access the database, we pass the database object as a dependency to the constructor
    public function __construct(Database $database) {

        $this->conn = $database->getConnection();

    }

    public function getUserByApiKey(string $api_key) : array | false {

        $sql = "SELECT * FROM user WHERE api_key = :api_key";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('api_key', $api_key, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

}