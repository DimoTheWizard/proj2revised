<?php
    session_start();
    $_SESSION['isLogged'] = "loggedOut";
    session_destroy();
    header('Location: ../index.php');
?>