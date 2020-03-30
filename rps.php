<?php

    session_start();
    $loggedin = $_SESSION['loggedin'];
    $username = $_SESSION['username'];

    /** Byter till login sidan om man inte är inloggad */
    if(!$loggedin)
    {
        header('Location: login.php');
        die();
    }

    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);

    $sql = "SELECT * FROM `users` WHERE `username`='" . htmlspecialchars($conn->real_escape_string($username)) ."'";
    
    /** Får tag på användarens score */
    $userFound = mysqli_query($conn, $sql);
    if(mysqli_num_rows($userFound) > 0)
    {
        while ($row = mysqli_fetch_array($userFound))
        {
            $wins = $row[3];
            $losses = $row[4];
        }
    }

    /** Genererar ett random nummer av val */
    $cpuChoice = rand(0, 2);

    if($_GET["choice"] == "rock")
    {
        setScore(0, $cpuChoice, $wins, $losses);
    }
    if($_GET["choice"] == "paper")
    {
        setScore(1, $cpuChoice, $wins, $losses);
    }
    if($_GET["choice"] == "scissors")
    {
        setScore(2, $cpuChoice, $wins, $losses);
    }

    function setScore($userSel, $cpuSel, $wins, $losses)
    {
        $newValWins = $wins + 1;
        $newValLoss = $losses + 1;
        /** Draw */
        if($userSel == $cpuSel)
        {
            header('Location: index.php?result=draw');
            die();
        }
        
        /** Väljer vinnaren */
        switch($userSel)
        {
            case 0:
                if($cpuSel == 1)
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `losses`=" . $newValLoss . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=loss');
                        die();
                    }
                }else
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `wins`=" . $newValWins . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=win');
                        die();
                    }
                }
                break;
            case 1:
                if($cpuSel == 2)
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `losses`=" . $newValLoss . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=loss');
                        die();
                    }
                }else
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `wins`=" . $newValWins . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=win');
                        die();
                    }
                }
                break;
            case 2:
                if($cpuSel == 0)
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `losses`=" . $newValLoss . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=loss');
                        die();
                    }
                }else
                {
                    $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);
                    $score = "UPDATE `users` SET `wins`=" . $newValWins . " WHERE `username`='". $_SESSION['username'] ."'";
                    if(mysqli_query($conn, $score))
                    {
                        header('Location: index.php?result=win');
                        die();
                    }
                }
                break;
        }
    }

?>