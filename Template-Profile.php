<!DOCTYPE html>
<html>
<head>
    <title>Profil <?php echo $row['username']; ?></title>
</head>
<body>
    <?php
    session_start();
    $data = $row['created_at'];
    $dataObj = new DateTime($data);
    $formattedDate = $dataObj->format('d/m/y')
    ?>
    <h1><?php echo $row['username']; ?></h1>
    <p>Członek od: <?php echo $formattedDate; ?></p>
    <?php
    require_once "base.php";
    $sql = 'SELECT * FROM `gallery` WHERE User_ID='.$idprofilu.'';
    $query = mysqli_query($link,$sql);

    
    ?>
    <?php while($row = mysqli_fetch_assoc($query)):?>
        <a href="produkt.php?id=<?php echo $row['ID']; ?>""><p>
            <h1> <?php echo htmlspecialchars($row['Name']) ?> </h1>
                <h2> <?php echo htmlspecialchars($row['Price']) ?> </h1>
            <p> <?php echo htmlspecialchars($row['Discription']) ?> </p>
            <?php if(isset($_SESSION['id'])){ 
                if($_SESSION['id'] == $idprofilu) {
                    echo '<p><a href="edycja.php?id='.$row['ID'].'">Edytuj</a></p>';
                    echo '<p><a href="Produkt-Usun.php?id='.$idprofilu.'&idproduktu='.$row['ID'].'">Usuń</a></p>';
                }
            } ?>
        </p></a>
    <?php endwhile?> 
</body>
</html>