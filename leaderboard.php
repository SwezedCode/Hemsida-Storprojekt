<?php
    session_start();

    /** Byter till login sidan om man inte är inloggad */
    if(!$_SESSION["loggedin"])
    {
        header('Location: login.php');
        die();
    }

?>

<html>
    <head>
        <link href="misc/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <center>
            <br>
            <h1 style="font-family: lightfont; color: white">Leaderboard</h1>
            <a href="index.php"><button class="cbtn">Home</button></a>
            <br><br>
            <table style="font-family: lightfont; color: white;">
                <tr>
                    <th>User</th>
                    <th>Wins</th>
                    <th>Losses</th>
                </tr>
                
                    <?php
                        $conn = new mysqli("localhost", "user", "test", "users") or die("Connect failed: %s\n". $conn -> error);

                        $sql = "SELECT * FROM `users` WHERE `username`!='". NULL ."' ORDER BY `wins` DESC";
        
                        $userFound = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($userFound) > 0)
                        {
                            while ($row = mysqli_fetch_array($userFound))
                            {
                                echo 
                                '
                                <tr>
                                    <td style="background-color: #3B4751;">' . $row[1] .'</td>
                                    <td style="background-color: #3B4751;">' . $row[3] .'</td>
                                    <td style="background-color: #3B4751;">' . $row[4] .'</td>
                                </tr>
                                ';
                            }
                        }
                    ?>
                
            </table>
        </center>
    </body>
</html>