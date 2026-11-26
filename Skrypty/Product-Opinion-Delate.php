<?php
    session_start();
    require_once("..\Skrypty\base.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && isset($_GET['idProduktu'])) {
        $userId = $_SESSION['id'];
        $idProduktu = (int)$_GET['idProduktu'];

        $sql = "DELETE FROM `rating_gallery` WHERE `User_ID` = ? AND `ID_Pracy` = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ii", $userId, $idProduktu);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        
        header("location: ..\Templates\Template-Product-Opinione.php?idProduktu=".$idProduktu);
        exit();
    }
    else {

        echo $idProduktu; 

    }
?>