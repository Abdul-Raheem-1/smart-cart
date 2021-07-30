<?php

include './inc/database.inc.php';
$db = new database();
session_start();

?>
<head>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr("data-cart-id") // activated tab
                // alert(target);
                // $.post("/tab_content.php", {"active_cart_id" : target});
                document.cookie = "active_cart=" + target;
            });
        })
    </script>
</head>

<div>
    <ul class="nav nav-tabs">
        <?php
        $q = "SELECT id from cart where `status` = 'Active'";
        $active_carts = $db->query($q);

        $z = 0;
        while ($row = mysqli_fetch_array($active_carts)) {
            if ($_SESSION["first_load"] == true) {
                $_COOKIE["active_cart"] = $row["id"];
                $_SESSION["first_load"] = false;
            }

        ?>
            <li class="nav-item">
                <a href="#cart<?= $row["id"] ?>" class="nav-link <?= $_COOKIE["active_cart"] == $row["id"] ? "active" : "" ?>" data-toggle="tab" data-cart-id="<?= $row["id"] ?>">
                    <div class="card-header min-height-a p-0 border-0">
                        <h5>Cart <?= $row["id"] ?></h5>
                    </div>
                </a>
            </li>
        <?php
            $z = 1;
        }
        ?>
    </ul>
</div>
<div class="row">
    <div class="col-12 tab-content">
        <?php
        $q = "SELECT id from cart where `status` = 'Active'";
        $active_carts = $db->query($q);
        $z = 0;
        while ($row = mysqli_fetch_array($active_carts)) {
        ?>
            <div class="row tab-pane  <?= $z == 0 ? "show active" : "" ?>" id="cart<?= $row["id"] ?>">
                <div class="col-sm-12 col-md-8 float-left">
                    <div class="card">

                        <div class="">
                            <div class="card-body p-0">
                                <div class="table-responsive table-app">
                                    <form method="post">
                                        <table class="table table-hover table-md v_center">
                                            <tr class="thead-light">
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price / Unit</th>
                                                <th>Discount %</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                            <?php
                                            //? retrieves & prints all the products in the current cart
                                            $cart_id = $row["id"];

                                            $q = "SELECT *, count(cp.product_id) as quantity, d.discount_percentage
                                                                from discount as d
                                                                right join cart_product as cp
                                                                on d.product_id = cp.product_id 
                                                                where cart_id = $cart_id
                                                                group by cp.product_id;";

                                            $items_in_cart = $db->query($q);
                                            $cart_total = 0;
                                            $total_discount = 0;
                                            $subtotal = 0;
                                            while ($row = mysqli_fetch_array($items_in_cart)) {
                                                $product_id = $row["product_id"];
                                                $product = $db->get_entity('product', $product_id);
                                            ?>
                                                <tr>
                                                    <td><?= $product_id ?></td>
                                                    <td>
                                                        <?= $product["name"] ?>
                                                    </td>
                                                    <td>
                                                        PKR <?= $product["price"] ?>
                                                    </td>
                                                    <td><?= $row["discount_percentage"] * 100 ?> %</td>
                                                    <td><?= $row["quantity"] ?></td>
                                                    <td> PKR
                                                        <?php
                                                        $subtotal += $product["price"];
                                                        $discounted_price =  $product["price"] - ($product["price"] * $row["discount_percentage"]);
                                                        echo $product_total = $discounted_price * $row["quantity"];
                                                        $cart_total += $product_total;
                                                        $total_discount += ($product["price"] * $row["discount_percentage"]);
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-danger" name="rem" value="<?= $row["product_id"] ?>" onclick="return confirm('Are you sure?')">
                                                            <b>x</b>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 float-right">
                    <div class="card">
                        <div class="card-header">
                            <h4>Checkout</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-app" style="height: 61vh;">
                                <form method="POST">
                                    <table class="table table-striped table-md v_center">
                                        <?php
                                        $cart_total = number_format($cart_total, 2, '.');
                                        $total = $cart_total;
                                        ?>
                                        <tr>
                                            <th>
                                                <h5>Totals</h5>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Sub Total: </th>
                                            <td>
                                                <p>PKR <?= $subtotal ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Discount: </th>
                                            <td>
                                                <p>PKR <?= $total_discount ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total: </th>
                                            <td>
                                                <p>PKR <span id="total_amount"><?= $total ?></span></p>
                                                <input type="hidden" name="total_amount_<?=$row["id"]?>" value="<?= $total ?>">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Payment</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" pattern="[0-9]{1, }" placeholder="Enter amount" id="inp_recievedAmount" autocomplete="off">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Recieved: </th>
                                            <td>
                                                <p id="recieved">PKR 0.00</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Change: </th>
                                            <td>
                                                <p id="change">PKR 0.00</p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <hr>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <?php
                                                $q = "SELECT `weight`
                                                                    from cart
                                                                    where id = $cart_id;";

                                                $cart_actual_weight = $db->query($q)->fetch_assoc()["weight"];
                                                $cart_actual_weight = number_format($cart_actual_weight, 2, '.');
                                                ?>
                                                <div class="alert alert-info">
                                                    <p>Cart's Weight: </p>
                                                    <p><?= $cart_actual_weight ?> kg</p>
                                                </div>
                                            </td>
                                            <td>
                                                <?php
                                                //? Total weight of the scanned items in cart 
                                                $q = "SELECT sum(p.`weight`) as total_weight
                                                                    from cart_product as cp
                                                                    inner join product as p
                                                                    on p.id = cp.product_id
                                                                    where cart_id = $cart_id;";

                                                $scanned_items_weight = $db->query($q)->fetch_assoc()["total_weight"];
                                                $scanned_items_weight = number_format($scanned_items_weight, 2, '.');
                                                ?>
                                                <div class="alert alert-info">
                                                    <p>Scanned Item's Weight: </p>
                                                    <p><?= $scanned_items_weight ?> kg</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php
                                                $q = "SELECT count(id) total_item_count
                                                                    from cart_product
                                                                    where cart_id = $cart_id";
                                                $total_item_count = $db->query($q)->fetch_assoc()["total_item_count"];
                                                ?>
                                                <div class="alert alert-primary">
                                                    <p>Item Count: <?= $total_item_count ?></p>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                    <div class="table-responsive">
                                        <table class="table table-md v_center">
                                            <tr>
                                                <td>
                                                    <button class="btn btn-danger" type="submit" name="empty-cart" value="<?= $cart_id ?>" id="<?= $cart_id ?>"><i class="fa fa-close"></i> <br> Empty Cart</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info" type="button" name="" data-toggle="modal" data-target="#productsearch" value="<?= $cart_id ?>" id="<?= $cart_id ?>"><i class="fa fa-search"></i> <br> Product Search</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success" type="submit" name="generate_bill" value="<?= $cart_id ?>" id="<?= $cart_id ?>"><i class="fa fa-dollar"></i> <br> Generate Bill</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $z = 1;
        }
        ?>
    </div>
</div>