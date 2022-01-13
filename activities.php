<?php

  include "res/elements/dbConn.php";

  mysqli_select_db($conn, 'falcondb');

  if (isset($_POST['submit'])) {
	  if (count(array_filter($_POST))!=count($_POST)) {
	    echo "One of the inputs is not filled in !";
	  } else {
  $event = $_POST['event'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];


  $query = $conn->prepare("INSERT INTO activity (event, FirstName, LastName, email, phonenumber) VALUES (?, ?, ?, ?, ?)");
  $query->bind_param("ssssi",$event, $FirstName, $LastName, $email, $phonenumber);
  $query->execute();
  mysqli_close($conn);
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="res/style.css">
        <title>Falcon Hotel and Resturant</title>
        <meta charset="utf-8">
        <meta lang="en-us">
    </head>
    <body id = "activities">
        <?php
            include('res/elements/header.php');
        ?>
        <?php
            include('res/elements/footer.php');
        ?>
        <?php
            include('functions/functions.php');
        ?>
        <div class = "Activitiestitle">
            <h1> Reserve a spot in an event </h1>
        </div>

        <div class = "activityImage"> </div>

        <div class = "formbox">
            <div class = "formlabel">
                <h1> Book An Event </h1>
                <form action = "activities.php" method = "post">
                <select name ="eventlist" id ="eventlist">
                  <?php
                    spotEvent();
                  ?>
                </select>
            </div>
            <div> </div>
            <input type ="submit" name="submit" value="Book Now" class="submitlabel">
          </div>
          <div class = "activitytext">
          </div>
    </body>
</html>
