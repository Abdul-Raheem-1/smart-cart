<?php
include "./inc/database.inc.php";
session_start();
$db = new database();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './admin-head.php'; ?>
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
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <?php
                                $q = "SELECT count(id) as `idle_carts`
                                    from cart
                                    where status = 'idle';";
                                $idle_carts_count = $db->query($q)->fetch_assoc()["idle_carts"];

                                $q = "SELECT count(id) as `active_carts`
                                    from cart
                                    where status = 'active';";
                                $active_carts_count = $db->query($q)->fetch_assoc()["active_carts"];
                                ?>
                                <div class="card-stats">
                                    <div class="card-stats-title"> Carts
                                    </div>
                                    <div class="card-stats-items">
                                        <div class="card-stats-item">
                                            <div class="card-stats-item-count"><?= $idle_carts_count ?></div>
                                            <div class="card-stats-item-label">Idle</div>
                                        </div>
                                        <div class="card-stats-item">
                                            <div class="card-stats-item-count"></div>
                                            <div class="card-stats-item-label"></div>
                                        </div>
                                        <div class="card-stats-item">
                                            <div class="card-stats-item-count"><?= $active_carts_count ?></div>
                                            <div class="card-stats-item-label">Active</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Carts</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= $active_carts_count + $idle_carts_count ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="balance-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-dollar-sign"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Balance</h4>
                                    </div>
                                    <div class="card-body">
                                        $0
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="card card-statistic-2">
                                <div class="card-chart">
                                    <canvas id="sales-chart" height="80"></canvas>
                                </div>
                                <div class="card-icon shadow-primary bg-primary">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Users</h4>
                                    </div>
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-deck">
                        <div class="col-lg-4">
                            <div class="card gradient-bottom">
                                <div class="card-header">
                                    <h4>Most Sold Products</h4>
                                </div>
                                <div class="card-body" id="top-5-scroll">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php
                                        // $q = "SELECT * from `book`";
                                        // $top_5_books = $db->query($q);
                                        $q = "SELECT p.`id`, p.`name` as product_name, b.`name` as brand_name, times_sold
                                        from product as p
                                        inner join brand as b
                                        on p.brand_id = b.id
                                        ORDER BY price desc limit 10;";
                                        $res = $db->query($q);
                                        // ? two loops: one for setiing variables and querying. And the other for displaying.
                                        while ($row = mysqli_fetch_array($res)) {
                                            //     $book_id = $row["id"];

                                            //     $q = "SELECT `book`.id, count(`book`.id) as phy_sales, `book`.title, sum(`book`.price * phy.quantity) as phy_total from `book`
                                            //             left join `book_order` as phy 
                                            //             on `book`.id = phy.book_id 
                                            //             where phy.book_id = $book_id and phy.version = 'phy'";
                                            //     $physical = $db->query($q)->fetch_assoc();

                                            //     $q = "SELECT `book`.id, count(`book`.id) as pdf_sales, `book`.title, sum(`book`.price * pdf.quantity) as pdf_total from `book`
                                            //             left join `book_order` as pdf
                                            //             on `book`.id = pdf.book_id
                                            //             where pdf.book_id = $book_id and pdf.version = 'pdf'";
                                            //     $pdf = $db->query($q)->fetch_assoc();

                                            //     $total_phy_earnings = $physical["phy_total"] ? $physical["phy_total"] : 0;
                                            //     $total_pdf_earnings = $pdf["pdf_total"] ? $pdf["pdf_total"] : 0;
                                            //     $total_earnings = $total_pdf_earnings + $total_phy_earnings;

                                            //     $pdf_earnings_perc = $total_earnings > 0 ? ($total_pdf_earnings / $total_earnings) * 100 : 0;
                                            //     $phy_earnings_perc = $total_earnings > 0 ? ($total_phy_earnings / $total_earnings) * 100 : 0;

                                            //     $total_sales = $physical["phy_sales"] + $pdf["pdf_sales"];


                                        ?>
                                            <li class="media">
                                                <!-- <img class="mr-3 rounded" width="55" src="" alt="product"> -->
                                                <div class="media-body">
                                                    <div class="float-right">
                                                        <div class="font-weight-600 text-muted text-small">
                                                            <?= $row["times_sold"] ?> Sales
                                                        </div>
                                                    </div>
                                                    <div class="media-title"><?= $row["brand_name"] . " " . $row["product_name"] ?></div>
                                                    <div class="mt-1">
                                                        <!-- // ? see if you can work out percentages...well you can..but...yeah..this is weird. -->
                                                        <!-- <div class="budget-price">
                                                            <div class="budget-price-square bg-primary" data-width="0%"></div>
                                                            <div class="budget-price-label">$0</div>
                                                        </div>
                                                        <div class="budget-price">
                                                            <div class="budget-price-square bg-danger" data-width="%"></div>
                                                            <div class="budget-price-label">$0</div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="card-footer pt-3 d-flex justify-content-center">
                                    <!-- <div class="budget-price justify-content-center">
                                        <div class="budget-price-square bg-primary" data-width="20"></div>
                                        <div class="budget-price-label">Physical Sales</div>
                                    </div>
                                    <div class="budget-price justify-content-center">
                                        <div class="budget-price-square bg-danger" data-width="20"></div>
                                        <div class="budget-price-label">PDF Sales</div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-hero">
                                <div class="card-header">
                                    <div class="card-icon">
                                        <i class="fa fa-question-circle"></i>
                                    </div>
                                    <h4>[count]</h4>
                                    <div class="card-description">Customers need help</div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="tickets-list">
                                        <?php // while ($row = mysqli_fetch_array($contacts_limited)) { 
                                        ?>
                                        <!-- <a href="#" class="ticket-item">
                                                <div class="ticket-title">
                                                    <h4></h4>
                                                </div>
                                                <div class="ticket-info">
                                                    <div><?php
                                                            // $user_id = $row["user_id"];
                                                            // $user = $db->get_entity('user', $user_id);
                                                            // echo $user["name"];
                                                            ?></div>
                                                    <div class="bullet"></div>
                                                    <div class="text-primary">1 min ago</div>
                                                </div>
                                            </a> -->
                                        <?php // } 
                                        ?>
                                        <a href="list-contact.php" class="ticket-item ticket-more">
                                            View All <i class="fa fa-chevron-right"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <!-- <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
                </div>
                <div class="footer-right">

                </div>
            </footer> -->
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


</body>

</html>