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

        if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {

            header("location: login.php");
            exit;

        }

        $error = false;
        require_once "base.php";
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(strlen(trim($_POST['Nazwa'])) < 3) {

                $error = true;
                echo "Podaj nazwę nie krutszą niz 3 znaki";

            }
            elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['Nazwa']))) {

                $error = true;
                echo "Podaj nazwę składająca się tylko z liter i cyfr";

            }
            else {

                $name = trim($_POST['Nazwa']);

            }
            

            if(empty($_POST['Zdjecia'])) {

                $zdjecia = 'templet.png';                

            }
            else{

                $zdjecia = 'templet.png';

            }
            if($error == false) {
                $sql ="SELECT COUNT(`User_ID`) FROM gallery WHERE User_ID = ?";
                if($stmt = mysqli_prepare($link,$sql)) {

                    mysqli_stmt_bind_param($stmt,"i",$userId);
                    $userId = $_SESSION['id'];
                    if(mysqli_stmt_execute($stmt)){

                        mysqli_stmt_store_result($stmt);

                        if(mysqli_stmt_num_rows($stmt) == 1){

                            mysqli_stmt_bind_result($stmt,$WebSiteNumber);
                            mysqli_stmt_fetch($stmt);
                            mysqli_stmt_close($stmt);

                        }

                    }
                }
                else{

                    echo "Coś poszło nie tak4";

                }
                if(isset($WebSiteNumber) && $WebSiteNumber !== ''){

                    $sql='INSERT INTO `gallery` (`ID`, `User_ID`, `Name`, `Discription`, `image_ID`, `Price`, `Website_ID`) VALUES (NULL,?,?,?,?,?,?)';
                    if($stmt = mysqli_prepare($link,$sql)){

                        mysqli_stmt_bind_param($stmt,"isssii",$_SESSION['id'],$name,$_POST['Opis'],$zdjecia,$_POST['Cena'],$WebSiteNumber);
                        if(mysqli_stmt_execute($stmt)){

                            header("location: galeria.php");
                            exit;                            
                        }
                    }
                    else{

                        echo "Coś poszło nie tak3";

                    }

                }
                else{

                    echo "Coś poszło nie tak2";

                }
            }
            else{

                echo "Coś poszło nie tak";

            }


        }
    ?>
    <form action="creating.php" method="post">
        <input type="text" require name="Nazwa">
        <textarea name="Opis" require id=""></textarea>
        <input type="number" name="Cena">
        <input type="file" name="Zdjecia" require id="">
        <button type="submit"></button>
    </form>
</body>
</html>