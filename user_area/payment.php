<?php
include("../includes/connect.php");

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



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/logo.jpg">
    <link rel="stylesheet" href="../style.css">

    <title>Payment Gateway</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #0C4160;

            padding: 30px 10px;
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style='margin-top:-100px'>
            <div class="container-fluid mt-0">
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


        <form action="" method="post">
            <div class="card px-4 mt-5">
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
    <div class="bg-dark  text-light p-3 text-center fixed-bottom">
        <p>All rights are reserved <i class="fa-solid fa-copyright"></i> Designed by Saurabh-2023</p>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</body>

</html>