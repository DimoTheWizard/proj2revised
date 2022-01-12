<?php

    session_start();

    $_SESSION['fname'] = "Vio";
    $_SESSION['lname'] = "Fazzi";
    $_SESSION['email'] = "Vio@gmail.com";
    $_SESSION['checkIn'] = "2022-01-01";
    $_SESSION['checkOut'] = "2022-01-10";
    $_SESSION['rank'] = "2";
    $_SESSION['userID'] = "9";

    header("location: ../../reservation_front.php");
?>  