<?php
session_start();
if(isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}

if(!empty($_POST["username"]) && !empty($_POST["password"]))
    {
        $conn = mysqli_connect("localhost", "root", "", "dbhw1") or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $query = "SELECT * FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0)
        {
            $entry = mysqli_fetch_assoc($res);
            if(password_verify(($_POST['password']), $entry['password']))
            {
                $_SESSION["id"] = $entry["id"];
                $_SESSION["nome"] = $entry["nome"];
                $_SESSION["cognome"] = $entry["cognome"];
                $_SESSION["username"] = $entry["username"];
                $_SESSION["email"] = $entry["email"];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
            $errore = "Password errata.";
        }
        else if (mysqli_num_rows($res) <= 0) {
        $errore = "Username e/o password errati.";
        }
    }
    else if (isset($_POST["username"]) || isset($_POST["password"]))
    {
        $errore = "Inserisci Username e Password.";        
    }

?>
<html>
    <head>
        <title>
            <?php
                echo "Data di oggi: ".date("d-m-Y");
            ?>
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="grafica.css">
    </head>
    <body>
        <nav>
            <div id="containerNav" >
                <p class="itemsNav">login</p>
                <p class="itemsNav">login</p>
                <p class="itemsNav">login</p>
                <p class="itemsNav">login</p>
            </div>
        </nav>
        <article>

            <section>
                <div id="flex-containersection">
                    <p>LOGIN</p>
                    <?php
                    if(isset($errore))
                    {
                        echo "<span class='errore'>$errore</span>";
                    }
                    ?> 
                    <main>
                        <form name="login" method='post'>
                                <label>Username <input type="text" name="username" placeholder="username"></input></label>
                                <label>Password <input type="Password" name="password" placeholder="password"></label>
                                <label>&nbsp;<input type="submit" value="Login"></label>
                        </form>
                    </main>
                    <p>Non hai un account?&nbsp;<a href="registrazione.php">Iscriviti</a></p>
                </div>
            </section>
        </article>
        <footer>
            <div id="flex-containerfooter">
                <div class="footeritems">Gianvito Grasso 1000026771</div>
            </div>
    </footer>
    </body>
</html>