<?php

    include("res/elements/session.php");
    include("res/elements/dbConn.php");
    include("res/elements/sanitize.php");

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {

        $checkIn = clean($_POST['checkIn']);
        $checkOut = clean($_POST['checkOut']);
        //userID should be set in session.
        //$userArray = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM user WHERE fname = '$fname' AND lname = '$lname'"));
        //$userID = $userArray['id'];
        
        $userID = SELECT id FROM user WHERE email = ?

        if($userID) //existing user
        {
        
            if($checkIn && $checkOut)
            {
                //auto-complete from User form/database
                $stmt = mysqli_prepare($conn, "INSERT INTO user(fname, lname, email, checkIn, checkOut)
                VALUES (?, ?, ?, ?, ?)");

                $fname = clean($_POST['fname']);
                $lname = clean($_POST['lname']);
                $email = clean($_POST['email']);
                mysqli_stmt_bind_param($stmt, 'ssssss', $fname, $lname, $email, $checkIn, $checkOut);

                //Retrieved from $_SESSION in session.php
                //$fname = mysql_result(mysql_query("SELECT fname FROM users WHERE userID = $userID"),0);
                //$lname = mysql_result(mysql_query("SELECT lname FROM users WHERE userID = $userID"),0);
                //$email = mysql_result(mysql_query("SELECT email FROM users WHERE userID = $userID"),0);
                //$checkIn & $checkOut exist only in this instance
                
                mysqli_stmt_execute($stmt);

                $stmt = mysqli_prepare($conn, "INSERT INTO reservations(userID)
                VALUES (SELECT id FROM user WHERE email = ?)");
        
                mysqli_stmt_bind_param($stmt, 's', $email);
                
                mysqli_stmt_execute($stmt);
               
                

            }
            else //improve error display 
            {
                echo "All fields required!";
            }
            header("Location: userInfo/userInfo.php");
            
        }
        else //guest
        {
            $fname = clean($_POST['fname']);
            $lname = clean($_POST['lname']);
            $rank = "0";
            $email = clean($_POST['email']);

            if($fname && $lname && $email && $checkIn && $checkOut)
            {
            
                $stmt = mysqli_prepare($conn, "INSERT INTO reservations(fname, lname, email, checkIn, checkOut, rank)
                VALUES ('$fname', '$lname', '$email' , '$checkIn', '$checkOut', '$rank')");

                //improve error display
                if(!mysqli_stmt_execute($stmt))
                {   
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                }
                else
                {
                    echo "Sucess!";
                }
            }
            else //improve error display 
            {
                echo "All fields required!";
            }
        }
    }
    
    include("res/elements/sessionSet.php");
    



?>
