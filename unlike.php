<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("login.php");
    exit;
}
        if( isset($_POST['image']) && isset($_POST['par']) )
        {
                $conn = mysqli_connect("localhost", "root", "", "dbhw1");
                $userid = $_SESSION['id'];
                $image = mysqli_real_escape_string($conn, $_POST['image']);
                $title = mysqli_real_escape_string($conn, $_POST['par']);
                $query = "DELETE FROM likes WHERE userid = $userid and img = '$image' and title = '$title' ";
                $res = mysqli_query($conn, $query);
                mysqli_close($conn);
                echo $res;
                exit;
        }
        else {
                $variabile = 'Errore dati';
                echo json_encode($variabile);
        }
?>