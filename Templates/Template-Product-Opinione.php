<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Product.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Galeria</title>
</head>
<body>
    <?php
    session_start();
    require_once "..\Skrypty\base.php";
        $idProduktu = isset($_GET['idProduktu']) ? (int)$_GET['idProduktu'] : 0;
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                if(isset($_GET['rating'])) {
                    $rating = $_POST["rating"];
                }
                else {
                    $rating = 0;
                }
                $sql ="INSERT INTO `rating_gallery` (`ID`, `User_ID`, `ID_Pracy`, `Comment`, `Rating`) VALUES ('', ?,?,?,?)";

                if($stmt = mysqli_prepare($link,$sql)){

                    mysqli_stmt_bind_param($stmt,"ssss", $username, $ArtworkNumber, $opis , $rating);

                    $username = $_SESSION['id'];
                    $ArtworkNumber = $idProduktu;
                    $opis = $_POST['Opis'];
                    $rating = $_POST['rating'];

                    if(mysqli_stmt_execute($stmt)) {

                        header("location:..\Templates\Template-Product-Opinione.php?idProduktu=".$idProduktu);

                    }
                    else {
                        echo "Ups! spierdzieliłeś coś";
                    }
                    mysqli_stmt_close($stmt);
                }
        }
    ?>
    <div Class='Main-Conainer'>
        <?php
    

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            echo '
                <header>
                    <a class="logo" href="../galeria.php">Blenderowo</a>
                    <a href="../Logout.php">
                    Wyloguj się
                    <svg xmlns="../http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    </a>
                    <a href="../skrypty/Profile.php?id='.$_SESSION['id'].'">
                    Profil
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm146.5-204.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm100-95.5q47-15.5 86-44.5-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160q53 0 100-15.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17Zm-43-43Zm0 360Z"/></svg>
                    </a>
                </header>
            ';
        } else {
            echo '
                <header>
                    <a class="logo" href="../galeria.php">Blenderowo</a>
                    <a href="../Login.php">
                    Zaloguj się
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M480.67-120v-66.67h292.66v-586.66H480.67V-840h292.66q27 0 46.84 19.83Q840-800.33 840-773.33v586.66q0 27-19.83 46.84Q800.33-120 773.33-120H480.67Zm-63.34-176.67-47-48 102-102H120v-66.66h351l-102-102 47-48 184 184-182.67 182.66Z"/></svg>
                    </a>
                    <a href="../Register.php">
                    Zarejestruj się
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#8b6966"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80ZM247-527q-47-47-47-113t47-113q47-47 113-47t113 47q47 47 47 113t-47 113q-47 47-113 47t-113-47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm296.5-343.5Q440-607 440-640t-23.5-56.5Q393-720 360-720t-56.5 23.5Q280-673 280-640t23.5 56.5Q327-560 360-560t56.5-23.5ZM360-640Zm0 400Z"/></svg>
                    </a>
                </header>
            ';
        }
        require_once "../Skrypty/base.php";
        $sql = "SELECT gallery.ID as GID,image_gallery.ID as igID,gallery.User_ID,gallery.Name,gallery.Discription,gallery.image_ID,CONCAT(FORMAT(gallery.Price, 2), ' PLN') AS Price,gallery.Website_ID,image_gallery.Id_Pracy,image_gallery.Imiage_name, ROUND(AVG(rating_gallery.Rating)) as Ocena FROM gallery,image_gallery,rating_gallery WHERE gallery.ID = image_gallery.Id_Pracy AND gallery.ID=$idProduktu GROUP BY image_gallery.ID";
        $query = mysqli_query($link,$sql); 
        $row = mysqli_fetch_assoc($query);
    ?>

    <main id="main2">
        <section>
            <form action="..\Templates\Template-Product-Opinione.php?idProduktu=<?php echo $idProduktu ?>" method="POST" enctype="multipart/form-data" class="RatingContainer">
                <section id="OpinionCreate">
                        <textarea style="grid-area: textarea" name="Opis" id="opinonTextArea" cols="60" rows="6"></textarea>
                    
                        <div class="rating">
                                <input type="radio" name="rating" id="star-1" class="rating-star" value="1">
                                <label for="star-1"><i class="fa-normal fa-star"></i></label>
                                <input type="radio" name="rating" id="star-2" class="rating-star" value="2">
                                <label for="star-2"><i class="fa-normal fa-star"></i></label>
                                <input type="radio" name="rating" id="star-3" class="rating-star" value="3">
                                <label for="star-3"><i class="fa-normal fa-star"></i></label>
                                <input type="radio" name="rating" id="star-4" class="rating-star" value="4">
                                <label for="star-4"><i class="fa-normal fa-star"></i></label>
                                <input type="radio" name="rating" id="star-5" class="rating-star" value="5">
                                <label for="star-5"><i class="fa-normal fa-star"></i></label>
                        </div>
                        <button id="OpinoneSubmit" style="grid-area: submit">Opublikuj</button>
                </section>
            </form>
        </section>
        <?php
                $sql1 = "SELECT users.username,users.Avatar,rating_gallery.Comment,rating_gallery.Rating FROM rating_gallery, users WHERE rating_gallery.User_ID = users.id";
                $query2 = mysqli_query($link,$sql1); 
                $row3 = mysqli_fetch_assoc($query);
            ?>
            <?php while($row3 = mysqli_fetch_assoc($query2)):?>
                <section class="OpinionContainer">
                    <div class="innercontainer">
                        <img src="../<?php echo $row3['Avatar'] ?>" alt="" sizes="" srcset="" style="grid-area: avatar;">
                        <h3><?php echo $row3['username'] ?></h3 style="grid-area: nickanme;">
                        <div style="grid-area: stars;">
                            <?php
                                $Amountofstar = 5-$row3['Rating'];
                               for($i = 0; $i < $row3['Rating']; $i++) {
                                    echo '<i class="fa-normal fa-star" style="color:#ffee4e"></i>';
                               }
                               for($i = 0; $i < $Amountofstar; $i++) {
                                echo '<i class="fa-normal fa-star"></i>';
                               }
                            ?>
                        </div>
                        
                    </div>
                <hr>
                <p class="textconnteiner">
                    <?php echo $row3['Comment'] ?>
                </p>
                </section>
            <?php endwhile?>
    </main>
    <footer>
        Jajko
    </footer>
</div>
</body>
</html>