<?php
        session_start();
?>
<?php

    include('functions/functions.php');

    $tableName = $_GET['funcRequired'];
    $id = $_GET['id'];

    global $con;

    switch($tableName){
        case "adminActivity":
            $query = $con->prepare("DELETE FROM activities WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminReservedActivities":
            $query = $con->prepare("DELETE FROM reservedactivities WHERE rsrvActivitiesId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminRoom":
            $query = $con->prepare("DELETE FROM rooms WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminReservedRooms":
            $query = $con->prepare("DELETE FROM reservedrooms WHERE rsrvRoomsId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminTables":
            $query = $con->prepare("DELETE FROM tables WHERE tableNr = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminReservedTables":
            $query = $con->prepare("DELETE FROM reservedtable WHERE rsrvTableId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        case "adminUsers":
            $query = $con->prepare("DELETE FROM users WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param('i', $id);

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }
            header( 'Location: ./adminPanel.php' );
            break;
        default:
            echo "error open page through admin panel<br>";
            break;
    }

?>
<html>
    <body>
        <a href="adminPanel.php">back to Admin Panel</a>
    </body>
</html>