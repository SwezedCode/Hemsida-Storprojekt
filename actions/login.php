<?php
    function login()
    {
        $username = $_GET["username"];
        $password = $_GET["password"];
        $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);

        $sql = "SELECT * FROM `users` WHERE `username`='". htmlspecialchars($conn->real_escape_string($username)) ."'";
        
        /** Hittar användaren */
        $userFound = mysqli_query($conn, $sql);
        if(mysqli_num_rows($userFound) > 0)
        {
            while ($row = mysqli_fetch_array($userFound))
            {
                /** Kollar om lösenordet matchar det hashade lösenordet i databasen */
                if(password_verify($_GET["password"], $row[2])) {
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["loggedin"] = true;
                    header('Location: ../index.php');
                    die();
                }else{
                    header('Location: ../login.php?error=invalid');
                    die();
                }
            }
        }else
        {
            header('Location: ../login.php?error=invalid');
            die();
        }
    }

    login();
?>
