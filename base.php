<?php
    define('Datebase_Adress','localhost');
    define('Datebase_Username','root');
    define('Datebase_Password','');
    define('Datebase_Name','forum');        
    
    $link = mysqli_connect(Datebase_Adress, Datebase_Username, Datebase_Password, Datebase_Name);

    if($link === false) {

        die("ERROR: Could not connect. " . mysqli_connect_error());

    }
?>