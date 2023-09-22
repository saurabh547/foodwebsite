<?php
include('../includes/connect.php');

include('../functions/common_function.php');



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <!-- navbar -->
    <div class="container-fluid p-0 ">
        <!-- first child -->
        <nav class="navbar  navbar-expand-lg  navbar-dark bg-dark">
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
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:100/-</a>
                        </li> -->

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">

                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>

                </div>
            </div>
        </nav>
        <div class="container-fluid mt-3 mb-5">
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <!-- title -->
                <h1 class="text-center">Sign up </h1>
                <div class="wrapper">

                    <div class="form1">
                        <div class="form-outline mb-4  m-auto  ">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Enter Your Username" autocomplete="off" required="required">

                        </div>

                        <!-- email -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter Your email" autocomplete="off" required="required">
                        </div>

                        <!-- password -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter Your Password" autocomplete="off" required="required">
                        </div>

                        <!-- conpassword -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="conpassword" class="form-label">Confirm-Password</label>
                            <input type="password" name="conpassword" id="conpassword" class="form-control"
                                placeholder="Enter Your confirm password" autocomplete="off" required="required">
                        </div>



                    </div>
                    <div class="form2">

                        <!-- Image 1 -->
                        <div class="form-outline mb-4 m-auto">
                            <label for="image" class="form-label">User Image</label>
                            <input type="file" name="image" id="image" class="form-control" required="required">
                        </div>


                        <div class="form-outline mb-4 m-auto">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Enter address" autocomplete="off" required="required">
                        </div>

                        <div class="form-outline mb-4 m-auto">
                            <label for="mobile" class="form-label">Mobile number</label>
                            <input type="text" name="mobile" id="mobile" class="form-control"
                                placeholder="Enter mobile number" autocomplete="off" required="required">
                        </div>




                        <!-- submit -->
                        <div class="form-outline mt-0 ">
                            <button type="submit" name="register" class="button-85 px-3"
                                value="Register">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php"
                                    class="text-danger">Login</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php include("../includes/footer.php") ?>


        <!-- bootstrap js -->
        <script src="../bootstrap.js"></script>
</body>

</html>


<!-- PHP code -->
<?php
if (isset($_POST['register'])) {
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conpassword'];
    $user_address = $_POST['address'];
    $user_mobile = $_POST['mobile'];

    $user_image = $_FILES['image']['name'];
    $user_image_tmp = $_FILES['image']['tmp_name'];

    $user_ip = getIPAddress();


    // select query

    $select_query = "Select * from `user_table` where username ='$user_name' or user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('username and email already present')</script>";
    } elseif ($user_password != $conf_user_password) {
        echo "<script>alert('password not matching')</script>";
    } else {

        // insert_query
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile) values(?,?,?,?,?,?,?)";

        $stmt = $con->prepare($insert_query);

        if ($stmt === false) {
            die("error in sql statement" . $con->error);
        }

        $stmt->bind_param("sssssss", $user_name, $user_email, $hash_password, $user_image, $user_ip, $user_address, $user_mobile);

        if ($stmt->execute()) {
            echo "inserted";
        } else {
            echo "error" . $stmt->error;
        }
        $stmt->close();
    }


    // selecting cart items
    $select_cart_items = "Select * from `cart_details` where ip_address='$user_ip'";
    $result_cart = mysqli_query($con, $select_cart_items);
    $rows_count = mysqli_num_rows($result_cart);
    if ($rows_count > 0) {
        $_SESSION['username'] = $user_name;
        echo "<script>alert('you have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";

    }


}


?>