<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Creating.css">
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
                    <a href="Logout.php">
                    Wyloguj się
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    </a>
                    <a href="Profile.php?id='.$_SESSION['id'].'">
                    Profil
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm146.5-204.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm100-95.5q47-15.5 86-44.5-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160q53 0 100-15.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17Zm-43-43Zm0 360Z"/></svg>
                    </a>
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
                    <a href="Register.php">
                    Zarejestruj się
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80ZM247-527q-47-47-47-113t47-113q47-47 113-47t113 47q47 47 47 113t-47 113q-47 47-113 47t-113-47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm296.5-343.5Q440-607 440-640t-23.5-56.5Q393-720 360-720t-56.5 23.5Q280-673 280-640t23.5 56.5Q327-560 360-560t56.5-23.5ZM360-640Zm0 400Z"/></svg>
                    </a>
                </header>
            ';
        }
    ?>

    <main>
        <?php

            if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true) {

                header("location: login.php");
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
<!--         <form action="creating.php" method="post">
            <input type="text" require name="Nazwa">
            <textarea name="Opis" require id=""></textarea>
            <input type="number" name="Cena">
            <input type="file" name="Zdjecia" require id="">
            <button type="submit"></button>
</form> -->
    <section>
        <form action="zapisz.php" method="POST" enctype="multipart/form-data">
            <div>
                    <input type="text" name="" id="" placeholder="Podaj tytuł:">
            </div>
            <div id='Imiage-Conatiner'>
                <img class='Images' id="Template" src="templet.png" alt="">
            </div>
            <section id='mini-container'>
                <label for="wyborPlikow" class="Imiage-add" id="adding_button">
                    <form action="zapisz.php" method="POST" enctype="multipart/form-data" >
                        <input type="file" id="wyborPlikow" name="obrazy[]" multiple accept="image/*0" value="">
                </label>
            </section>
        </form>
    </section>
    </main>
    <footer>
        Jajko
    </footer>
</div>
<script>
    let iloscobrazkow = 0;
    const inputPlikow = document.getElementById('wyborPlikow');
    const kontener = document.getElementById('Imiage-Conatiner');
    const miniaturka = document.getElementById('mini-container');

    let wybranePliki = [];

    // Definiujemy dozwolone typy MIME oraz maksymalny rozmiar w bajtach (4 MB)
    const dozwoloneTypy = ['image/jpeg', 'image/png', 'image/jpg'];
    const maksymalnyRozmiar = 4 * 1024 * 1024; // 4 MB w bajtach

    inputPlikow.addEventListener('change', function(e) {
        const nowefile = Array.from(e.target.files);

        for (let plik of nowefile) {
            // 1. Sprawdzenie limitu liczby plików (np. max 7)
            if (wybranePliki.length >= 7) {
                alert('Możesz dodać maksymalnie 7 obrazków!');
                break;
            }

            // 2. Sprawdzenie rozszerzenia (typu pliku)
            if (!dozwoloneTypy.includes(plik.type)) {
                alert(`Plik "${plik.name}" ma niedozwolony format. Dozwolone są tylko pliki JPG, JPEG i PNG.`);
                continue; // Pomiń ten plik i przejdź do następnego
            }

            // 3. Sprawdzenie wagi pliku (max 4 MB)
            if (plik.size > maksymalnyRozmiar) {
                alert(`Plik "${plik.name}" jest za duży! Maksymalny rozmiar to 4 MB.`);
                continue; // Pomiń ten plik
            }

            // Jeśli wszystko OK, dodajemy plik do tablicy i tworzymy podgląd
            wybranePliki.push(plik);
            
            if(iloscobrazkow == 0) {

                const img = document.getElementById('Template').src=URL.createObjectURL(plik);
                const div = document.createElement('img');
                const imgMini = document.createElement('img');
                img.src = URL.createObjectURL(plik);
                div.src = URL.createObjectURL(plik);
                div.classList.add('Imiage-Miniature');
                miniaturka.appendChild(div);

            }



        }
        
        // Opcjonalnie: resetujemy input, aby użytkownik mógł w razie potrzeby wybrać ten sam plik ponownie
        inputPlikow.value = '';
    });
</script>
</body>
</html>  