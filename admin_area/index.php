<?php
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en" style='overflow-x:hidden'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .footer {
            position: absolute;
            bottom: 0;
        }
    </style>
</head>

<body>
    <!--navbar  -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                    <ul class="navbar-nav ">
                        <li class="nav-item text-start">
                            <a class="nav-link active mx-4" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="" class="nav-link">
                                Welcome Guest
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="../user_area/logout.php" class="nav-link text-light bg-danger mx-2 my-1 btn">
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="#"><img src="../images/food1.jpg" alt="" class="admin_image"></a>
                    <p class="text-light text-center">
                        <?php if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        }

                        ?>
                    </p>
                </div>

                <!-- button -->
                <div class="button text-center ">
                    <button class="my-5 btn"><a href="insert_product.php" class="nav-link text-light
                     bg-primary my-1 btn">Insert Products</a></button>

                    <!-- <button class="btn"><a href="" class="nav-link text-light bg-primary my-1">View Product</a></button> -->

                    <button class="btn"><a href="index.php?insert_category"
                            class="nav-link text-light bg-primary my-1 btn">
                            Insert Categories
                        </a></button>
                    <!-- <button class="btn"><a href="" class="nav-link text-light bg-primary my-1 btn">
                            View Categories
                        </a></button> -->
                    <button class="btn"><a href="index.php?insert_brand"
                            class="nav-link text-light bg-primary my-1 btn">
                            Insert Brands
                        </a></button>
                    <!-- <button class="btn"><a href="" class="nav-link text-light bg-primary my-1 btn">
                            View Brands
                        </a></button>
                    <button class="btn"><a href="" class="nav-link text-light bg-primary my-1 btn">
                            All orders
                        </a></button>
                    <button class="btn"><a href="" class="nav-link text-light bg-primary my-1 btn">
                            All payments
                        </a></button>
                    <button class="btn"><a href="" class="nav-link text-light bg-primary my-1 btn">
                            List users
                        </a></button> -->


                </div>
            </div>
        </div>

        <!-- fourth child -->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
            }
            ?>
        </div>

        <!-- last child -->
        <div class="bg-dark col-md-12 text-light p-3 text-center footer">
            <p>All rights are reserved <i class="fa-solid fa-copyright"></i> Designed by Saurabh-2023</p>
        </div>
    </div>


    <!-- bootstrap js -->
    <script src="../bootstrap.js"></script>
</body>

</html>