<?php 

session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit;
}

if(isset($_POST["contenuto"]))
{
    $contenuto = $_POST["contenuto"];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://www.thesportsdb.com/api/v1/json/2/searchplayers.php?p=".$contenuto);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;
}

?>
