<?php
include './inc/database.inc.php';
session_start();

$db = new database();

if (isset($_POST["add"])) {
    $q = "INSERT INTO `cart` values (NULL, 100, 'Idle', 0)";
    $res = $db->query($q);
}
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

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Add Cart</h1>
                    </div>

                    <div class="section-body">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <?php if (isset($res) and $res) {
                                ?>
                                    <div class='alert alert-success'><b>Cart Added Successfully!</b></div>
                                <?php } ?>

                                <div class="card-header">
                                    <h4>Enter Cart details</h4>
                                </div>
                                <form method="post" action="">
                                    <div class="card-body">

                                    </div>
                                    <div class="form-group">
                                        <input required type="submit" value="Add Cart" name="add" class="btn btn-secondary">
                                    </div>
                            </div>
                            </form>
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

    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/cleave-js/dist/cleave.min.js"></script>
    <script src="assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="js/page/forms-advanced-forms.js"></script>

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        // Showing result when category is selected
        // $(document).ready(function() {
        //     $('#category').on('change', function() {
        //         var category_id = this.value;
        //         $.ajax({
        //             url: "get_subcat.php",
        //             type: "POST",
        //             data: {
        //                 category_id: category_id
        //             },
        //             cache: false,
        //             success: function(dataResult) {
        //                 $("#sub_category").html(dataResult);
        //             }
        //         });


        //     });
        // });
    </script>
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->

</html>