<?php
    $conn = new mysqli('localhost', 'root', 'root', 'gldwebcamp');

    if($conn->connect_error){
        echo $error->$conn->connect_error;
    };

?>