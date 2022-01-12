<?php

//Connection to database

$con = mysqli_connect('localhost', 'root', '','falcondatabase')
or die("Connection to the db failed" . mysqli_error($con));
?>