<<<<<<< HEAD
<?php
    // Student Number: 5094879
    // Name: David Hlavacek
    // Date: 11 Nov 2020

    require("../res/elements/dbConn.php");

    $method = $_GET['method'];
    
    if($method!=2)
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM Reservations WHERE id=?";
        $stmt = mysqli_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, $id);
        if(!mysqli_stmt_execute($stmt))
        {   
            echo "Error: ".$sql."<br>".mysqli_error($conn);
            mysqli_close($conn);
        }
        mysqli_close($conn);
        header("Location: userInfo.php");
    }
    else
    {
        $sql = "DELETE FROM Reservations";
        $stmt = mysqli_prepare($stmt, $sql);
        if(!mysqli_stmt_execute($stmt))
        {   
            echo "Error: ".$sql."<br>".mysqli_error($conn);
        }
        mysqli_close($conn);
        require("../res/elements//sessionSet.php");
        header("Location: userInfo.php");
    }
?>