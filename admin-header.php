<?php

$db = new database();
$id = $_SESSION["user_id"];
$user = $db->get_entity('user', $id);

// if ($user["role"] == "cashier") {
//     Utility::redirect_to("app.php");
// }

?>
<!-- Start app top navbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <!-- <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> -->
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

<!-- Start main left sidebar menu -->
<div class="main-sidebar sidebar-style-3">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="admin-index.php">Smart Cart System</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index-2.html">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="menu-header">Views</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-list"></i> <span>Lists</span></a>
                <ul class="dropdown-menu">
                    <?php if ($user["role"] != "cashier") { ?>
                        <li><a class="nav-link" href="./list-user.php">Users</a></li>
                    <?php
                    }
                    ?>
                        <li><a class="nav-link" href="list-brand.php">Brands</a></li>
                        <li><a class="nav-link" href="list-product.php">Products</a></li>
                        <li><a class="nav-link" href="list-category.php">Categories</a></li>
                        <li><a class="nav-link" href="list-stock.php">Stock</a></li>
                        <li><a class="nav-link" href="list-cart.php">Carts</a></li>
                        <li><a class="nav-link" href="list-sale.php">Sales</a></li>
                        <li><a class="nav-link" href="list-discounts.php">Discounts</a></li>
                    <?php
                    ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-plug"></i> <span>Bridge Entities</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="list-book_order.php" class="nav-link">Cart & Products</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php
            if ($user["role"] != "cashier") {
            ?>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-pencil"></i> <span>Create</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="create-user.php">User</a></li>
                        <li><a class="nav-link" href="create-brand.php">Brand</a></li>
                        <li><a class="nav-link" href="create-product.php">Product</a></li>
                        <li><a class="nav-link" href="create-category.php">Category</a></li>
                        <li><a class="nav-link" href="create-cart.php">Cart</a></li>
                        <li><a class="nav-link" href="create-discount.php">Discount</a></li>

                    </ul>
                </li>
            <?php
            }
            ?>
    </aside>
</div>