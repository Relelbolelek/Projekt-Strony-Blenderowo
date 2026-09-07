<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
</head>
<body>
    <?php
        require_once "base.php";
    ?>
    <form action="Register.php" method="post">
        <input type="text" name="Name" id="">
        <input type="password" name="Password" id="">
        <input type="password" name="Password_Comfird" id="">
        <button type="submit" name="button"></button>
    </form>
    <?php
        $username = $password = $confirm_password = "";
        $username_err = $password_err = $confirm_password_err = $thesamerpassowrd = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            if(empty(trim($_POST['Name']))) {
                $username_err = 'Podaj proszę nazwę użytkownika';
                 echo $username_err;
            }
            elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST['Name']))) {

                 $username_err = 'Tylko literki i czyferki';
                 echo $username_err;

            }
            else {

                $sql = "SELECT id FROM users WHERE username = ?";

                if($stmt = mysqli_prepare($link, $sql)){

                    mysqli_stmt_bind_param($stmt,"s",$param_username);
                    $param_username = trim($_POST["Name"]);
                    if(mysqli_stmt_execute($stmt)){

                        mysqli_stmt_store_result($stmt);
                    
                        if(mysqli_stmt_num_rows($stmt) == 1) {

                            $username_err = "Taka nazwa już istnieje";
                            echo $username_err;

                        }
                        else{

                            $username = trim($_POST['Name']);

                        }
                    }
                }
                else {

                    echo "Cholipka";

                }
                mysqli_stmt_close($stmt);
            }

            if(empty(trim($_POST["Password"]))) {

                $password_err = "Please enter a password";

                if(empty($username_err)) {
                echo $password_err;
                }

            }
            elseif(strlen(trim($_POST['Password'])) < 12){

                $password_err = "Długość hasła to minimum 12";
                
                if(empty($username_err)) {
                echo $password_err;
                }

            }
            else{

                $password = trim($_POST['Password_Comfird']);

            }

            if(empty(trim($_POST["Password_Comfird"]))) {

                $confirm_password_errr = "Please enter a password";
                if(empty($password_err)&&empty($username_err)) {
                echo $confirm_password_errr;
                }
            }
            elseif(strlen(trim($_POST['Password_Comfird'])) < 12){

                $confirm_password_err = "Długość hasła to minimum 12";
                if(empty($password_err)&&empty($username_err)) {
                echo $confirm_password_err;
                }

            }
            else{

                $confirm_password = trim($_POST['Password_Comfird']);

            }
            if($password !== $confirm_password) {
                $thesamerpassowrd = 'Hasła się różnią';
                if(empty($username_err)&&empty($confirm_password)&&empty($password_err)) {
                echo $thesamerpassowrd;
                }
            }
            if(empty($username_err) && empty($confirm_password_err) && empty($confirm_password_err)&& empty($thesamerpassowrd)){

                $sql ="INSERT INTO users(username,password) VALUES (?, ?)";

                if($stmt = mysqli_prepare($link,$sql)){

                    mysqli_stmt_bind_param($stmt,"ss", $param_username, $param_password);

                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);

                    if(mysqli_stmt_execute($stmt)) {

                        header("location:login.php");

                    }
                    else {
                        echo "Ups! spierdzieliłeś coś";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    ?>
</body>
</html>