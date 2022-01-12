<?php
    require("../res/elements/session.php");
    require("../res/elements/dbConn.php");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css">
        <title>User Info</title>
        <style>
            .columns
            {
                display: grid;
                grid-auto-flow: column;
                grid-column-gap: 200px;   
                grid-auto-columns="max-content";    
                margin-right: 20px;      
            }
        </style>
    </head>
    <body>
    
    <h1 style="display:inline;">User Info:</h1><h2 style="display:inline;"> <?php echo($fname." ".$lname)?></h2><br><br>
    <br>
    <table>
        <tr class="columns">
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Check-In</th>
            <th>Check-Out</th>
        </tr>
    </table>
    <hr>
    <br><br><br>
    <center><h2>Current Reservation</h2></center><br>
    <table style="width:95%">
        <?php
            $sql = "SELECT * FROM reservations WHERE userID = ? ORDER BY id DESC LIMIT 1";
            
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $userID, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    echo"<tr><td>".$row['fname']."</td>".
                        "<td>".$row['lname']."</td>".
                        "<td>".$row['email']."</td>".
                        "<td>".$row['checkIn']."</td>".
                        "<td>".$row['checkOut']."</td>".
                        "<td><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                        "<td><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";  
                }
            }

            
        ?>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    
    <center><h2>Other Reservations</h2></center><br>
    <table style="width:95%">
        <?php
            $sql = "SELECT * FROM Reservations WHERE userID = ?";
            $stmt = mysqli_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    echo"<tr><td>".$row['fname']."</td>".
                        "<td>".$row['lname']."</td>".
                        "<td>".$row['email']."</td>".
                        "<td>".$row['checkIn']."</td>".
                        "<td>".$row['checkOut']."</td>".
                        "<td><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                        "<td><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";  
                }
                echo"<tr><td><a href=userInfoDelete.php?method=2><br><br><br>Delete All</td></tr>";
            }
            //SEARCH FEATURE NOT FINISHED
            // if(isset($_GET['submit']))
            // {
            //     $search = "%".$_GET['search']."%";

            //     if(!empty($search))
            //     {

            //         $query = "SELECT * FROM BugReporter WHERE productName LIKE ?";
                    
            //         if($stmt = mysqli_prepare($conn, $query))
            //         {
            //             mysqli_stmt_bind_param($stmt, "s", $search);
            //             mysqli_stmt_bind_result($id, $product, $version,
            //                                     $hardwareType, $os, $frequency,
            //                                     $solution) or die("Error: ". $query."<br>".mysqli_error($conn));
            //             mysqli_stmt_execute($stmt) or die("Error: ". $query."<br>".mysqli_error($conn));
            //             if(mysqli_stmt_num_rows($stmt)>0)
            //             {
            //                 while($row = mysqli_fetch($stmt))
            //                 {
            //                     echo"<tr><td>".$row['productName']."</td>".
            //                     "<td>".$row['version']."</td>".
            //                     "<td>".$row['hardwareType']."</td>".
            //                     "<td>".$row['os']."</td>".
            //                     "<td>".$row['frequency']."</td>".
            //                     "<td>".$row['solution']."</td>".
            //                     "<td><a href=\"Edit.php?id=".$row['id']."\">Edit</td>".
            //                     "<td><a href=Deletebug.php?id=".$row['id'].">Delete</td></tr>"; 
            //                 }
            //             }
            //             mysqli_stmt_close($query);
                        
            //         }
            //         else
            //         {
            //             echo "Error: ".$query."<br>". mysqli_error($conn);
            //         }
                    
                    
            //     }
            // }

        ?> 
        
                        
    </table>

    <?php echo "<br><br><br><br><br><center><a href=../reservation_front.php>Back</center>"; ?>
</body>
</html>

