<?php
session_start();
require 'tools.php';

if(empty($_SESSION)){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
</head>
<body>

<?= preShow($_SESSION['cart']) ?>

</body>
</html>


