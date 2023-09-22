<?php
// connect file
include("includes/connect.php");
include("functions/common_function.php");
session_start();
?>


<!DOCTYPE html>
<html lang="en" style='overflow:hidden'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food ordering website</title>
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cardstyle {
            width: 18rem;
        }

        .cardstyle:hover {
            border-radius: 15px;
        }

        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            /* padding: 14px 80px 18px 36px; */
            cursor: pointer;
            min-height: 200px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .img-border {
            /* object-fit: contain; */
            border-radius: ;
        }
    </style>
    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="bootstrap.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup>
                                    <?php cart_item() ?>
                                </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:
                                <?php total_cart_price(); ?>/-
                            </a>
                        </li>

                    </ul>
                    <form class="d-flex" action="" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">

                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>


        <!-- calling cart function -->
        <?php
        cart();
        ?>


        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo " <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user_area/logout.php'>Logout</a>
                </li>";
                }



                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light mt-2">
            <h3 class="text-center">Food Store</h3>
            <p class="text-center">Food is very important for all living beings</p>
        </div>


        <!-- forth child -->
        <div class="row px-3 mt-3">
            <div class="col-md-10 mt-3">
                <!-- products -->
                <div class="row ">
                    <!-- fetching products -->

                    <?php
                    // calling function from common_function.php
                    search_product();
                    get_unique_categories();
                    get_unique_brands();


                    ?>

                    <!-- row end -->

                </div>
                <!-- col end -->
            </div>
            <div class="col-md-2 bg-secondary p-0" style=" height: 100%; 
  width: 220px; 
  position: fixed; 
  z-index: 1; 
  top: 5rem; 
  right: 0;
  background-color: #111; 
  overflow-x: hidden; 
  padding-top: 20px;
  
  ">
                <!-- Brands to be displays -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-primary">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>

                    <?php
                    // calling brand function
                    getbrands();
                    ?>

                </ul>

                <!-- Categories to be displayed -->

                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-primary">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    // calling categories function 
                    getcategories();


                    ?>
                </ul>

            </div>
        </div>





        <!-- last child -->
        <div class="bg-dark  text-light p-3 text-center">
            <p>All rights are reserved <i class="fa-solid fa-copyright"></i> Designed by Saurabh-2023</p>
        </div>



    </div>



    <!-- bootstrap javascript -->
    <script src="bootstrap.js"></script>
</body>

</html>