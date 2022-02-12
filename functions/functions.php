<?php

//Main functionalities of the pages

//Inclusion of connection to the database page

require 'dbCon.php';

//Registration function for register.php

function register()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {

            $username = trim(htmlspecialchars($_POST['username'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $email = trim(htmlspecialchars($_POST['email']));
            $fName = trim(htmlspecialchars($_POST['fName']));
            $lName = trim(htmlspecialchars($_POST['lName']));
            $password = trim(htmlspecialchars($_POST['password']));


            $username = trim(mysqli_real_escape_string($con, $_POST['username']));
            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $fName = trim(mysqli_real_escape_string($con, $_POST['fName']));
            $lName = trim(mysqli_real_escape_string($con, $_POST['lName']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            $usrLevel = trim(mysqli_real_escape_string($con, 'guest'));
            $usrLevel = trim(htmlspecialchars('guest'));

            if (!empty($username) && !empty($email) && !empty($fName) && !empty($lName) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $hashPass = password_hash($password,
                        PASSWORD_ARGON2ID,
                        ['memory_cost' => 2048,
                            'time_cost' => 4,
                            'threads' => 3]);

                    //$salt = 'somereallycoolsalttonotbrakpassw';

                    //$hashSalt = $hashPass . $salt;

                    $query = $con->prepare("INSERT INTO users (email,username,fName,lName,password,usrLevel) VALUES (?,?,?,?,?,?)");

                    if (false === $query) {
                        die('Prepare failed' . htmlspecialchars($query->error));
                    }

                    $query->bind_param("ssssss", $email, $username, $fName, $lName, $hashPass, $usrLevel);

                    if (false === $query) {
                        die('Bind param failed' . htmlspecialchars($query->error));
                    }

                    $query->execute();

                    if (false === $query) {
                        die('Execute failed' . htmlspecialchars($query->error));
                    }

                    echo '<h2 style="color:green">Registration made</h2>';

                    $query->close();
                    $con->close();


                } else {
                    echo '<h2 style="color:red">Email not valid</h2>';
                }

            } else {
                echo '<h2 style="color:red">Make sure both fields are completed</h2>';
            }

        } else {
            die("Form couldn't be sent");
        }
    }
}


//Sign in function for signin.php

function signIn()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {

            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            if (!empty($email) && !empty($password)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $query = $con->prepare("SELECT * FROM users WHERE email = ?");

                    //$result = mysqli_query($con, $query);

                    if (false === $query) {
                        die('Prepare failed' . htmlspecialchars($query->error));
                    }

                    $query->bind_param("s", $email);

                    if (false === $query) {
                        die('Binding failed' . htmlspecialchars($query->error));
                    }

                    $query->execute();

                    if (false === $query) {
                        die('Execution failed' . htmlspecialchars($query->error));
                    }

                    $result = $query->get_result();

                    $data = $result->fetch_all(MYSQLI_ASSOC);

                    //echo 'Querry executed';

                    $query->close();
                    $con->close();

                    if ($data) {
                        foreach ($data as $row) {
                            if (password_verify($password, $row['password'])) {
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['fName'] = $row['fName'];
                                $_SESSION['lName'] = $row['lName'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['usrLevel'] = $row['usrLevel'];
                                $_SESSION['pathCert'] = $row['pathCert'];
                                $_SESSION['isLogged'] = "logged";

                                if ($row['usrLevel'] === 'guest' || $row['usrLevel'] === 'vip') {
                                    header("Location: userPanel.php");
                                    //echo 'guest or vip';
                                    die();
                                }

                                if ($row['usrLevel'] === 'admin') {
                                    header("Location: adminPanel.php");
                                    //echo 'admin';
                                    die();
                                }

                            } else {
                                echo '<h2 style="color:red">Incorrect password</h2>';
                            }
                        }
                    }
                } else {
                    echo '<h2 style="color:red">Not a valid e-mail</h2>';
                }
            } else {
                echo '<h2 style="color:red">Make sure to complete both fields</h2>';
            }
        }
    }
}


//reserveRoom function for reserve_rooms.php page

