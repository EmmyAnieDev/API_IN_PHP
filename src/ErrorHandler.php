<?php

class ErrorHandler {

    public static function handleExecption(Throwable $execption) : void {

        echo json_encode([

            http_response_code(500),
            "code" => $execption->getCode(),
            "message" => $execption->getMessage(),
            "file" => $execption->getFile(),
            "line" => $execption->getLine(),

        ]);

    }

}