<?php

    $username = $_GET["username"];
    $password = $_GET["password"];
    $passwordAgain = $_GET["password2"];

    function register()
    {
        $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);

        /** Kollar om båda lösenorden matchade */
        if($_GET["password"] != $_GET["password2"])
        {
            header('Location: ../register.php?error=incorrectpasswords');
            die();
        }
        
        /** Kollar om användarnamnet redan existerar */
        $nameCheckSql = "SELECT * FROM users WHERE username = '". htmlspecialchars($conn->real_escape_string($_GET["username"])) ."'";
        $nameFound = mysqli_query($conn, $nameCheckSql);
        if(mysqli_num_rows($nameFound) != 0)
        {
            header('Location: ../register.php?error=username_exists');
            die();
        }

        /** Hashar lösenordet med ARGON2I */
        $hashpass = password_hash($_GET["password"], PASSWORD_ARGON2I);

        /** Lägger till användaren i databasen */
        $sql = "INSERT INTO users (username,password) VALUES ('" . htmlspecialchars($conn->real_escape_string($_GET["username"])) ."', '" . $hashpass . "')";

        if ($conn->query($sql) === TRUE) {
            header('Location: ../register.php?success=true');
            die();
        } else {
            header('Location: ../register.php?error=sqlerror');
        }
    }

    register();

    /*function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "user";
        $dbpass = "test";
        $db = "users";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        
        $username = "a";
        $password = password_hash('testing', PASSWORD_ARGON2I);
        $mail = "test@gmail.com";
        
        $nameCheck = "SELECT * FROM users WHERE username = '".$username."'";
        $nameFound = mysqli_query($conn, $nameCheck);
        if(mysqli_num_rows($nameFound) != 0)
        {
            echo 'Username already exists.';
            return;
        }
        
        $mailCheck = "SELECT * FROM users WHERE mail = '".$mail."'";
        $mailFound = mysqli_query($conn, $mailCheck);
        if(mysqli_num_rows($mailFound) != 0)
        {
            echo 'The mail already exists.';
            return;
        }
        
        $sql = "INSERT INTO users (username,password,mail) VALUES ('$username', '$password', '$mail')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: Unable to connect to a database.";
        }
        
        return $conn;
    }*/
?>