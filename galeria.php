<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/galeria.css">
    <title>Galeria</title>
</head>
<body>
    <div Class='Main-Conainer'>
        <?php

    session_start();

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

            echo '
                <header>
                    <a class="logo" href="galeria.php">Blenderowo</a>
                    <a href="Logout.php">Wyloguj się</a>
                    <a href="Profile.php?id='.$_SESSION['id'].'">Profil</a>
                </header>
            ';

        }
        else {

            echo '
                <header>
                    <a class="logo" href="galeria.php">Blenderowo</a>
                    <a href="Login.php">
                    Zaloguj się
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M480.67-120v-66.67h292.66v-586.66H480.67V-840h292.66q27 0 46.84 19.83Q840-800.33 840-773.33v586.66q0 27-19.83 46.84Q800.33-120 773.33-120H480.67Zm-63.34-176.67-47-48 102-102H120v-66.66h351l-102-102 47-48 184 184-182.67 182.66Z"/></svg>
                    </a>
                    <a href="Register.php">Zarejestruj się</a>
                </header>
            ';
        }
    ?>
    <?php
        require_once "base.php";
        $sql = "SELECT * FROM `gallery`";
        $query = mysqli_query($link,$sql);

        
    ?>
    <main>
    <?php while($row = mysqli_fetch_assoc($query)):?>
        <a href="produkt.php?id=<?php echo $row['ID']; ?>""><p>
            <h1> <?php echo htmlspecialchars($row['Name']) ?> </h1>
                <h2> <?php echo htmlspecialchars($row['Price']) ?> </h1>
            <p> <?php echo htmlspecialchars($row['Discription']) ?> </p>
        </p></a>
    <?php endwhile?>
    </main>
    <footer>
        Jajko
    </footer>
</div>
</body>
</html>