<?php
session_start();

define('MYSITE', true);
if (!defined('MYSITE')) {
    header('location: ../../index.php');
    die();
}
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
    header("location: ../index.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">






    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="assets/css/quicksand.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!--Animate CSS-->
    <link rel="stylesheet" href="assets/css/chartist.min.css">
    <!--Map-->
    <link rel="stylesheet" href="assets/css/jquery-jvectormap-2.0.2.css">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="assets/js/calendar/bootstrap_calendar.css">
    <!--Datatable-->
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <!--JsGrid CSS-->
    <link rel="stylesheet" href="assets/css/jsgrid.min.css">
    <link rel="stylesheet" href="assets/css/jsgrid-theme.min.css">
    <!-- jquery cdn link for ajax -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>



    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>Home Services Admin</title>
</head>







<body>
    <!--Page loader-->
    <div class="loader-wrapper">
        <div class="loader-circle">
            <div class="loader-wave"></div>
        </div>
    </div>
    <!--Page loader-->

    <!--Page Wrapper-->

    <div class="container-fluid">

        <!--Header-->
        <div class="row header shadow-sm">

            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
                <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                    <h3 class="logo"><a href="../../../index.php" class="text-secondary logo">
                            <i class="fa fa-institution"></i>
                            <span class="small"><b>QuickFix</b> admin</span></a></h3>
                </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">

                    <!--Menu Icons-->
                    <div class="col-sm-4 col-8 pl-0">
                        <!--Toggle sidebar-->
                        <span class="menu-icon" onclick="toggle_sidebar()">
                            <span id="sidebar-toggle-btn"></span>
                        </span>
                        <!--Toggle sidebar-->
                    </div>
                    <!--Menu Icons-->


                    <!--Search box and avatar-->
                    <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                        <div class="search-rounded mr-3">
                            <input type="text" class="form-control search-box" placeholder="Enter keywords.." />
                        </div>
                        <div class="mr-4">
                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../img/user.png " alt="Adam" class="rounded-circle" width="40px" height="40px">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mt-13" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#"><i class="fa fa-square pr-2"></i> Category</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-th-list pr-2"></i> Service</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="fa fa-book pr-2"></i> Report</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off pr-2"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>
            </div>
            <!--Header Menu-->
        </div>
        <!--Main Content-->

        <div class="row main-content">
            <!--Sidebar left-->
            <div class="col-sm-3 col-xs-6 sidebar pl-0">
                <div class="inner-sidebar mr-3">
                    <!--Image Avatar-->
                    <div class="avatar text-center">
                        <img src="../img/user.png" alt="" class="img-fluid  rounded-circle" />
                        <p><strong><?php echo $_SESSION['admin_username']; ?></strong></p>
                        <span class="text-primary small"><strong><?php echo $_SESSION['admin_username']; ?></strong></span>
                    </div>
                    <!--Image Avatar-->


                    <!--Sidebar Navigation Menu-->
                    <div class="sidebar-menu-container">
                        <ul class="sidebar-menu mt-4 mb-4">


                            <!-- My desk -->
                            <li class="parent">
                                <a href="index.php" class=""><i class="fa fa-user mr-3"></i>
                                    <span class="none">My desk </span>
                                </a>
                            </li>

                            <!-- Category -->
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('category'); return false" class=""><i class="fa  fa-square mr-3"></i>
                                    <span class="none">Category <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                </a>
                                <ul class="children" id="category">
                                    <li class="child"><a href="category_view.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> View Category</a></li>
                                </ul>
                            </li>

                            <!-- Services -->
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('service'); return false" class=""><i class="fa  fa-th-list mr-3"></i>
                                    <span class="none">Service <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                </a>
                                <ul class="children" id="service">
                                    <li class="child"><a href="service_view.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> View Service</a></li>
                                    <li class="child"><a href="service_add.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Add Service</a></li>
                                    <!-- <li class="child"><a href="sp_update.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Edit Service Provider Details</a></li> -->
                                </ul>
                            </li>



                            <!-- Service Provider -->
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('serviceprovider'); return false" class=""><i class="fa  fa-male mr-3"></i>
                                    <span class="none">Service Provider <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                </a>
                                <ul class="children" id="serviceprovider">
                                    <li class="child"><a href="sp_view.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> View Service Provider </a></li>
                                    <!-- <li class="child"><a href="sp_update.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Edit Service Provider Details</a></li> -->
                                </ul>
                            </li>

                            <!-- Customer -->
                            <li class="parent">
                                <a href="#" onclick="toggle_menu('customer'); return false" class=""><i class="fa fa-users mr-3"></i>
                                    <span class="none">Customer <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                                </a>
                                <ul class="children" id="customer">
                                    <li class="child"><a href="customer_view.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> View Customer</a></li>
                                    <li class="child"><a href="admin_contact.php" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Contact Us</a></li>
                                </ul>
                            </li>








                            <!-- orders -->
                            <li class="parent">
                                <a href="_generate_report.php" class=""><i class="fa fa-book mr-3"></i>
                                    <span class="none">Generate Report </span>
                                </a>
                               
                            </li>





                        </ul>
                    </div>
                    <!--Sidebar Naigation Menu-->
                </div>
            </div>
            <!--Sidebar left-->