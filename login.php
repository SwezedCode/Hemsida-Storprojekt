<?php
    session_start();
    /** Initilizerar sessionens värden */
    if(!isset($_SESSION["loggedin"]))
    {
        $_SESSION["loggedin"] = false;
    }
    $loggedin = $_SESSION["loggedin"];
    if($loggedin)
    {
        /** Tar användaren till hemsidan om man redan är inloggad */
        header('Location: index.php');
    }

?>
<html>
    <head>
        <link href="misc/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form action="actions/login.php" class="form">
            <center>
                <h1>Login</h1>
                <input type="text" autofocus name="username" id="username" placeholder="Username" required>
                <br><br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br><br>
                <button class="cbtn" type="submit">Login</button>
                <br><br>
                <?php 
                    if(isset($_GET["error"]))
                    {
                        echo '<h4>The username or password is invalid.</h4>';
                    }
                ?>
                <a href="register.php" style="text-decoration: none; color: white;">Don't have an account?</a>
            </center>
        </form>
    </body>
</html>