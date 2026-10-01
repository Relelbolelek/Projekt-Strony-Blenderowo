<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Creating.css">
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
        } else {
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
            require_once "base.php";
            $sql = "SELECT gallery.ID as GID,image_gallery.ID as igID,gallery.User_ID,gallery.Name,gallery.Discription,gallery.image_ID,CONCAT(FORMAT(gallery.Price, 2), ' PLN') AS Price,gallery.Website_ID,image_gallery.Id_Pracy,image_gallery.Imiage_name FROM gallery,image_gallery WHERE gallery.ID = image_gallery.Id_Pracy AND gallery.ID=61 GROUP BY image_gallery.ID";
            $query = mysqli_query($link,$sql); 
            $row = mysqli_fetch_assoc($query);
        ?>
        <?php
            if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                header("location: login.php");
                exit;
            }

            $Cena_err =$Name_err = "";


            if($_SERVER["REQUEST_METHOD"] == "POST"){

                if(strlen(trim($_POST['Nazwa'])) < 3) {$Name_err = "Podaj nazwę nie krótszą niż 3 znaki";
                } elseif(!preg_match('/^[\p{L}\p{N}_ ]+$/u', trim($_POST['Nazwa']))) {$Name_err = "Podaj nazwę składającą się tylko z liter i cyfr";
                } else {
                    $name = trim($_POST['Nazwa']);
                }

                if(!empty($_POST['Cena']) && !preg_match('/^[0-9]+([.,][0-9]+)?$/u', trim($_POST['Cena']))) {$Cena_err = "Cena powinna zawierać tylko cyfry";
                } else {
                    $cena = !empty($_POST['Cena']) ? trim($_POST['Cena']) : 0;
                }
                
                if(empty($Cena_err) && empty($Name_err)) {
                    
                    // 1. Pobieramy Website_ID (licznik prac użytkownika)
                    $WebSiteNumber = 1;
                    $sqlCount = "SELECT COUNT(`User_ID`) FROM gallery WHERE User_ID = ?";
                    if($stmtCount = mysqli_prepare($link,$sqlCount)) {
                        mysqli_stmt_bind_param($stmtCount, "i", $_SESSION['id']);
                        if(mysqli_stmt_execute($stmtCount)){
                            mysqli_stmt_store_result($stmtCount);
                            if(mysqli_stmt_num_rows($stmtCount) == 1){
                                mysqli_stmt_bind_result($stmtCount,$countRes);
                                mysqli_stmt_fetch($stmtCount);
                                $WebSiteNumber =$countRes + 1;
                            }
                        }
                        mysqli_stmt_close($stmtCount);
                    }

                    // 2. Wstawiamy główny wpis do tabeli `gallery`
                    $sqlGallery = 'INSERT INTO `gallery` (`ID`, `User_ID`, `Name`, `Discription`, `image_ID`, `Price`, `Website_ID`) VALUES (NULL, ?, ?, ?, "brak", ?, ?)';
                    
                    if($stmtGallery = mysqli_prepare($link,$sqlGallery)){
                        $opis =$_POST['Opis'] ?? '';
                        mysqli_stmt_bind_param($stmtGallery, "issii", $_SESSION['id'], $name,$opis, $cena,$WebSiteNumber);
                        
                        if(mysqli_stmt_execute($stmtGallery)){
                            $idPracy = mysqli_insert_id($link); // Pobieramy ID nowo dodanej pracy
                        } else {
                            echo "Coś poszło nie tak (błąd zapisu gallery)";
                            exit;
                        }
                        mysqli_stmt_close($stmtGallery);
                    }

                    // 3. Tworzymy folder na pliki
                    $target_dir = "Users/".$_SESSION['id']."/Gallery/".$name."/";
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    // 4. Obsługa wgrywania wielu plików i zapisu do `image_gallery`
                    if (isset($_FILES["fileToUpload"])) {
                        $totalFiles = count($_FILES["fileToUpload"]["name"]);
                        $pierwszyPlik = true;

                        for ($i = 0; $i < $totalFiles; $i++) {
                            $fileName = basename($_FILES["fileToUpload"]["name"][$i]);$target_file = $target_dir .$fileName;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
                            if ($check === false) continue;
                            if ($_FILES["fileToUpload"]["size"][$i] > 4000000) continue;
                            if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) continue;

                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i],$target_file)) {
    
                                $isThumbnail =$pierwszyPlik ? 1 : 0;

                                // Zapytanie do tabeli image_gallery
                                $sqlImage = "INSERT INTO `image_gallery` (`ID`, `Id_Pracy`, `Imiage_name`, `Thumbnail`) VALUES (NULL, ?, ?, ?)";
                                if($stmtImg = mysqli_prepare($link,$sqlImage)) {
                                    mysqli_stmt_bind_param($stmtImg, "isi", $idPracy, $target_file,$isThumbnail);
                                    mysqli_stmt_execute($stmtImg);
                                    mysqli_stmt_close($stmtImg);
                                }

                                // Aktualizacja głównego image_ID w tabeli gallery
                                if ($pierwszyPlik) {$sqlUpdateGalleryImg = "UPDATE `gallery` SET `image_ID` = ? WHERE `ID` = ?";
                                    if($stmtUpd = mysqli_prepare($link,$sqlUpdateGalleryImg)) {
                                        mysqli_stmt_bind_param($stmtUpd, "si", $target_file,$idPracy);
                                        mysqli_stmt_execute($stmtUpd);
                                        mysqli_stmt_close($stmtUpd);
                                    }
                                    $pierwszyPlik = false;
                                }
                            }
                        }
                    }

                    echo "Sukces";
                    exit;
                } else {
                    echo "Coś poszło nie tak (błąd walidacji)";
                }
            }
        ?>

    <section>
        <form action="Creating.php" method="POST" enctype="multipart/form-data">
            <div style="grid-area: box-1;">
                    <input id="Header" type="text" name="Nazwa" value="<?php echo $row['Name'] ?>" placeholder="Podaj tytuł:" maxlength="30">
            </div>
            <hr style="grid-area: hr;">
            <div id='Imiage-Conatiner' style="grid-area: box-2;">
                <img class='Images' id="Template" src="templet.png" alt="">
            </div>
            <section id='mini-container' style="grid-area: box-3;">
                <label for="wyborPlikow" class="Imiage-add" id="adding_button">
                    <input type="file" id="wyborPlikow" name="fileToUpload[]" multiple accept="image/*">
                </label>
            </section>
            <section style="grid-area: box-5;">
                <hr>
                <p>
                    <textarea name="Opis" rows="20" placeholder="Dodaj opis"><?php echo $row['Discription'] ?></textarea>
                </p>
            </section>
            <section style="grid-area: box-4;" id="aside">
                <input type="text" inputmode="numeric" name="Cena" value="<?php echo $row['Price'] ?>" placeholder="Podaj cene (o ile chcesz)" maxlength="5">
                <button type="submit" name="submit">Dodaj</button>
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
    function SwtichImiage(ImigeNumber) {
        let src = event.target.src;
        document.getElementById('Template').src = src;
    }

    const inputPlikow = document.getElementById('wyborPlikow');
    const kontener = document.getElementById('Imiage-Conatiner');
    const miniaturka = document.getElementById('mini-container');

    let wybranePliki = []; 

    const dozwoloneTypy = ['image/jpeg', 'image/png', 'image/jpg'];
    const maksymalnyRozmiar = 4 * 1024 * 1024; 

    inputPlikow.addEventListener('change', function(e) {
        const nowefile = Array.from(e.target.files);

        for (let plik of nowefile) {
            if (wybranePliki.length >= 7) {
                alert('Możesz dodać maksymalnie 7 obrazków!');
                break;
            }

            const czyDuplikat = wybranePliki.some(
                istniejacy => istniejacy.name === plik.name && istniejacy.size === plik.size
            );
            if (czyDuplikat) {
                alert(`Plik "${plik.name}" został już dodany!`);
                continue; 
            }

            if (!dozwoloneTypy.includes(plik.type)) {
                alert(`Plik "${plik.name}" ma niedozwolony format.`);
                continue; 
            }

            if (plik.size > maksymalnyRozmiar) {
                alert(`Plik "${plik.name}" jest za duży!`);
                continue; 
            }

            wybranePliki.push(plik);
            
            const afterblock = document.getElementById('adding_button');
            
            document.getElementById('Template').src = URL.createObjectURL(plik);

            const kontenerMiniaturki = document.createElement('div');
            kontenerMiniaturki.style.height = "75px";

            const imgMini = document.createElement('img');
            imgMini.src = URL.createObjectURL(plik);
            imgMini.classList.add('Imiage-Miniature');
            
            let aktualnyIndeks = iloscobrazkow;
            imgMini.onclick = () => SwtichImiage(aktualnyIndeks);
            imgMini.id = "ImiageNumber" + iloscobrazkow;

            kontenerMiniaturki.appendChild(imgMini);
            afterblock.before(kontenerMiniaturki);
            
            iloscobrazkow++;
            if (iloscobrazkow >= 7) {
                afterblock.style.display = "none";
                break;
            }
        }
        
        inputPlikow.value = '';
    });

    const formularz = document.querySelector('form');

    formularz.addEventListener('submit', function(e) {
        e.preventDefault(); 

        const nazwaTytul = document.getElementById('Header').value.trim();
        if (nazwaTytul.length < 3) {
            alert("Podaj nazwę nie krótszą niż 3 znaki!");
            return;
        }

        if (wybranePliki.length === 0) {
            alert("Musisz dodać przynajmniej jeden obrazek!");
            return;
        }

        const formData = new FormData(formularz);
        formData.delete('fileToUpload[]');

        wybranePliki.forEach(plik => {
            formData.append('fileToUpload[]', plik);
        });

        fetch('Creating.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log("Odpowiedź serwera:", data);
            window.location.href = 'galeria.php';
        })
        .catch(error => {
            console.error('Błąd podczas wysyłania:', error);
            alert("Wystąpił błąd podczas przesyłania danych.");
        });
    });
</script>
</body>
</html>