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
                echo 'gotten all tasks';
      
            } elseif ($request_method === 'POST') {
                echo "added to tasks";
            }else{
               $this->respondMethodNotAllowed('GET, POST');
            }

        } else {
         
            switch ($request_method) {

                case "GET":
                    echo "got a task";
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
}

