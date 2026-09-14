<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['Name']; ?>></title>
</head>
<body>
    <h1><?php echo $row['Name']; ?></h1>
    <p><?php echo $row['Discription']; ?></p>
    <p><?php echo $row['Price']; ?></p>
    <p><?php echo '<a href="profile.php?id='.$row['User_ID'].'">autor</a>'; ?></p>
</body>
</html>