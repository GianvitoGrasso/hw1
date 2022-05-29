<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("login.php");
        exit;
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
        <link rel="stylesheet" href="home.css">
        <script src="home.js" defer="true"></script>
    </head>
    <body>
        <nav>
            <div id="containerNav" >
                <p class="itemsNav">Benvenuto <?php echo $_SESSION["username"]; ?></p>
                <form name="form" id="form">
                <label><p>Scrivi il nome di uno sportivo :</p> <input type="text" name="contenuto" id="contenuto"> 
                    <input type="submit" value="Cerca"></label>
                </form>
                <p class="itemsNav"><a href="logout.php">Logout</a></p>
            </div>
        </nav>
        <article>
            <section>
                <div class ="flex-containersection">
                    <p>I tuoi Preferiti:</p>
                </div>
                <div class ="flex-button">
                    <button>Cancella tutti i preferiti</button>
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