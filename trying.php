<?php 
if(isset($_POST["submit"])){
    header("Location: indexV51.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="trying.php" method="post">
        <input type="submit" name="submit">
    </form>
</body>
</html>