<html>
    <head>

    </head>
    <body>
        <?php
        if(isset($_GET['image']) || isset($_GET['par']) || isset($_POST['image']) || isset($_POST['par']))
        {
            print_r($_GET);
            print_r($_POST);
        }
        else {
                $variabile = 'Errore dati';
                echo json_encode($variabile);
                print_r($_GET);
                print_r($_POST);
        }
        ?>
    </body>
</html>