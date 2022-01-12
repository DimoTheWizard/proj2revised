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
        <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../res/uI.css">
        <title>User Info</title>
    </head>
    <body>
    
    <h1 style="display:inline;">User Info:</h1><h2 style="display:inline;"> <?php echo($fname." ".$lname)?></h2><br><br>
    <br>
    <table class="uI">
        <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Check-In</th>
            <th scope="col">Check-Out</th>
        </tr>
        </thead>
    </table>
    <hr>
    <br><br><br>
    <center><h2>Current Reservation</h2></center><br>
    <table class="uI">
        <tbody>
        <?php
            $sql = "SELECT * FROM reservations WHERE userID = ? ORDER BY id DESC LIMIT 1";
            
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $userID, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(1)/*if(mysqli_num_rows($result)>0)*/
            {

                //TEST
                echo "<tr><td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td></tr>";

                echo"<td class='rowED'><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                    "<td class='rowED'><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";
                
                    echo "<tr><td scope='row'>test2</td>".
                    "<td scope='row'>test2</td>".
                    "<td scope='row'>test2</td>".
                    "<td scope='row'>test2</td>".
                    "<td scope='row'>test2</td></tr>";
    
                    echo"<td class='rowED'><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                        "<td class='rowED'><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";
                // while($row = mysqli_fetch_assoc($result))
                // {
                    // echo"<tr>".
                    //     "<td scope='row'>".$row['fname']."</td>".
                    //     "<td scope='row'>".$row['lname']."</td>".
                    //     "<td scope='row'>".$row['email']."</td>".
                    //     "<td scope='row'>".$row['checkIn']."</td>".
                    //     "<td scope='row'>".$row['checkOut']."</td>".
                    //     "<td scope='row'><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                    //     "<td scope='row'><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";  
                // }
            }

            
        ?>
        </tbody>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    
    <center><h2>Other Reservations</h2></center><br>
    <table class="uI">
        <tbody>
    
        <?php
            $sql = "SELECT * FROM Reservations WHERE userID = ?";
            $stmt = mysqli_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            /*if(mysqli_num_rows($result)>0)*/if(1)
            {

                //TEST
                echo "<td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td>".
                "<td scope='row'>test</td></tr>";

                echo"<tr><td class='rowED'><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                    "<td class='rowED'><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";
               
                // while($row = mysqli_fetch_assoc($result))
                // {
                    // echo"<tr>".
                    //     "<td scope='row'>".$row['fname']."</td>".
                    //     "<td scope='row'>".$row['lname']."</td>".
                    //     "<td scope='row'>".$row['email']."</td>".
                    //     "<td scope='row'>".$row['checkIn']."</td>".
                    //     "<td scope='row'>".$row['checkOut']."</td>".
                    //     "<td scope='row'><a href=\"userInfoEdit.php?id=".$row['id']."\">Edit</td>".
                    //     "<td scope='row'><a href=userInfoDelete.php?id=".$row['id'].">Delete</td></tr>";
                // }
                // echo"<tfoot><tr><td><a href=userInfoDelete.php?method=2><br><br><br>Delete All</td></tr></tfoot>";
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
        </tbody>
                        
    </table>

    <?php echo "<br><br><br><br><br><center><a href=../reservation_front.php>Back</center>"; ?>
</body>
</html>

