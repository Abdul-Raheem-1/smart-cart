<?php

include './inc/database.inc.php';
$db = new database();

$product_barcode = $_POST['product_barcode'];
$q = "SELECT * from `product` where `barcode` = '$product_barcode';";
$product = $db->query($q)->fetch_assoc();

$q = "SELECT d.discount_percentage * 100 as disc_perc, s.quantity as quantity
from discount as d
inner join product as p
on p.id = d.product_id
inner join stock as s
on s.product_id = p.id
where p.barcode = '$product_barcode';";
$res = $db->query($q);
$_ = $res->fetch_assoc();
$discount = $res->num_rows > 0 ? $_["disc_perc"] : 0;
$price_after_discount = $product["price"] - ($product["price"] * ($discount / 100));
$stock = $res->num_rows > 0 ? $_["quantity"] : 0;

?>

<table class="table table-responsive" style="max-height: 400px; overflow-y: scroll;">
    <tr>
        <th>ID: </th>
        <td><?= $product["id"] ?></td>
    </tr>
    <tr>
        <th>Name: </th>
        <td><?= $product["name"] ?></td>
    </tr>
    <tr>
        <th>Barcode: </th>
        <td><?= $product["barcode"] ?></td>
    </tr>
    <tr>
        <th>Price: </th>
        <td>PKR <?= $product["price"] ?></td>
    </tr>
    <tr>
        <th>Discount: </th>
        <td><?= number_format($discount, 0, '.') ?>%</td>
    </tr>
    <tr>
        <th>Price <sub>(after discount)</sub>: </th>
        <td>PKR <?= number_format($price_after_discount, 2, '.') ?></td>
    </tr>
    <tr>
        <th>Weight: </th>
        <td><?= $product["weight"] ?> kg(s)</td>
    </tr>
    <tr>
        <th>Stock: </th>
        <td><?= $stock ?></td>
    </tr>
</table>