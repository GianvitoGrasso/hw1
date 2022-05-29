<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("login.php");
    exit;
}
    $conn = mysqli_connect("localhost", "root", "", "dbhw1") or die(mysqli_error($conn));
    $elementi = array();
    $query = " SELECT * FROM likes WHERE userid = '".$_SESSION['id']."' ";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($row = mysqli_fetch_assoc($res)){
        $elementi[]=$row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($elementi);  
?>