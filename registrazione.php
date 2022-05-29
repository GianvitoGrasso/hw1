<?php
session_start();
if(isset($_SESSION["username"]))
{
    header("Location: home.php");
    exit;
}

if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["username"]) && isset($_POST["email"]) &&
        isset($_POST["password"]) && isset($_POST["conferma_password"]))
    {
        $errore = array();
        $conn = mysqli_connect("localhost", "root", "", "dbhw1");
        
        // validazione username
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username']))
        {
            $errore[] = "Username non valido";
        }
        else 
        {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '".$username."'";
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) > 0) 
            {
                $errore[] = "Username gia utilizzato";  
            }  
        }
        // validazione email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        {
            $errore[] = "Email non valida";
        } 
        else 
        {
            // verifica se è gia presente nel database
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $errore[] = "Email gia utilizzata";
            }
        }
        // validazione password
        if(strlen($_POST["password"]) < 8) 
        {
            $errore[] = "Caratteri password non sufficienti";
        }
        //validazione confermapassword
        if (strcmp($_POST["password"], $_POST["conferma_password"]) != 0) {
            $errore[] = "Le password non coincidono";
        }
        //registrazione nel database
        if(count($errore) == 0) 
        {
            //sql injection
            $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
            $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users (nome, cognome, username, email, password) VALUES ('$nome','$cognome','$username','$email','$password')";
            
            if(mysqli_query($conn, $query)) 
            {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header('Location: home.php');
                exit;
            }
            else
            {
                $errore[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if(isset($_POST['username']))
    {
        $errore = array("Riempi tutti i campi");
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
        <script src="check_registrazione.js" defer="true"></script>
    </head>
    <body>
        <nav>
            <div id="containerNav" >
                <p class="itemsNav">Registrati</p>
                <p class="itemsNav">Registrati</p>
                <p class="itemsNav">Registrati</p>
                <p class="itemsNav">Registrati</p>
            </div>
        </nav>
        <article>
            <section>
                <div id="flex-containersection">
                    <p>REGISTRATI</p>
                    <main>
                        <form name="formReg" method="post" >
                            <label>Nome<input type="text" name="nome" id="nome" placeholder="nome"></input></label>
                            <span class="hidden" id="nomeSpan">Nome utente non disponibile</span>
                            <label>Cognome <input type="text" name="cognome" id="cognome" placeholder="cognome"></label>
                            <span class="hidden" id="cognomeSpan">Cognome utente non disponibile</span>
                            <label>Username <input type="text" name="username" id="username" placeholder="nome utente"></label>                        <span class="hidden"></span>
                            <span class="hidden" id="usernameSpan">Username utente non disponibile</span>
                            <label>Email <input type="text" name="email" id="email" placeholder="email"></input></label>
                            <span class="hidden" id="emailSpan">Indirizzo email non valido</span>
                            <label>Password <input type="Password" name="password" id="password" placeholder="password"></label>
                            <span class="hidden" id="passSpan">Inserisci almeno 8 caratteri</span>
                            <label>Conferma Password <input type="Password" name="conferma_password" id="confpass" placeholder="conferma password"></label>
                            <span class="hidden" id="confpassSpan">Le password non coincidono</span>
                            <label>&nbsp;<input type="submit" value="Login"></label>
                        </form>
                    </main>
                    <p>Hai gia un account?&nbsp;<a href="login.php">Accedi</a></p>
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