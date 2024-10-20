<?php

/*
 * The TaskController class handles task-related HTTP requests.
 * It decides what action to take based on the HTTP request method
 * and whether an 'id' is provided.
 */
class TaskController {

    /*
     * Processes the request based on the request method (GET, POST, PATCH, DELETE)
     * and whether an ID is present or not.
     *
     * @param string $request_method - The HTTP method used in the request (GET, POST, PATCH, DELETE)
     * @param mixed $id - The ID of the task (null if the request is for all tasks)
     */
    public function processRequest($request_method, $id) {

        // If no ID is provided, handle collection-related requests
        if ($id === null) {

            // Handle GET request to retrieve all tasks
            if ($request_method === 'GET') {
                echo 'gotten all tasks';

            // Handle POST request to add a new task
            } elseif ($request_method === 'POST') {
                echo "added to tasks";
            }

        } else {
            // If an ID is provided, handle individual task requests based on the request method
            switch ($request_method) {

                case "GET":
                    // Handle GET request to retrieve a specific task
                    echo "got a task";
                    break;

                case "PATCH":
                    // Handle PATCH request to update a specific task
                    echo "updated a task";
                    break;

                case "DELETE":
                    // Handle DELETE request to delete a specific task
                    echo "deleted a task";
                    break;
            }
        }
    }
}

