<?php

//Main functionalities of the pages

//Inclusion of connection to the database page

require 'dbCon.php';

//Registration function for register.php

function register()
{

    global $con;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['submit'])) {

            $username = trim(htmlspecialchars($_POST['username'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $email = trim(htmlspecialchars($_POST['email']));
            $fName = trim(htmlspecialchars($_POST['fName']));
            $lName = trim(htmlspecialchars($_POST['lName']));
            $password = trim(htmlspecialchars($_POST['password']));


            $username = trim(mysqli_real_escape_string($con,$_POST['username']));
            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $fName = trim(mysqli_real_escape_string($con, $_POST['fName']));
            $lName = trim(mysqli_real_escape_string($con, $_POST['lName']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            $usrLevel = trim(mysqli_real_escape_string($con, 'guest'));
            $usrLevel = trim(htmlspecialchars('guest'));


            if(!empty($username) && !empty($email) && !empty($fName)  && !empty($lName) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){

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

                    $query->bind_param("ssssss", $email, $username, $fName, $lName, $hashPass ,$usrLevel);

                    if (false === $query) {
                        die('Bind param failed' . htmlspecialchars($query->error));
                    }

                    $query->execute();

                    if (false === $query) {
                        die('Execute failed' . htmlspecialchars($query->error));
                    }

                    echo 'Registration made';

                    $query->close();
                    $con->close();


                }else {
                    echo 'Email not valid';
                }



            } else {
                echo 'Make sure you have completed both fields !';
            }


        } else {
            die("Form couldn't be sent");
        }
    }
}


//Sign in function for the signin.php

function signIn()
{
    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {

            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));


            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            if(!empty($email) && !empty($password)) {

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
                                $_SESSION['fName'] = $row['fName'];
                                $_SESSION['lName'] = $row['lName'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['pathCert'] = $row['pathCert'];
                                $_SESSION['usrLevel'] = $row['usrLevel'];

                                if ($row['usrLevel'] === 'guest' || $row['usrLevel'] === 'vip') {
                                    //header("Location: ../testing/adminPanel/indexUser.php");
                                    echo 'guest or vip';
                                    die();
                                }

                                if ($row['usrLevel'] === 'admin') {
                                    //header("Location: ../testing/adminPanel/indexAdmin.php");
                                    echo 'admin';
                                    die();
                                }


                            } else {
                                echo '<h2 style="color:red">Incorrect password</h2>';
                                echo $row['password'];
                            }
                        }

                        /*
                        if(!$result) {
                            die('Query failed' . mysqli_error($con));
                        } else {
                            echo "Query successful";
                        }
                        */
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

function reserveRoom()
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

function reserveRoomSuccess()
{
    if(isset($_SESSION['success_reservation'])) {
        if ($_SESSION['success_reservation'] == 1) {
            echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation made</h2>';
        } else {
            echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation failed</h2>';
        }
    }
}


//reservation page function for reservation_fron

function reservePage() {

    global $con;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['submit'])) {

            $con = mysqli_connect('localhost', 'root', '','testdb')
            or die("Connection to the db failed" . mysqli_error($con));

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


            if(!empty($email) && !empty($username) && !empty($roomName) && !empty($availability) && !empty($quantity)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){


                    $query = $con->prepare("INSERT INTO reservationroom (roomName,roomQuantity,usernameRes,emailRes,availability) VALUES (?,?,?,?,?)");

                    if (false === $query) {
                        echo mysqli_error($con);
                        die('Prepare failed' . htmlspecialchars($query->error));

                    }

                    $query->bind_param("sssss", $roomName,$quantity ,$username, $email, $availability);

                    if (false === $query) {
                        die('Bind param failed' . htmlspecialchars($query->error));
                    }

                    $query->execute();

                    if (false === $query) {
                        die('Execute failed' . htmlspecialchars($query->error));
                    }

                    echo 'Reservation has been added';



                    $query->close();
                    $con->close();


                }else {
                    echo 'Email not valid';
                }


//User panel






            } else {
                echo 'Make sure you have completed all fields !';
            }


        } else {
            die("Form couldn't be sent");
        }
    }
}

//adminside
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['activityName'] . '</td>';
        echo '<td>' . $row['activityLimit'] . '</td>';
        echo '<td>' . $row['activityAvailability'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['id'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['id'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['activityId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['userId'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['userId'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['roomNr'] . '</td>';
        echo '<td>' . $row['roomAvailability'] . '</td>';
        echo '<td>' . $row['roomType'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['id'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['id'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['roomId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo '<td>' . $row['checkOut'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['userId'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['userId'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['tableNr'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['id'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['id'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['userId'] . '</td>';
        echo '<td>' . $row['tableId'] . '</td>';
        echo '<td>' . $row['checkIn'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['userId'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['userId'] . '">Delete</a>' . "</td>";
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

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '<td>' . $row['usrLevel'] . '</td>';
        echo '<td>' . $row['pathCert'] . '</td>';
        echo "<td>" . '<a href="Edit.php?id=' . $row['id'] . '">Edit</a>' . "</td>";
        echo "<td>" . '<a href="Delete.php?id=' . $row['id'] . '">Delete</a>' . "</td>";
        echo '</tr>';
    }
}

//User panel



?>