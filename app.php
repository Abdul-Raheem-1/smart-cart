<?php
include './inc/database.inc.php';
session_start();
$db = new database();

$id = $_SESSION["user_id"];
$user = $db->get_entity('user', $id);

//? remove the selected row from cart_prouct table
if (isset($_POST["rem"])) {
    $product_id = $_POST["rem"];
    $q = "DELETE from cart_product where product_id = $product_id and cart_id = " . $_COOKIE["active_cart"];
    $res = $db->query($q);
    Utility::redirect_to("app.php");
}

//? Empty Cart
if (isset($_POST["empty-cart"])) {
    $cart_id = $_POST["empty-cart"];
    $q = "DELETE from cart_product where cart_id = $cart_id";
    $res = $db->query($q);
    Utility::redirect_to("app.php");
}

//? Generate Bill
if (isset($_POST["generate-bill"])) {
    $cart_id = $_POST["generate-bill"];
    $q = "SELECT p.id, p.price, coalesce(d.discount_percentage, 0), count(p.id) as quantity, p.price - (p.price * coalesce(d.discount_percentage, 0)) as discounted_price
    from cart_product as cp
    inner join product as p
    on cp.product_id = p.id
    left join discount as d
    on d.product_id = p.id
    where cp.cart_id = 1
    group by p.id;";
    $res = $db->query($q);
    
    $q = "INSERT into sale values(null, 'cash', )";
    $res = $db->query($q);
    Utility::redirect_to("app.php");
}

//? Add Product
if (isset($_POST["add-product"])) {
    // $cart_id = $_POST["cart_id"];
    $product_barcode = $_POST["product_lookup"];
}


$q = "SELECT count(distinct cart_id) as total_active_carts
from cart_product;";
$total_active_carts = $db->query($q)->fetch_assoc()["total_active_carts"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./admin-head.php"; ?>
    <script src="./js/vendor/jquery-1.11.2.min.js"></script>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $("#refresh").load("tab_content.php");
                refresh();

            }, 3000);

            

        });
    </script>
</head>

<body class="layout-4">
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $user["name"] ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon"><i class="fa fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="./logout.php" class="dropdown-item has-icon text-danger"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-content main-content-app">
                <section class="section">
                    <div class="section-header">
                        <h1>Smart Cart System</h1>
                    </div>

                    <?php
                    $_SESSION["first_load"] = true;
                    // $_SESSION["active_cart"] = 0;
                    ?>
                    <div class="section-body" id="refresh">

                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>

    <!-- SCS JS File -->
    <script src="js/app.js"></script>

    <datalist id="products">
        <?php
        $q = "SELECT `name`, `barcode` from product";
        $res = $db->query($q);

        while ($row = mysqli_fetch_array($res)) {
        ?>
            <option value="<?= $row["barcode"] ?>"><?= $row["name"] ?></option>
        <?php
        }
        ?>
    </datalist>
    <!-- Modal -->
    <form method="POST">
        <div class="modal fade" id="productsearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input required type="text" list="products" name="product_lookup" id="product_lookup" class="form-control" placeholder="Search Products">
                        </div>
                        <div class="form-group" id="product_info">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add-product" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

<script>
    // Showing result when category is selected
    $(document).ready(function() {
        $('#product_lookup').on('change', function() {
            var product_barcode = this.value;
            $.ajax({
                url: "product_lookup.php",
                type: "POST",
                data: {
                    product_barcode: product_barcode
                },
                cache: false,
                success: function(dataResult) {
                    $("#product_info").html(dataResult);
                }
            });


        });
    });
</script>

</html>