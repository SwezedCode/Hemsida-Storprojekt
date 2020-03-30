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

    $sql = "SELECT * FROM `users` WHERE `username`='". $username ."'";
        
    $userFound = mysqli_query($conn, $sql);
    if(mysqli_num_rows($userFound) > 0)
    {
        while ($row = mysqli_fetch_array($userFound))
        {
            $wins = $row[3];
            $losses = $row[4];
        }
    }

?>

<html>
    <head>
        <link href="misc/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <a href="leaderboard.php"><button class="cbtn">Leaderboard</button></a>
        <a href="actions/logout.php"><button class="cbtn">Logout</button></a>
        <center>
            <?php
                if(isset($_GET["result"]))
                {
                    $rel = $_GET["result"];
                    switch($rel)
                    {
                        case "win":
                            echo '<h1 style="position: relative; animation-name: result; animation-duration: 1s; font-family: lightfont; color: white;">You won!</h1>';
                            break;
                        case "loss":
                            echo '<h1 style="position: relative; animation-name: result; animation-duration: 1s; font-family: lightfont; color: white;">You lost! ... :(</h1>';
                            break;
                            
                        case "draw":
                            echo '<h1 style="position: relative; animation-name: result; animation-duration: 1s; font-family: lightfont; color: white;">It\'s a draw!</h1>';
                            break;
                    }
                }
            ?>
            
            <h4 style="font-family: lightfont; color: white; position: relative;">Your total wins: <?php echo $wins ?></h4>
            <h4 style="font-family: lightfont; color: white; position: relative; line-height: 0.1;">Your total losses: <?php echo $losses ?></h4>
        </center>
        
        <br>
        
        <center>
            <h1 style="font-family: lightfont; color: white">Rock, Paper, Scissors.</h1>
            <a href="rps.php?choice=rock"><button class="cbtn">Rock</button></a>
            <a href="rps.php?choice=rock"><button class="cbtn">Paper</button></a>
            <a href="rps.php?choice=rock"><button class="cbtn">Scissors</button></a>
        </center>
    </body>
</html>