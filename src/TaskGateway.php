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

    public function updateTask(string $id, array $data) : int {

        $fields = [];

        if ( !empty($data['name'])) {

            $fields['name'] = [$data['name'], PDO::PARAM_STR];

        }

        if ( array_key_exists('priority', $data)) {

            $fields['priority'] = [$data['priority'], $data['priority'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT];

        }

        if ( array_key_exists('is_completed', $data)) {

            $fields['is_completed'] = [$data['is_completed'], PDO::PARAM_BOOL];

        }

        if ( empty($fields)) {

            return 0;

        }else{

            // Maps field names to SQL placeholders for prepared statements (e.g., "name = :name")
            $sets = array_map(function($value) {
    
                return "$value = :$value";
    
            }, array_keys($fields));
    
           $sql = "UPDATE task" . " SET " . implode(", ", $sets) . " WHERE id = :id";
    
           $stmt = $this->conn->prepare($sql);

           $stmt->bindValue(":id", $id, PDO::PARAM_INT);

           // Binds each field to its corresponding value and data type in the prepared statement
           foreach ($fields as $key => $values) {

                $stmt->bindValue(":$key", $values[0], $values[1]);

           }

           $stmt->execute();

           return $stmt->rowCount();
        }

    }

    public function deleteTask(string $id): int {

        $sql = "DELETE FROM task WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}
