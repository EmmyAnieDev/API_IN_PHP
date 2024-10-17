<?php

    // file get content function can be used to read the function of a file into a string
    // it can also be used to retrieve the contennt of a website
    $response = file_get_contents("https://randomuser.me/api");

    echo $response;

?>