<?php
// connect file
include("../includes/connect.php");
include('../functions/common_function.php');

session_start();



if (isset($_POST['payment'])) {
    $person_name = $_POST['person_name'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    global $con;

    if ($person_name != "" && $card_number != "" && $expiry_date != "" && $cvv != "") {
        $select_query = "select * from card_details where card_number = '$card_number'";

        $result = mysqli_query($con, $select_query);
        $rows_count = mysqli_num_rows($result);

        if ($rows_count > 0) {
            echo "<script>alert('card details already in use')</script>";
        } else {
            // $conn = new mysqli("localhost", "root", "", "mystore");
            if ($con->connect_error) {
                die("error" . $con->connect_error);
            }

            $insert_query = "insert into card_details(person_name,card_number,expiry,cvv) values(?,?,?,?)";

            $stmt = $con->prepare($insert_query);

            if ($stmt === false) {
                die("error not inserted" . $con->error);
            }

            $stmt->bind_param("ssss", $person_name, $card_number, $expiry_date, $cvv);

            if ($stmt->execute()) {
                // echo "successfully";
                echo "<script>alert('Your card detail submitted successfully','_self')</script>";
                // exit();
            } else {
                echo "error" . $stmt->error;
            }
            $stmt->close();
            $con->close();
        }
    } else {
        echo "<script>alert('please fill the all fields first')</script>";
    }



}


?>

<?php
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

        if ($row_count == 1 && $row_count_cart == 0) {
            echo "<script>alert('Login successful');</script>";
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Login successful');</script>";
            header("Location: http://localhost/food%20ordering%20website/user_area/checkout.php");
            exit();
        }
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}

?>





<!DOCTYPE html>
<html lang="en" style="overflow:hidden;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food ordering-Checkout page</title>
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

        .wrapper {
            display: flex;
            justify-content: center;
            border-radius: 8px;
            /* box-shadow: 5px 5px 6px black; */
            width: 70%;
            margin: auto;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        }



        .form2,
        .form1 {
            width: 50%;
            /* padding: 60px; */
            margin: 50px;

        }


        .card {
            max-width: 500px;
            margin: auto;
            color: black;
            border-radius: 20 px;
        }

        p {
            margin: 0px;
        }

        .container .h8 {
            font-size: 30px;
            font-weight: 800;
            text-align: center;
        }

        .btn.btn-primary {
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
            background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
            border: none;
            transition: 0.5s;
            background-size: 200% auto;

        }


        .btn.btn.btn-primary:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }



        .btn.btn-primary:hover .fas.fa-arrow-right {
            transform: translate(15px);
            transition: transform 0.2s ease-in;
        }

        .form-control {
            color: white;
            background-color: #223C60;
            border: 2px solid transparent;
            height: 60px;
            padding-left: 20px;
            vertical-align: middle;
        }

        .form-control:focus {
            color: white;
            background-color: #0C4160;
            border: 2px solid #2d4dda;
            box-shadow: none;
        }

        .text {
            font-size: 14px;
            font-weight: 600;
        }

        ::placeholder {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
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

    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="./images/logo.jpg">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
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
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_registration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>


                    </ul>
                
                </div>
            </div>
        </nav>






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
                    <a class='nav-link' href='./user_login.php'>Login</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='logout.php'>Logout</a>
                </li>";
                }


                ?>

            </ul>
        </nav>

        <!-- third child -->
        <!-- <div class="bg-light mt-0">
            <h3 class="text-center">Food Store</h3>
            <p class="text-center">Food is very important for all living beings</p>
        </div> -->


        <!-- forth child -->
        <div class="row px-3 mt-0">
            <div class="col-md-12 mt-0">
                <!-- products -->
                <div class="row m-auto">
                    <?php
                    if (!isset($_SESSION['username'])) {
                        // include('user_login.php');
                        echo '<form action="" method="post" class="mt-2 mb-5">
           
            <div class="wrapper  " style="width:40%;">

                <div class="form1 mx-0" style="width:70%;">
                    <h1 class="text-center ">Login </h1>
                    <div class="form-outline mb-4  m-auto  ">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Enter Your Username" autocomplete="off" required="required">

                    </div>



                  
                    <div class="form-outline mb-4  m-auto">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter Your Password" autocomplete="off" required="required">
                    </div>



                    
                    <div class="form-outline mt-0 text-center">
                        <button type="submit" name="user_login" class="button-85 px-3" value="Login">Login</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Dont have an account? <a href="user_registration.php"
                                class="text-danger">register</a></p>
                    </div>
                </div>
            </div>
            </div>
        </form>';

                    } else {
                        echo '
                        <body>
                        <div class="container p-0 m-1">
                        <form action="" method="post">
            <div class="card px-4">
                <p class="h8 py-3">Payment Details</p>
                <div class="row gx-3">
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Person Name</p>
                            <input class="form-control mb-3" type="text" name="person_name" placeholder="Name" value="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Card Number</p>
                            <input class="form-control mb-3" type="number" name="card_number"
                                placeholder="1234 5678 435678">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">Expiry</p>
                            <input class="form-control mb-3" type="text" name="expiry_date" placeholder="MM/YYYY">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <p class="text mb-1">CVV/CVC</p>
                            <input class="form-control mb-3 pt-2 " name="cvv" type="password" placeholder="***">
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary mb-3" type="submit" name="payment" value="payment">

                            <span class="ps-3">Pay &#8377;</span>
                            <span class="fas fa-arrow-right"></span>

                        </button>

                    </div>
                </div>
            </div>
        </form>
        </div>
        </body>';

                    }
                    ?>

                </div>
                <!-- col end -->
            </div>
        </div>

        <!-- last child -->
        <!-- including footer -->
        <?php include("../includes/footer.php") ?>



    </div>



    <!-- bootstrap javascript -->
    <script src="../bootstrap.js"></script>
</body>

</html>