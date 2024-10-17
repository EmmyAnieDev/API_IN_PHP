<?php

    // file get content function can be used to read the function of a file into a string
    // it can also be used to retrieve the contennt of a website
    $response = file_get_contents("https://randomuser.me/api");

    // Decode the received data into a standard format. Set true to convert it into an associative array.
    $data = json_decode($response, true);

    // var_dump($data); "\n";

    // print only the first name of the returned user using the array key
    echo $data['results'][0]['name']['first'], "\n";

?>