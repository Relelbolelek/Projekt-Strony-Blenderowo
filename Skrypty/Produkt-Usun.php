<?php

session_start();

if($_SERVER["REQUEST_METHOD"] != "GET") {

    header("location: Galeria.php");
    exit;

}
elseif(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){

    header("location: Galeria.php");
    exit;
    
}
else{

    $id = $_GET['id'];
    $idP = $_GET['idproduktu'];
    if($id != $_SESSION['id']){

        header("location: Galeria.php");
        exit;

    }
    else{
        
        require_once "base.php";
        $sql='DELETE FROM `gallery` WHERE `gallery`.`ID` = '.$idP;
        mysqli_query($link,$sql);
        header("Location: galeria.php");
        exit;
    }

}
?>