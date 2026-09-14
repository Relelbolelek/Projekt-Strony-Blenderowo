<!DOCTYPE html>
<html>
<head>
    <title>Profil <?php echo $row['username']; ?></title>
</head>
<body>
    <?php
    $data = $row['created_at'];
    $dataObj = new DateTime($data);
    $formattedDate = $dataObj->format('d/m/y')
    ?>
    <h1><?php echo $row['username']; ?></h1>
    <p>Członek od: <?php echo $formattedDate; ?></p>
</body>
</html>