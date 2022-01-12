<?php
    // Student Number: 5094879
    // Name: David Hlavacek
    // Date: 11 Nov 2020
    require("../res/elements/session.php");
    require("../res/elements/dbConn.php");
    require("../res/elements/sanitize.php");
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM Reservations WHERE id='".$id."'";
    $data = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($data);

    $fname = clean($row['fname']);
    $lname = clean($row['lname']);
    $email = clean($row['email']);
    $checkIn = clean($row['checkIn']);
    $checkOut = clean($row['checkOut']);
    if(isset($_GET['submit']))
    {
        $fname = clean($_GET['fname']);
        $lname = clean($_GET['lname']);
        $email = clean($_GET['email']);
        $checkIn = clean($_GET['checkIn']);
        $checkOut = clean($_GET['checkOut']);
        
        if(!empty($fname && $lname && $email
                    && $checkIn && $checkOut))
        {

            $sql = "UPDATE Reservations 
                    SET 
                        fname = '".$fname."',
                        lname = '".$lname."',
                        email = '".$email."',
                        checkIn = '".$checkIn."',
                        checkOut = '".$checkOut."'
                    WHERE id='".$id."'
                    ";


            
            if(!mysqli_query($conn, $sql))
            {   
                echo "Error: ".$sql."<br>".mysqli_error($conn);
            }

            mysqli_close($conn);
            header("Location: userInfo.php");

        }
        else
        {
            ?><span><?php echo "ALL FIELDS REQUIRED!!!";?></span><?php
        }
        mysqli_close($conn);
    }
    else
    {
        displayForm($id, $fname, $lname, $email, $checkIn, $checkOut);
        mysqli_close($conn);
    }
function displayForm($id, $fname, $lname, $email, $checkIn, $checkOut)
{ ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Reservation Edit</title>
    </head>
    <body>

        <h1>Edit Reservation</h1>
        <form action="<?php echo clean($_SERVER['PHP_SELF']);?>" method="get">
            <label for="id" hidden><input name="id" value="<?php echo $id ?>" hidden/></label>
            <label for="fname"><input name="fname" type="text" value="<?php echo $fname;?>" required/> First Name <br><br>
            <label for="lname"><input name="lname" type="text" value="<?php echo $lname;?>" required/> Last Name <br><br>
            <label for="email"><input name="email" type="text" value="<?php echo $email;?>" required/> Email <br><br>
            <label for="checkIn"><input name="checkIn" type="text" value="<?php echo $checkIn;?>" required/> Check-In <br><br>
            <label for="checkOut"><input name="checkOut" type="text" value="<?php echo $checkOut;?>" required/> Check-Out <br><br>
            <br><br>
            <i>All fields required!</i><br><br>
            <input name="submit" type="submit" value="Submit"/>

        </form>
        
    </body>
    </html>
<?php 
}
?>