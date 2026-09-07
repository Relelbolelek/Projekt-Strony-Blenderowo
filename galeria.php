<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

        echo '
        
            <a href="Logout.php">Wyloguj się</a>
        
        ';

    }
    else {

        echo '
            <a href="Login.php">Zaloguj się</a>
            <a href="Register.php">Zarejestruj się</a>
        ';
    }
?>
</body>
</html>