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
<?php
    require_once "base.php";
    $sql = "SELECT * FROM `gallery`";
    $query = mysqli_query($link,$sql);

    
?>
<?php while($row = mysqli_fetch_assoc($query)):?>
    <a href="produkt.php?id=<?php echo $row['ID']; ?>""><p>
        <h1> <?php echo htmlspecialchars($row['Name']) ?> </h1>
            <h2> <?php echo htmlspecialchars($row['Price']) ?> </h1>
        <p> <?php echo htmlspecialchars($row['Discription']) ?> </p>
    </p></a>
<?php endwhile?>
</body>
</html>