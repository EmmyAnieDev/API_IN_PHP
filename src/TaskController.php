<?php

/*
 * The TaskController class handles task-related HTTP requests.
 * It decides what action to take based on the HTTP request method
 * and whether an 'id' is provided.
 */
class TaskController {

    // Initialize the TaskGateway object
    public function __construct(private TaskGateway $taskGateway){
        
    }

    // for now it's void as we're not returning anything. setting the id as nullable
    public function processRequest(string $request_method, ?string $id) : void {


        if ($id === null) {

       
            if ($request_method === 'GET') {

                echo json_encode($this->taskGateway->getAll());
      
            } elseif ($request_method === 'POST') {

                $data = (array) json_decode(file_get_contents("php://input"), true);

                $id = $this->taskGateway->createTask($data);

                $this->respondCreated($id);

            }else{
               $this->respondMethodNotAllowed('GET, POST');
            }

        } else {

            // store what is returned (array or false) in the $task variable
            $task = $this->taskGateway->getById($id);

            if ($task === false) {

                $this->respondNotFound($id);
                return;

            }
         
            switch ($request_method) {

                case "GET":

                    echo json_encode($task);
                    break;

                case "PATCH":
                    echo "updated a task";
                    break;

                case "DELETE":
                    echo "deleted a task";
                    break;

                default:
                    $this->respondMethodNotAllowed('GET, PATCH, DELETE');
                    break;
            }
        }
    }

    private function respondMethodNotAllowed(string $allowed_methods) : void {

        http_response_code(405);
        header("Allow: $allowed_methods");

    }

    private function respondNotFound(string $id) : void {

        http_response_code(404);
        echo json_encode(["message" => "Task with ID $id not found!"]);

    }

    private function respondCreated(string $id) : void {

        http_response_code(201);
        echo json_encode(["message" => "Task created.", "id" => $id]);

    }
}