function reserveRoom() /* OutDated*/
{
    global $con;

    $query = $con->prepare("SELECT * FROM room");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['roomName'])) {
            $roomName = $_GET['roomName'];

            $usernameSes = 'Client';
            $emailSes = 'client@mail.com';

            $query = $con->prepare("UPDATE room SET roomQuantity = roomQuantity - 1, usernameRes = '$usernameSes', emailRes = '$emailSes' WHERE roomName = ? ");

            if (false === $query) {
                echo mysqli_error($con);
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("s", $roomName);

            if (false === $query) {
                die('Bind param failed' . htmlspecialchars($query->error));
            }

            $query->execute();

            if (false === $query) {
                die('Execute failed' . htmlspecialchars($query->error));
            }

            $_SESSION['success_reservation'] = 1;

            header('Location: reserve_rooms.php');

            $query->close();
        }
    }

    foreach ($data as $row) {
        $unavailableMsg = 'Unavailable';
        $reserveBad = 'Unavailable';
        $reserveGood = '<a href="?roomName=' . $row['roomName'] . '">Reserve</a>';

        echo "<tr>";
        echo "<td>" . $row['roomName'] . "</td>";
        echo "<td>" . ($row['roomQuantity'] <= 0 ? $unavailableMsg : $row['roomQuantity']) . "</td>";
        echo "<td>" . ($row['roomQuantity'] <= 0 ? $reserveBad : $reserveGood) . "</td>";
        echo "</tr>";
    }
}

//reservation success or fail for reserve_rooms.php

function reserveRoomSuccess() /*not in use*/
{
    if (isset($_SESSION['success_reservation'])) {
        if ($_SESSION['success_reservation'] == 1) {
            echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation made</h2>';
        } else {
            echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation failed</h2>';
        }
    }
}

//reservation page function for reservation_fron

