<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<?php
// Include your database connection script here.

if (isset($_POST['user_login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password'];

    $select_query = "SELECT * FROM `user_table` WHERE username = '$username'";
    $result = mysqli_query($con, $select_query);

    if (!$result) {
        die("Database error: " . mysqli_error($con));
    }

    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($row_count > 0 && password_verify($password, $row_data['user_password'])) {
        $_SESSION['username'] = $username;

        if ($row_data['user_type'] === 'admin') {
            echo "<script>alert('Admin login successful');</script>";
            header("Location: ../admin_area/index.php");
            exit();

        } elseif ($row_count == 1 && $row_count_cart == 0) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" >
          <strong>Error!</strong> Login successful
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Login successful');</script>";
            header("Location: payment.php");
            exit();
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" >
          <strong>Error!</strong> Invalid username/password !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
    }
}








?>



<!-- Your HTML login form here -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="./images/logo.jpg">
    <style>
        body {
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            border-radius: 8px;
            /* box-shadow: 5px 5px 6px black; */
            width: 70%;
            margin: auto;
            background-color: white;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;

        }



        .form2,
        .form1 {
            width: 50%;
            /* padding: 60px; */
            margin: 50px;

        }



        /* CSS */
        .button-85 {
            padding: 0.6em 2em;
            border: none;
            outline: none;
            color: rgb(255, 255, 255);
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-85:before {
            content: "";
            background: linear-gradient(45deg,
                    #ff0000,
                    #ff7300,
                    #fffb00,
                    #48ff00,
                    #00ffd5,
                    #002bff,
                    #7a00ff,
                    #ff00c8,
                    #ff0000);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            -webkit-filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing-button-85 20s linear infinite;
            transition: opacity 0.3s ease-in-out;
            border-radius: 10px;
        }

        @keyframes glowing-button-85 {
            0% {
                background-position: 0 0;
            }

            50% {
                background-position: 400% 0;
            }

            100% {
                background-position: 0 0;
            }
        }

        .button-85:after {
            z-index: -1;
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: #222;
            left: 0;
            top: 0;
            border-radius: 10px;
        }
    </style>
</head>

<body class="" style="background-color:#e9e0d9;">


    <div class="container-fluid mb-5 ">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active mx-4" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li> -->
                        <li class="nav-item">

                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<a class='nav-link active' href='../cart.php'><i class='fa-solid fa-cart-shopping'></i><sup>";
                                cart_item();
                            } else {
                                echo "<a class='nav-link active' href='../cart.php'><i class='fa-solid fa-cart-shopping'></i><sup>";
                            }
                            ?>
                            </sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Total Price:
                                <?php total_cart_price(); ?>/-
                            </a>
                        </li>

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">

                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>

                </div>
            </div>
        </nav>
        <!-- form -->
        <form action="" method="post" class="m-auto">
            <!-- title -->
            <div class="wrapper mt-5 " style="width:40%;">

                <div class="form1" style="width:70%;">
                    <h1 class="text-center ">Login </h1>
                    <div class="form-outline mb-4  m-auto  ">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Enter Your Username" autocomplete="off" required="required">

                    </div>



                    <!-- password -->
                    <div class="form-outline mb-4  m-auto">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter Your Password" autocomplete="off" required="required">
                    </div>



                    <!-- submit -->
                    <div class="form-outline mt-0 text-center">
                        <button type="submit" name="user_login" class="button-85 px-3" value="Login">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="user_registration.php"
                                class="text-danger">register</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="bg-dark  text-light p-3 text-center fixed-bottom">
        <p>All rights are reserved <i class="fa-solid fa-copyright"></i> Designed by Saurabh-2023</p>
    </div>


    <!-- bootstrap js -->
    <script src="../bootstrap.js"></script>
</body>

</html>