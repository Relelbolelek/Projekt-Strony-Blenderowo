

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

    header("location: Galeria.php");
    exit;

}

require_once "base.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["Username"]))){

        echo $username_err = "Podaj nazwę użytkownika";

    }
    else{

        $username = trim($_POST['Username']);

    }
    if(empty(trim($_POST["Password"]))){

        echo $password_err = "Podaj hasło";

    }
    else{

        $password = trim($_POST['Password']);

    }
    if(empty($username_err) && empty($password_err)) {

        $sql ="SELECT id, username, password FROM users WHERE username = ?";

            if($stmt = mysqli_prepare($link,$sql)){
                mysqli_stmt_bind_param($stmt,"s",$param_username);
                $param_username = $username;

                if(mysqli_stmt_execute($stmt)){

                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){

                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password,$hashed_password)){

                                session_start();

                                $_SESSION['loggedin'] = true;
                                $_SESSION['id'] = $id;
                                $_SESSION['username'] = $username;

                                header("location: galeria.php");
                                
                            }
                            else {
                                echo $login_err = "Nie poprawna nazwa lub hasło";
                            }
                        }
                        else {

                            echo $login_err = "Nie poprawna nazwa lub hasło";

                        }
                    }
                
                }
            }
            else {

                echo "Oj coś się popaprykowało";

            }

    }
}

?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="text" name="Username" id="">
    <input type="password" name="Password" id="">
    <button type="submit"></button>
</form>
<a href="Register.php">Nie masz konta?</a>
</body>
</html>