function reservePage()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {

            $email = trim(htmlspecialchars($_POST['email'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $username = trim(htmlspecialchars($_POST['username']));
            $roomName = trim(htmlspecialchars($_POST['roomName']));
            $checkIn = trim(htmlspecialchars($_POST['checkIn']));
            $checkOut = trim(htmlspecialchars($_POST['checkOut']));

            $email = trim(mysqli_real_escape_string($con, $_POST['email'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $username = trim(mysqli_real_escape_string($con, $_POST['username']));
            $roomName = trim(mysqli_real_escape_string($con, $_POST['roomName']));
            $checkIn = trim(mysqli_real_escape_string($con, $_POST['checkIn']));
            $checkOut = trim(mysqli_real_escape_string($con, $_POST['checkOut']));

            if (!empty($email) && !empty($username) && !empty($roomName) && !empty($availability) && !empty($quantity)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $query = $con->prepare("INSERT INTO reservationroom (roomName,roomQuantity,usernameRes,emailRes,availability) VALUES (?,?,?,?,?)");

                    if (false === $query) {
                        echo mysqli_error($con);
                        die('Prepare failed' . htmlspecialchars($query->error));
                    }

                    $query->bind_param("sssss", $roomName, $quantity, $username, $email, $availability);

                    if (false === $query) {
                        die('Bind param failed' . htmlspecialchars($query->error));
                    }

                    $query->execute();

                    if (false === $query) {
                        die('Execute failed' . htmlspecialchars($query->error));
                    }

                    echo '<h2 style="color:green">reservation has been added</h2>';

                    $query->close();
                    $con->close();

                } else {
                    echo '<h2 style="colorred:">Email not valid</h2>';
                }

//User panel

            } else {
                echo '<h2 style="color:red">Make sure you complete all fields</h2>';
            }

        } else {
            die("Form couldn't be sent");
        }
    }
}


function covCert() {

    global $con;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($_FILES["certFile"]["size"] <= 3145728) {
            if ((strlen($_FILES["certFile"]["name"]) <= 50)) {
                $targetfolder = "covCerts/";
                $targetfolder = $targetfolder . basename($_FILES['certFile']['name']);
                $file_type = $_FILES['certFile']['type'];
                if ($file_type == "application/pdf") {
                    $email = $_SESSION['email'];
                    if (move_uploaded_file($_FILES['certFile']['tmp_name'], $targetfolder)) {
                        $query = $con->prepare("UPDATE users SET pathCert = ? WHERE email=?");
                        $pathCert = 'covCerts/'. $_FILES["certFile"]["name"];

                        if (false === $query) {
                            die('Prepare failed' . mysqli_error($con));
                        }

                        $query->bind_param("ss", $pathCert, $email);

                        if (false === $query) {
                            die('Bind param failed' . mysqli_error($con));
                        }

                        $query->execute();

                        if (false === $query) {
                            die('Execute failed' . mysqli_error($con));
                        }

                        $query->close();
                        $con->close();
                        echo '<br>';
                        echo '<h2 style="color:green">The covid certification ' . basename($_FILES["certFile"]["name"]) . ' has been uploaded</h2>';
                    } else {
                        echo "ERROR uploading file";
                    }
                } else {
                    echo '<h2 style="color:red">You may only upload PDF files.<br></h2>';
                }
            } else {
                echo '<h2 style="color:red">File exceeds 50 characters</h2>';
            }
        } else {
            echo '<h2 style="color:red">File is larger than 3 MB</h2>';
        }
    }
}



//event calendar list for events for event_calendar.php

function calendar()
{
    global $con;

    $query = $con->prepare("SELECT activityName, `description`, `date`, `time`  FROM activities");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    /* we turn the rows into associative array*/

    //echo 'Querry executed<br>';

    $query->close();

    foreach ($data as $row) /*Loop used to add to the table*/ {
        echo '<tr>';
        echo '<td>' . $row['activityName'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '</tr>';
    }
}

//adminside tables for admin panel

function adminActivity()
{
    global $con;

    $query = $con->prepare("SELECT * FROM activities");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    $funcRequired = "adminActivity";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['activityName'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '<td>' . $row['activityLimit'] . '</td>';
        echo '<td>' . $row['activityAvailability'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminReservedActivities()
{
    global $con;

    $query = $con->prepare("SELECT * FROM reservedactivities");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();
    $funcRequired = "adminReservedActivities";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['activityId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['rsrvActivitiesId'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['rsrvActivitiesId'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminRoom()
{
    global $con;

    $query = $con->prepare("SELECT * FROM rooms");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    $funcRequired = "adminRoom";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['roomNr'] . '</td>';
        echo '<td>' . $row['roomAvailability'] . '</td>';
        echo '<td>' . $row['roomType'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminReservedRooms()
{
    global $con;

    $query = $con->prepare("SELECT * FROM reservedrooms");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    $funcRequired = "adminReservedRooms";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['roomId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo '<td>' . $row['checkOut'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['rsrvRoomsId'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['rsrvRoomsId'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminTables()
{
    global $con;

    $query = $con->prepare("SELECT * FROM tables");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    $funcRequired = "adminTables";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['tableNr'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminReservedTables()
{
    global $con;

    $query = $con->prepare("SELECT * FROM reservedTables");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    $funcRequired = "adminReservedTables";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['tableId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['rsrvTableId'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="adminPanelDelete.php?id=' . $row['rsrvTableId'] . '&funcRequired=' . $funcRequired . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

function adminUsers()
{
    global $con;

    $query = $con->prepare("SELECT * FROM users");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();


    $funcRequired = "adminUsers";
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['fName'] . '</td>';
        echo '<td>' . $row['lName'] . '</td>';
        echo '<td>' . $row['usrLevel'] . '</td>';
        echo '<td>' . $row['pathCert'] . '</td>';
        echo "<td>" . '<a href="./adminPanelEdit.php?id=' . $row['id'] . '&funcRequired=' . $funcRequired . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="./adminPanelDelete.php?id=' . $row['id'] . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

//adminPanel Edit functions

//function chooser allows the below functions to choose the appropriate set of variables for the database
function chooseEditFunction($tableName, $idNum)
{
    switch ($tableName) {
        case "adminActivity":
            AdminPanelEditActivity($idNum);
            break;
        case "adminReservedActivities":
            AdminPanelEditReservedActivities($idNum);
            break;
        case "adminRoom":
            AdminPanelEditRoom($idNum);
            break;
        case "adminReservedRooms":
            AdminPanelEditReservedRooms($idNum);
            break;
        case "adminTables":
            AdminPanelEditTables($idNum);
            break;
        case "adminReservedTables":
            AdminPanelEditReservedTables($idNum);
            break;
        case "adminUsers":
            AdminPanelEditUsers($idNum);
            break;
        default:
            echo "error open page through admin panel<br>";
            break;
    }
}

function AdminPanelEditActivity($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT activityName, activityLimit, activityAvailability FROM activities WHERE id= ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Activities</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"activityName\">Activity Name</label><br>";
        echo "<input type=\"text\" id=\"activityName\" name=\"activityName\" value=\"" . $row['activityName'] . "\"><br>";
        echo "<label for=\"activityLimit\">Activity Limit</label><br>";
        echo "<input type=\"text\" id=\"activityLimit\" name=\"activityLimit\" value=\"" . $row['activityLimit'] . "\"><br>";
        echo "<label for=\"activityAvailability\">Activity Availability</label><br>";
        echo "<input type=\"text\" id=\"activityAvailability\" name=\"activityAvailability\" value=\"" . $row['activityAvailability'] . " \"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('activityName', 'activityLimit', 'activityAvailability');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo $input . " was not filled in<br>";
                echo "all fields are required...<br>";
                break;
            } else {
                $allInputsFilled = true;
            }
            echo $input . " was filled in <br>";
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $activityName = trim(htmlspecialchars($_POST['activityName']));
            $activityLimit = trim(htmlspecialchars($_POST['activityLimit']));
            $activityAvailability = trim(htmlspecialchars($_POST['activityAvailability']));

            $activityName = trim(mysqli_real_escape_string($con, $_POST['activityName']));
            $activityLimit = trim(mysqli_real_escape_string($con, $_POST['activityLimit']));
            $activityAvailability = trim(mysqli_real_escape_string($con, $_POST['activityAvailability']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE activities SET activityName = ?, `activityLimit` = ?, activityAvailability = ?
            WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("ssii", $activityName, $activityLimit, $activityAvailability, $id);
            if ($query->execute()) {
                echo '<h2 style="color:green">Record Edited succesfully</h2>';
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
    $query->close();
}

function AdminPanelEditReservedActivities($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT checkIn FROM reservedactivities WHERE rsrvActivitiesId = ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Reserved Activities</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"checkIn\">Check In</label><br>";
        echo "<input type=\"text\" id=\"checkIn\" name=\"checkIn\" value=\"" . $row['checkIn'] . "\"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('checkIn');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $checkIn = trim(htmlspecialchars($_POST['checkIn']));

            $checkIn = trim(mysqli_real_escape_string($con, $_POST['checkIn']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE reservedactivities SET checkIn = ?
            WHERE rsrvActivitiesId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("si", $checkIn, $id);
            if ($query->execute()) {
                echo '<h2 style="color:green">record edited succesfully</h2>';
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
    $query->close();
}

function AdminPanelEditRoom($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT roomNr, roomAvailability, roomType FROM rooms WHERE id= ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Rooms</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"roomNr\">Room Number</label><br>";
        echo "<input type=\"text\" id=\"roomNr\" name=\"roomNr\" value=\"" . $row['roomNr'] . "\"><br>";
        echo "<label for=\"roomAvailability\">Room Availability</label><br>";
        echo "<input type=\"text\" id=\"roomAvailability\" name=\"roomAvailability\" value=\"" . $row['roomAvailability'] . "\"><br>";
        echo "<label for=\"roomType\">Room Type</label><br>";
        echo "<input type=\"text\" id=\"roomType\" name=\"roomType\" value=\"" . $row['roomType'] . "\"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('roomNr', 'roomAvailability', 'roomType');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $roomNr = trim(htmlspecialchars($_POST['roomNr']));
            $roomAvailability = trim(htmlspecialchars($_POST['roomAvailability']));
            $roomType = trim(htmlspecialchars($_POST['roomType']));

            $roomNr = trim(mysqli_real_escape_string($con, $_POST['roomNr']));
            $roomAvailability = trim(mysqli_real_escape_string($con, $_POST['roomAvailability']));
            $roomType = trim(mysqli_real_escape_string($con, $_POST['roomType']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE rooms SET roomNr = ?, `roomAvailability` = ?, roomType = ?
            WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("iisi", $roomNr, $roomAvailability, $roomType, $id);
            if ($query->execute()) {
                echo "record edited succesfully.<br>";
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
    $query->close();
}

function AdminPanelEditReservedRooms($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT checkIn, checkOut FROM reservedrooms WHERE rsrvRoomsId = ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Reserved Rooms</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"checkIn\">Check In</label><br>";
        echo "<input type=\"text\" id=\"checkIn\" name=\"checkIn\" value=\"" . $row['checkIn'] . "\"><br>";
        echo "<label for=\"checkOut\">Check Out</label><br>";
        echo "<input type=\"text\" id=\"checkOut\" name=\"checkOut\" value=\"" . $row['checkOut'] . "\"><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('checkIn', 'checkOut');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $checkIn = trim(htmlspecialchars($_POST['checkIn']));
            $checkOut = trim(htmlspecialchars($_POST['checkOut']));

            $checkIn = trim(mysqli_real_escape_string($con, $_POST['checkIn']));
            $checkOut = trim(mysqli_real_escape_string($con, $_POST['checkOut']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE reservedrooms SET checkIn = ?, `checkOut` = ?
            WHERE rsrvRoomsId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("ssi", $checkIn, $checkOut, $id);
            if ($query->execute()) {
                echo "record edited succesfully.<br>";
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
    $query->close();
}

function AdminPanelEditTables($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT tableNr FROM tables WHERE id= ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Tables</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"tableNr\">Table Number</label><br>";
        echo "<input type=\"text\" id=\"tableNr\" name=\"tableNr\" value=\"" . $row['tableNr'] . "\"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('tableNr');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $tableNr = trim(htmlspecialchars($_POST['tableNr']));

            $tableNr = trim(mysqli_real_escape_string($con, $_POST['tableNr']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE tables SET tableNr = ?
            WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("ii", $tableNr, $id);
            if ($query->execute()) {
                echo "record edited succesfully.<br>";
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
    $query->close();
}

function AdminPanelEditReservedTables($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT checkIn FROM reservedtables WHERE rsrvTableId = ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Reserved Tables</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"checkIn\">Check In</label><br>";
        echo "<input type=\"text\" id=\"checkIn\" name=\"checkIn\" value=\"" . $row['checkIn'] . "\"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('checkIn');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $checkIn = trim(htmlspecialchars($_POST['checkIn']));

            $checkIn = trim(mysqli_real_escape_string($con, $_POST['checkIn']));

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }
            //inputing filled data into database
            $query = $con->prepare("UPDATE reservedtables SET checkIn = ?
            WHERE rsrvTableId = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("si", $checkIn, $id);
            if ($query->execute()) {
                echo "record edited succesfully.<br>";
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }

    $query->close();
}

function AdminPanelEditUsers($idNum)
{
    global $con;
    $id = $_GET['id'];

    $query = $con->prepare("SELECT email, username, fName, lName, usrLevel, pathCert  FROM users WHERE id= ?");

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

    $result = $query->get_result();
    $result->fetch_all(MYSQLI_ASSOC);

    echo "<h1>Users</h1><br>";

    echo "<form method=\"post\"><br>";

    foreach ($result as $row) {
        echo "<label for=\"email\">email</label><br>";
        echo "<input type=\"text\" id=\"email\" name=\"email\" value=\"" . $row['email'] . "\"><br>";
        echo "<label for=\"username\">username</label><br>";
        echo "<input type=\"text\" id=\"username\" name=\"username\" value=\"" . $row['username'] . "\"><br>";
        echo "<label for=\"firstName\">First Name</label><br>";
        echo "<input type=\"text\" id=\"firstName\" name=\"firstName\" value=\"" . $row['fName'] . "\"><br>";
        echo "<label for=\"lastName\">Last Name</label><br>";
        echo "<input type=\"text\" id=\"lastName\" name=\"lastName\" value=\"" . $row['lName'] . "\"><br>";
        echo "<label for=\"usrLevel\">User Level</label><br>";
        echo "<input type=\"text\" id=\"usrLevel\" name=\"usrLevel\" value=\"" . $row['usrLevel'] . "\"><br>";
        echo "<label for=\"pathCert\">Certificate Path</label><br>";
        echo "<input type=\"text\" id=\"pathCert\" name=\"pathCert\" value=\"" . $row['pathCert'] . "\"><br><br>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Edit\">";
    }

    echo "</form>";

    if (isset($_POST['submit'])) {
        $formInputs = array('email', 'username', 'fName', 'lName', 'usrLevel', 'pathCert');
        $allInputsFilled = false;
        foreach ($formInputs as $input) {
            if (empty($_POST[$input])) {
                $allInputsFilled = false;
                echo '<h2 style="color:red">' . $input . ' was not filled in...</h2><br>';;
                echo '<h2 style="color:red">All fields are required </h2><br>';
                break;
            } else {
                $allInputsFilled = true;
            }
            echo '<h2 style="color:green">' . $input . ' was filled in</h2>';
        }

        if ($allInputsFilled == true) {
            //Turning post values into variables for easy access and checking them
            $email = trim(htmlspecialchars($_POST['email']));
            $username = trim(htmlspecialchars($_POST['username']));
            $firstName = trim(htmlspecialchars($_POST['ftName']));
            $lastName = trim(htmlspecialchars($_POST['lName']));
            $usrLevel = trim(htmlspecialchars($_POST['usrLevel']));
            $pathCert = trim(htmlspecialchars($_POST['pathCert']));

            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $username = trim(mysqli_real_escape_string($con, $_POST['username']));
            $firstName = trim(mysqli_real_escape_string($con, $_POST['fName']));
            $lastName = trim(mysqli_real_escape_string($con, $_POST['lName']));
            $usrLevel = trim(mysqli_real_escape_string($con, $_POST['usrLevel']));
            $pathCert = trim(mysqli_real_escape_string($con, $_POST['pathCert']));

            //inputing filled data into database
            $query = $con->prepare("UPDATE users SET email = ?, username = ?, fName = ?, lName = ?, usrLevel = ?, pathCert = ?
            WHERE id = ?");

            if (false === $query) {
                die('Prepare failed' . htmlspecialchars($query->error));
            }

            $query->bind_param("ssssssi", $email, $username, $firstName, $lastName, $usrLevel, $pathCert, $id);
            if ($query->execute()) {
                echo "record edited succesfully.<br>";
            } else {
                echo "Error executing query";
                die(mysqli_error($con));
            }
        }
    }
}

//reserve a spot an event a drop down list for events same as calendar but as a dropdown list
function dropDownEvent()
{
    global $con;

    $query = $con->prepare("SELECT * FROM activities");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    //echo 'Querry executed<br>';

    $query->close();

    foreach($data as $row){
        echo '<option>' . $row['activityName'] . '</option>';
    }
}

//reserve activities
function activityReservation()
{
    global $con;
    if (isset($_POST['submit'])) {

        $activityName = $_POST['eventList'];

        //inputing filled data into database
        $query = $con->prepare("SELECT id FROM activities WHERE activityName = ?");

        if (false === $query) {
            die('Prepare failed' . htmlspecialchars($query->error));
        }

        $query->bind_param("s", $activityName);
        if ($query->execute()) {

        } else {
            echo "Error executing query";
            die(mysqli_error($con));
        }

        $result = $query->get_result();
        $result->fetch_all(MYSQLI_ASSOC); // fetch the result as an associative array

        foreach($result as $row){
            $activityId = $row;
            break;
        }

        if (!empty($_POST['eventList'])) {
            $activity = $_POST['eventList'];
            echo '<h2 style="color:green">you have chosen ' . $activity . '</h2>';
        } else {
            echo '<h2 style="color:red">Please select activity</h2>';
        }

        //inputing filled data into database
        $query = $con->prepare("INSERT INTO reservedactivities (
                    userId, activityId
                ) VALUES (
                    ?, ?
                )");

        if (false === $query) {
            die('Prepare failed' . htmlspecialchars($query->error));
        }

        $userId = $_SESSION['id'];

        $query->bind_param("ii", $userId, $activityId);
        if ($query->execute()) {
            echo '<h2 style="color:green">record created succesfully</h2>';
        } else {
            echo '<h2 style="color:green">error executing query</h2>';
            die(mysqli_error($con));
        }
    }
}

//room reservation

function dropDownRoom()
{
    global $con;

    $query = $con->prepare("SELECT roomNr FROM rooms");

    if (false === $query) {
        die('Prepare failed' . htmlspecialchars($query->error));
    }

    $query->execute();

    if (false === $query) {
        die('Execute failed' . htmlspecialchars($query->error));
    }

    $result = $query->get_result();

    $data = $result->fetch_all(MYSQLI_ASSOC);

    $query->close();

    foreach($data as $row){
        echo '<option>' . $row['roomNr'] . '</option>';
    }
}

function roomReservation()
{
    global $con;
    if (isset($_POST['submit'])) {

        $roomNr = $_POST['roomsList'];

        //inputing filled data into database
        $query = $con->prepare("SELECT id FROM rooms WHERE roomNr = ?");
        /*We send back the number of the room so that we can retrieve the id*/
        if (false === $query) {
            die('Prepare failed' . htmlspecialchars($query->error));
        }

        $query->bind_param("i", $roomNr);
        if ($query->execute()) {

        } else {
            echo "Error executing query";
            die(mysqli_error($con));
        }

        $result = $query->get_result();
        $result->fetch_all(MYSQLI_ASSOC);

        foreach($result as $row){
            $roomId = $row;
            break;
        }

        if (!empty($_POST['roomsList'])) {
            $room = $_POST['roomsList'];
            echo '<h2 style="color:green">You have chosen ' . $room . '</h2>';
        } else {
            echo '<h2 style="color:red"please select room</h2>';
        }

        //inputing filled data into database
        $query = $con->prepare("INSERT INTO reservedrooms (
                   userId ,roomId, checkIn, checkOut
                ) VALUES (
                    ?, ?, ?, ?
                )");

        if (false === $query) {
            die('Prepare failed' . htmlspecialchars($query->error));
        }

        $userId = $_SESSION['id']; /*from the user*/
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];

        $query->bind_param("iiss", $userId, $roomId, $checkIn, $checkOut);
        if ($query->execute()) {
            echo '<h2 style="color:green">record created succesfully</h2>';
        } else {
            echo '<h2 style="color:green">error executing query</h2>';
            die(mysqli_error($con));
        }
    }
}

//User panel

function overviewUser()
{

        global $con;

        $email = $_SESSION['email'];

        $query = $con->prepare("SELECT * FROM users WHERE email= ?");

        if (false === $query) {
            die('Prepare failed' . htmlspecialchars($query->error));
        }

        $query->bind_param("s", $email);

        if (false === $query) {
            die('Binding failed' . htmlspecialchars($query->error));
        }

    $query->execute();

        if (false === $query) {
            die('Execution failed' . htmlspecialchars($query->error));
        }

        $result = $query->get_result();

        $data = $result->fetch_all(MYSQLI_ASSOC);




        echo '<tr>';
        echo '<td>' . $_SESSION['email'] . '</td>';
        echo '<td>' . $_SESSION['username'] . '</td>';
        echo '<td>' . $_SESSION['fName'] . '</td>';
        echo '<td>' . $_SESSION['lName'] . '</td>';
        echo '<td>' . $_SESSION['usrLevel'] . '</td>';
        foreach ($data as $row) {
            $pathCert = !isset($row['pathCert']) || $row['pathCert'] == '' ? 'No' : 'Yes';
            echo '<td>' . $pathCert . '</td>';
        }
        echo "<td>" . '<a href="./userEdit.php?id=' . $_SESSION['id'] . '">Edit</a>' . "</td>";
        echo '</tr>';

}

function userEdit()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        global $con;

        $id = $_GET['id'];

        if (isset($_POST['submit'])) {

            $email = trim(htmlspecialchars($_POST['email']));
            $username = trim(htmlspecialchars($_POST['username']));
            $fName = trim(htmlspecialchars($_POST['fName']));
            $lName = trim(htmlspecialchars($_POST['lName']));

            $username = trim(mysqli_real_escape_string($con, $_POST['username']));
            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $fName = trim(mysqli_real_escape_string($con, $_POST['fName']));
            $lName = trim(mysqli_real_escape_string($con, $_POST['lName']));

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $query = $con->prepare("UPDATE users SET email = ?, username = ?, fName = ?, lName = ? WHERE id = ?");

                if (false === $query) {
                    die('Prepare failed' . mysqli_error($con));
                }

                $query->bind_param("ssssi", $email, $username, $fName, $lName, $id);

                if (false === $query) {
                    die('Binding failed' . mysqli_error($con));
                }

                $query->execute();

                if (false === $query) {
                    die('Execution failed' . mysqli_error($con));
                }

                echo '<h2 style="color:green"Edit done</h2>';

                $_SESSION['username'] = $username;
                $_SESSION['fName'] = $fName;
                $_SESSION['lName'] = $lName;
                $_SESSION['email'] = $email;

                echo '<h2 style="color:green;">Edit made, press the link to go back to user panel</h2>';

                $query->close();
                $con->close();
            } else {
                echo '<h2 style="color:red">Email is of wrong type or introduced correctly</h2>';
            }
        }
    }
    echo '<form method="post">';
    echo '<input type="text" name="email" placeholder="E-mail"><br><br>';
    echo '<input type="text" name="username" placeholder="Username"><br><br>';
    echo '<input type="text" name="fName" placeholder="First Name"><br><br>';
    echo '<input type="text" name="lName" placeholder="Last name"><br><br>';
    echo '<input type="submit" name="submit" value="Edit"><br><br>';
    echo '</form>';
}
?>