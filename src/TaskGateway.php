<?php

class TaskGateway {

    // PDO object to manage database connection
    private PDO $conn;

    // Constructor to initialize the database connection
    public function __construct(Database $database){

        $this->conn = $database->getConnection();

    }

    public function getAll() : array {

        $sql = 'SELECT * FROM task ORDER BY name' ;

        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
