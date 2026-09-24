<!DOCTYPE html>
<html>
<head>
    <title>Profil <?php echo $row['username']; ?></title>
</head>
<body>
    <?php
        require_once "Skrypty\base.php";
        $sql = 'SELECT * FROM `gallery` WHERE id='.$idedycji;
        $query = mysqli_query($link,$sql);
    ?>
    <?php
        session_start();
        if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {

            header("location: Galeria.php");
            exit;

        }
        elseif($_SESSION['id'] != $row['User_ID']) {

            header("location: Galeria.php");
            exit;

        }
        $error = false;
        require_once "Skrypty\base.php";
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

                    $sql = "UPDATE `gallery` SET `Name` = ?, `Discription` = ?, `Price` = ?, image_ID= ? WHERE `gallery`.`ID` = ".$idedycji.";";
                    if($stmt = mysqli_prepare($link,$sql)){

                        mysqli_stmt_bind_param($stmt,"ssis",$name,$_POST['Opis'],$_POST['Cena'],$zdjecia);
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
    <form action="" method="post">
        <input type="text" require name="Nazwa" value=<?php echo '"'.$row['Name'].'"' ?>>
        <textarea name="Opis" require id=""><?php echo $row['Discription'] ?></textarea>
        <input type="number" name="Cena" value=<?php echo '"'.$row['Price'].'"' ?>>
        <input type="file" name="Zdjecia" require id="" value=<?php echo '"'.$row['image_ID'].'"' ?>>
        <button type="submit"></button>
    </form>
    
</body>
</html>