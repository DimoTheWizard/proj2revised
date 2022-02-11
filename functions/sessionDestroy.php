<?php
//Log out button for header
    session_start();
    $_SESSION['isLogged'] = "loggedOut";
    session_destroy();
    header('Location: ../index.php');
?>