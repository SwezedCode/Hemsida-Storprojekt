<?php
    session_start();

    /** Kollar om man har ett session */
    if($_SESSION["loggedin"])
    {
        /** Nollställer användarens session */
        $_SESSION["loggedin"] = false;
        $_SESSION["username"] = '';
        
        header('Location: ../login.php');
        die();
    }else
    {
        header('Location: ../login.php');
        die();
    }
?>