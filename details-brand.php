<?php
include './inc/database.inc.php';
session_start();
$db = new database();
$url_id = $_GET["id"];
$brand = $db->get_entity('brand', $url_id);
?>
<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

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

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Brand Details</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?= $brand["name"] ?></h4>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-md v_center">
                                                <tr>
                                                    <th for="">ID</th>
                                                    <td><?= $brand["id"] ?></td>
                                                </tr>
                                                <tr>
                                                    <th for="">Name</th>
                                                    <td><?= $brand["name"] ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="prd_carousel_main_wrapper" id="prd_carousel_main_wrapper">
                                    <div class="prd_carousel_main" id="prd_carousel_main">
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
                                        </div>
                                        <div class="carousel_item">
                                            <span class="prd_name">Danedar 500mg</span>
                                            <span class="prd_price">Rs. 650</span>
                                            <span class="prd_sale">86 Sold</span>
                                            <input type="button" class="btn btn-primary w-100 prd_details_btn" value="Details">
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
                    <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
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
    <script src="assets/modules/jquery.sparkline.min.js"></script>
    <script src="assets/modules/chart.min.js"></script>
    <script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="assets/modules/summernote/summernote-bs4.js"></script>
    <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/index.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/custom_script.js"></script>
</body>


</html>