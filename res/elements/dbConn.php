
<?php

    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db = "falcondatabase";

    $conn = mysqli_connect($host, $user, $pass, $db);

    //improve error display
    if(!$conn)
    {
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    }

?>
