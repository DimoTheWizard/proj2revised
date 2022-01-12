<?php

//Main functionalities of the pages

//Inclusion of connection to the database page

require 'con.php';


//Registration function for register.php

function register()
{

    global $con;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {

            $email = trim(htmlspecialchars($_POST['email'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $fname = trim(htmlspecialchars($_POST['fname']));
            $lname = trim(htmlspecialchars($_POST['lname']));
            $password = trim(htmlspecialchars($_POST['password']));

            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $fname = trim(mysqli_real_escape_string($con, $_POST['fname']));
            $lname = trim(mysqli_real_escape_string($con, $_POST['lname']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            $usrLevel = trim(mysqli_real_escape_string($con, 'guest'));
            $usrLevel = trim(htmlspecialchars('guest'));


            if (!empty($email) && !empty($fname) && !empty($lname) && !empty($password)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $hashPass = password_hash($password,
                        PASSWORD_ARGON2ID,
                        ['memory_cost' => 2048,
                            'time_cost' => 4,
                            'threads' => 3]);

                    //$salt = 'somereallycoolsalttonotbrakpassw';

                    //$hashSalt = $hashPass . $salt;

                    $query = $con->prepare("INSERT INTO user (fname,lname,email,password,userlevel) VALUES (?,?,?,?,?)");

                    if (false === $query) {
                        die('Prepare failed' . htmlspecialchars($query->error));
                    }

                    $query->bind_param("sssss", $fname, $lname, $email, $hashPass, $usrLevel);

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
                echo '<h2 style="color:red">Make sure you have completed both fields !</h2>';
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

            $email = trim(htmlspecialchars($_POST['email'])); //from PHP 8 filter_sanitize_string got replaced with htmlspecialchars
            $password = trim(htmlspecialchars($_POST['password']));

            $email = trim(mysqli_real_escape_string($con, $_POST['email']));
            $password = trim(mysqli_real_escape_string($con, $_POST['password']));

            $usrLevel = trim(mysqli_real_escape_string($con, 'guest'));
            $usrLevel = trim(htmlspecialchars('guest'));

            if (!empty($email) && !empty($password)) {

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $query = $con->prepare("SELECT * FROM user WHERE email = ?");

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
                                $_SESSION['fname'] = $row['fname'];
                                $_SESSION['lname'] = $row['lname'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['userlevel'] = $row['userlevel'];

                                if ($row['userlevel'] === 'guest' || $row['userlevel'] === 'vip') {
                                    //header("Location: ../testing/adminPanel/indexUser.php");
                                    echo 'guest or vip';
                                    die();
                                }

                                if ($row['userlevel'] === 'admin') {
                                    //header("Location: ../testing/adminPanel/indexAdmin.php");
                                    echo 'admin';
                                    die();
                                }


                            } else {
                                echo '<h2 style="color:red">Incorrect password</h2>';
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
    if ($_SESSION['success_reservation'] == 1) {
        echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation made</h2>';
    } else {
        echo '<h2 style="color:green; margin-top:20px; margin-left:40px;">Reservation failed</h2>';
    }
}


?>