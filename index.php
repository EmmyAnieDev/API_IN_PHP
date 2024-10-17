<?php

// Check if the 'name' parameter is provided in the URL query string
if (!empty($_GET['name'])) {

    // Fetch the response from the Agify API (endpoint) using the provided name
    $response = file_get_contents("https://api.agify.io?name={$_GET['name']}");

    // Decode the received JSON response into an associative array
    $data = json_decode($response, true);

    // Extract the predicted age from the decoded data
    $age = $data['age'];
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Example</title>
    </head>

    <body>

        <?php if (isset($age)) : ?>
            <p>AGE: <?= htmlspecialchars($age) ?></p> 
        <?php endif; ?>

        <form> 
            <label for="name">Name</label>
            <input id="name" type="text" name="name"> 

            <button type="submit">Guess Age</button>
        </form>
        
    </body>
</html>
