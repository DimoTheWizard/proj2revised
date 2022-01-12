<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="res/style.css">
    <title>Falcon Hotel and Resturant</title>
    <meta charset="utf-8">
    <meta lang="en-us">
</head>
<body id = "admin">

<?php
include('res/elements/header.php');
?>

<?php
include('res/elements/footer.php');
?>

<form method = "post">
    <h1 class = "Tabletitle" > Activity </h1>

    <table border="1" id="AdminPanel">
        <tr>
            <th> id </th>
            <th> event </th>
            <th> FirstName </th>
            <th> LastName </th>
            <th> email </th>
            <th> phonenumber </th>
        </tr>
    </table>

    <h1 class = "Tabletitle" > Reservations </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> userID </th>
            <th> guestid </th>
            <th> activityid </th>
            <th> tableid </th>
            <th> roomid </th>
            <th> email </th>
        </tr>
    </table>

    <h1 class = "Tabletitle" > Room </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> id      </th>
            <th> roomName</th>
            <th> roomQuantity </th>
            <th> usernameRes </th>
            <th> emailRes </th>
        </tr>
    </table>

    <h1 class = "Tabletitle" > Tables </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> id   </th>
            <th> Date </th>
            <th> FirstName </th>
            <th> LastName </th>
            <th> tablenumber </th>
        </tr>
    </table>

    <h1 class = "Tabletitle" > User </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> id   </th>
            <th> fname </th>
            <th> lname </th>
            <th> email </th>
            <th> checkin </th>
            <th> checkOut </th>
            <th> password </th>
            <th> loginid  </th>
            <th> userlevel </th>
        </tr>
    </table>



    <input type = "submit" name = "submit" value = "Sign Out" class = "signout">
</form>
</body>
</html>