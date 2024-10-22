<?php

class TaskGateway {

    // PDO object to manage database connection
    private PDO $conn;

    // Constructor to initialize the database connection
    public function __construct(Database $database){

        $this->conn = $database->getConnection();

    }
}
