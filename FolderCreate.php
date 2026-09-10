<?php

session_start();

if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {

    header("location: Galeria.php");
    exit;

}
else{

    $MainfolderName = 'Users/'.$_SESSION['id'];
    $SeconderyfoldersNamer = 
    ['Gallery','Settings','Comments'];
    foreach ($SeconderyfoldersNamer as $podfolder) {
        $sciezka = $MainfolderName . '/' . $podfolder;
            if (!file_exists($sciezka)) {
                // Parametr true pozwala na automatyczne utworzenie folderu głównego oraz podfolderu za jednym razem
                mkdir($sciezka, 0777, true);
            }
        
    }   
    header("Location: galeria.php");
    exit;
}
?>