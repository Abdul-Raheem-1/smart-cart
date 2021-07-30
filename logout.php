<?php
session_start();
include "./inc/database.inc.php";
$db = new database();

// foreach($_SESSION['cart'] as $key => $value){
//     $book = $db->get_entity('book', $key);
//     // echo $book["title"] . " qty: " . $value["qty"] . "<br>";
//     $new_stock = $book["stock"] + $value["qty"];
//     // echo "new stock " . $new_stock;
//     $db->update_entity('book', 'stock', $new_stock, $key);
// }

session_destroy();
Utility::redirect_to("index.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/datepicker.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>