<?php
include './inc/database.inc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./admin-head.php"; ?>
</head>

<body class="layout-4">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <?php include "./admin-header.php"; ?>

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Products List</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="admin-index.php">Dashboard</a></div>
                            <div class="breadcrumb-item">Products List</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">Products</h2>
                        <p class="section-lead">Here are all the registered Products.</p>

                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Products</h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Barcode</th>
                                                    <th>Price</th>
                                                    <th>Weight</th>
                                                    <th>Brand</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php
                                                $res = $db->get_entities('product');
                                                while ($row = mysqli_fetch_array($res)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $row["id"] ?></td>
                                                        <td><?= $row["name"] ?></td>
                                                        <td><?= $row["barcode"] ?></td>
                                                        <td>PKR <?= $row["price"] ?></td>
                                                        <td><?= $row["weight"] ?> kg</td>
                                                        <td><?php 
                                                            $brand_id = $row["brand_id"];
                                                            echo $db->get_entity('brand', $brand_id)["name"];
                                                        ?></td>
                                                        <td><?php 
                                                            $category_id = $row["category_id"];
                                                            echo $db->get_entity('category', $category_id)["name"];
                                                        ?></td>
                                                        <td><a href="details-user.php?id=<?= $row["id"] ?>" class="btn btn-secondary">Detail</a> / <a href="delete-confirm-user.php?id=<?= $row["id"] ?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                <?php }
                                                if ($res->num_rows == 0) {
                                                    echo "<tr><td colspan='7'><div class='alert alert-danger'>No product found!</div></td></tr>";
                                                } ?>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div> Smart Cart System
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/components-table.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- components-table.html  Tue, 07 Jan 2020 03:37:13 GMT -->

</html>


<!-- Start app main Content -->