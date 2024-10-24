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

    // return an array of data retrieved if successful else false
    public function getById(string $id) : array | false {

        $sql = 'SELECT * FROM task WHERE id = :id' ;

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Convert 'is_completed' to boolean if data is retrieved.
        if ($data !== false) {

            $data['is_completed'] = (bool) $data['is_completed'];

        }

        return $data;

    }

    // taking an array of data as params and returning last id as string
    public function createTask (array $data) : string {
        $sql = "INSERT INTO task (name, priority, is_completed) VALUES (:name, :priority, :is_completed)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":name", $data['name'], PDO::PARAM_STR);

        if (empty($data['priority'])) {

            $stmt->bindValue(":priority", null, PDO::PARAM_NULL);

        }else{

            $stmt->bindValue(":priority", $data['priority'], PDO::PARAM_INT);

        }

        $stmt->bindValue(':is_completed', $data['is_completed'] ?? false, PDO::PARAM_BOOL);

        $stmt->execute();

        return $this->conn->lastInsertId();

    }
}
