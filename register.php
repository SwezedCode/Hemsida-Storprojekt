<html>
    <head>
        <link href="misc/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form action="actions/register.php" class="form">
            <center>
                <h1>Register</h1>
                <input type="text" autofocus name="username" id="username" placeholder="Username" required>
                <br><br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br><br>
                <input type="password" name="password2" id="password2" placeholder="Password Again" required>
                <br><br>
                <?php 
                    if(isset($_GET["success"]))
                    {
                        echo '<h4>Your account was registered.</h4>';
                    }else if(isset($_GET["error"]))
                    {
                        switch($_GET["error"])
                        {
                            case "incorrectpasswords":
                                echo '<h4>One of the passwords was not matching.</h4>';
                                break;
                            case "username_exists":
                                echo '<h4>The username already exists.</h4>';
                                break;
                        }
                    }
                ?>
                <button class="cbtn" type="submit">Register</button>
                <br><br>
                <a href="login.php" style="text-decoration: none; color: white;">Already have an account?</a>
            </center>
        </form>
    </body>
</html>