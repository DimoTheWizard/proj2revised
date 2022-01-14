<?php
        session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="res/style.css">
    <title>Falcon Hotel and Resturant</title>
    <meta charset="utf-8">
    <meta lang="en-us">
</head>
<body id ="adminPanel">

<?php
include('res/elements/header.php');
?>

<?php
include('res/elements/footer.php');
?>

<?php
include('functions/functions.php');
?>

    <h1 class = "Tabletitle" > Activity </h1>

    <table border="1" id="AdminPanel">
        <tr>
            <th> id </th>
            <th> Activity Name </th>
            <th> Description  </th>
            <th> Date  </th>
            <th> Time  </th>
            <th> Activity Limit </th>
            <th> Activity Availability </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        <?php
        adminActivity();
        ?>
    </table>

    <h1 class = "Tabletitle" > Reserved Activities </h1>

    <table border="1" id="AdminPanel">
        <tr>
            <th> User ID </th>
            <th> Activity ID </th>
            <th> Check in </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        <?php
            adminReservedActivities();
        ?>
    </table>

    <h1 class = "Tabletitle" > Room </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> ID      </th>
            <th> Room Number</th>
            <th> Room Availability </th>
            <th> Room Type </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        <?php
            adminRoom();
        ?>
    </table>

    <h1 class = "Tabletitle" > Reserved Rooms </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> user ID </th>
            <th> room ID </th>
            <th> check in </th>
            <th> check out </th>
            <th> Edit </th>
            <th> Delete </th>
        </tr>
        <?php
            adminReservedRooms();
        ?>
    </table>

    <h1 class = "Tabletitle" > Tables </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> Table ID   </th>
            <th> Table Number </th>
            <th> Edit </th>
            <th> Delete </th>
        <?php
            adminTables();
        ?>
        </tr>
    </table>

    <h1 class = "Tabletitle" > Reserved Tables </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> user ID   </th>
            <th> Table ID </th>
            <th> check in </th>
            <th> Edit </th>
            <th> Delete </th>
        <?php
            adminReservedTables();
        ?>
        </tr>
    </table>

    <h1 class = "Tabletitle" > User </h1>
    <table border="1" id="AdminPanel">
        <tr>
            <th> ID   </th>
            <th> E-mail </th>
            <th> Username </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Password </th>
            <th> User Level </th>
            <th> Corona Certificate Path </th>
            <th> Edit </th>
            <th> Delete </th>
        <?php
            adminUsers();
        ?>
        </tr>
    </table>


    <<a id="signOut" href="functions/sessionDestroy.php">Sign Out</a>
</body>
</html>
